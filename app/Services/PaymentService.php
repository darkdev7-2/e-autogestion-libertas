<?php

namespace App\Services;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    /**
     * Initialize a payment.
     */
    public function initiate(User $user, float $amount, string $description = '', string $provider = null): Payment
    {
        $provider = $provider ?? config('services.payment.default_provider', 'kkiapay');

        $payment = Payment::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'provider' => $provider,
            'status' => 'initiated',
            'description' => $description,
        ]);

        try {
            switch ($provider) {
                case 'kkiapay':
                    $paymentUrl = $this->initiateKkiapay($payment, $user);
                    break;
                case 'fedapay':
                    $paymentUrl = $this->initiateFedapay($payment, $user);
                    break;
                default:
                    throw new \Exception("Unknown payment provider: {$provider}");
            }

            $payment->update([
                'meta_json' => [
                    'payment_url' => $paymentUrl,
                ],
            ]);

            return $payment;
        } catch (\Exception $e) {
            $payment->markAsFailed();
            Log::error("Payment initialization failed: " . $e->getMessage(), [
                'payment_id' => $payment->id,
                'user_id' => $user->id,
                'provider' => $provider,
            ]);

            throw $e;
        }
    }

    /**
     * Initialize KkiaPay payment.
     */
    protected function initiateKkiapay(Payment $payment, User $user): string
    {
        $publicKey = config('services.kkiapay.public_key');
        $privateKey = config('services.kkiapay.private_key');
        $sandbox = config('services.kkiapay.sandbox', true);

        if (empty($publicKey) || empty($privateKey)) {
            throw new \Exception('KkiaPay not configured');
        }

        $baseUrl = $sandbox ? 'https://api-sandbox.kkiapay.me' : 'https://api.kkiapay.me';

        // For MVP, we'll use a simple payment URL
        // In production, use KkiaPay SDK or API
        $paymentUrl = "https://widget.kkiapay.me/v2/{$publicKey}/{$payment->amount}";

        Log::info('KkiaPay payment initiated', [
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'url' => $paymentUrl,
        ]);

        return $paymentUrl;

        // TODO: Implement actual KkiaPay API integration
        // $response = Http::post("{$baseUrl}/api/v1/transactions/initialize", [
        //     'public_key' => $publicKey,
        //     'amount' => $payment->amount,
        //     'name' => $user->name,
        //     'phone' => $user->phone,
        //     'callback_url' => route('payment.callback'),
        // ]);
        //
        // if ($response->failed()) {
        //     throw new \Exception('KkiaPay API error: ' . $response->body());
        // }
        //
        // $data = $response->json();
        // return $data['payment_url'];
    }

    /**
     * Initialize FedaPay payment.
     */
    protected function initiateFedapay(Payment $payment, User $user): string
    {
        $publicKey = config('services.fedapay.public_key');
        $secretKey = config('services.fedapay.secret_key');
        $sandbox = config('services.fedapay.sandbox', true);

        if (empty($publicKey) || empty($secretKey)) {
            throw new \Exception('FedaPay not configured');
        }

        // For MVP, we'll log the payment
        // In production, use FedaPay SDK
        Log::info('FedaPay payment initiated', [
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
        ]);

        return "https://pay.fedapay.com/transaction/{$payment->id}";

        // TODO: Implement actual FedaPay API integration
        // \FedaPay\FedaPay::setApiKey($secretKey);
        // \FedaPay\FedaPay::setEnvironment($sandbox ? 'sandbox' : 'production');
        //
        // $transaction = \FedaPay\Transaction::create([
        //     'amount' => $payment->amount,
        //     'currency' => ['iso' => 'XOF'],
        //     'description' => $payment->description,
        //     'callback_url' => route('payment.callback'),
        //     'customer' => [
        //         'firstname' => $user->name,
        //         'email' => $user->email,
        //         'phone_number' => ['number' => $user->phone, 'country' => 'bj'],
        //     ],
        // ]);
        //
        // return $transaction->generateToken()->url;
    }

    /**
     * Handle payment callback/webhook.
     */
    public function handleCallback(string $provider, array $data): Payment
    {
        switch ($provider) {
            case 'kkiapay':
                return $this->handleKkiapayCallback($data);
            case 'fedapay':
                return $this->handleFedapayCallback($data);
            default:
                throw new \Exception("Unknown payment provider: {$provider}");
        }
    }

    /**
     * Handle KkiaPay callback.
     */
    protected function handleKkiapayCallback(array $data): Payment
    {
        $transactionId = $data['transaction_id'] ?? null;
        $status = $data['status'] ?? 'failed';

        if (!$transactionId) {
            throw new \Exception('Missing transaction ID in callback');
        }

        // Find the payment
        $payment = Payment::where('transaction_id', $transactionId)->firstOrFail();

        if ($status === 'SUCCESS' || $status === 'success') {
            $payment->markAsPaid();
            $payment->update([
                'meta_json' => array_merge($payment->meta_json ?? [], $data),
            ]);

            // Send payment success notification
            $notificationService = app(NotificationService::class);
            $notificationService->send(
                $payment->user,
                'email',
                'payment_success',
                [
                    'name' => $payment->user->name,
                    'amount' => number_format($payment->amount, 0, ',', ' '),
                ]
            );

            Log::info('Payment successful', ['payment_id' => $payment->id]);
        } else {
            $payment->markAsFailed();
            Log::warning('Payment failed', ['payment_id' => $payment->id, 'status' => $status]);
        }

        return $payment;
    }

    /**
     * Handle FedaPay callback.
     */
    protected function handleFedapayCallback(array $data): Payment
    {
        $transactionId = $data['transaction_id'] ?? null;
        $status = $data['status'] ?? 'failed';

        if (!$transactionId) {
            throw new \Exception('Missing transaction ID in callback');
        }

        $payment = Payment::where('transaction_id', $transactionId)->firstOrFail();

        if ($status === 'approved') {
            $payment->markAsPaid();
            $payment->update([
                'meta_json' => array_merge($payment->meta_json ?? [], $data),
            ]);

            // Send payment success notification
            $notificationService = app(NotificationService::class);
            $notificationService->send(
                $payment->user,
                'email',
                'payment_success',
                [
                    'name' => $payment->user->name,
                    'amount' => number_format($payment->amount, 0, ',', ' '),
                ]
            );

            Log::info('Payment successful', ['payment_id' => $payment->id]);
        } else {
            $payment->markAsFailed();
            Log::warning('Payment failed', ['payment_id' => $payment->id, 'status' => $status]);
        }

        return $payment;
    }

    /**
     * Verify payment status.
     */
    public function verifyPayment(Payment $payment): bool
    {
        if ($payment->status === 'paid') {
            return true;
        }

        // TODO: Verify with payment provider API
        Log::info('Payment verification', ['payment_id' => $payment->id]);

        return false;
    }

    /**
     * Get payment receipt data.
     */
    public function getReceiptData(Payment $payment): array
    {
        return [
            'payment_id' => $payment->id,
            'transaction_id' => $payment->transaction_id,
            'user' => $payment->user->name,
            'amount' => $payment->amount,
            'provider' => ucfirst($payment->provider),
            'status' => $payment->status,
            'paid_at' => $payment->paid_at?->format('d/m/Y H:i'),
            'description' => $payment->description,
        ];
    }
}
