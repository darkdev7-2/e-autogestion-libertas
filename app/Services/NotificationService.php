<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    /**
     * Send a notification through specified channel.
     */
    public function send(User $user, string $channel, string $templateKey, array $data = []): Notification
    {
        $notification = Notification::create([
            'user_id' => $user->id,
            'channel' => $channel,
            'template_key' => $templateKey,
            'payload_json' => $data,
            'status' => 'pending',
        ]);

        try {
            switch ($channel) {
                case 'sms':
                    $this->sendSMS($user, $templateKey, $data);
                    break;
                case 'email':
                    $this->sendEmail($user, $templateKey, $data);
                    break;
                case 'whatsapp':
                    $this->sendWhatsApp($user, $templateKey, $data);
                    break;
                default:
                    throw new \Exception("Canal de notification inconnu: {$channel}");
            }

            $notification->markAsSent();
        } catch (\Exception $e) {
            $notification->markAsFailed($e->getMessage());
            Log::error("Notification failed: " . $e->getMessage(), [
                'user_id' => $user->id,
                'channel' => $channel,
                'template_key' => $templateKey,
            ]);
        }

        return $notification;
    }

    /**
     * Send SMS using Twilio.
     */
    protected function sendSMS(User $user, string $templateKey, array $data): void
    {
        if (empty(config('services.twilio.sid'))) {
            throw new \Exception('Twilio not configured');
        }

        $message = $this->getTemplate($templateKey, $data, $user->locale);

        // In production, use Twilio SDK
        // For now, log the message
        Log::info('SMS sent', [
            'to' => $user->phone,
            'message' => $message,
        ]);

        // TODO: Implement actual Twilio SMS sending
        // $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        // $twilio->messages->create($user->phone, [
        //     'from' => config('services.twilio.from'),
        //     'body' => $message
        // ]);
    }

    /**
     * Send Email using SendGrid or Laravel Mail.
     */
    protected function sendEmail(User $user, string $templateKey, array $data): void
    {
        $subject = $this->getEmailSubject($templateKey, $user->locale);
        $message = $this->getTemplate($templateKey, $data, $user->locale);

        // Log the email
        Log::info('Email sent', [
            'to' => $user->email,
            'subject' => $subject,
            'message' => $message,
        ]);

        // TODO: Implement actual email sending
        // Mail::to($user->email)->send(new NotificationMail($subject, $message));
    }

    /**
     * Send WhatsApp message using Twilio.
     */
    protected function sendWhatsApp(User $user, string $templateKey, array $data): void
    {
        if (empty(config('services.twilio.sid'))) {
            throw new \Exception('Twilio not configured');
        }

        $message = $this->getTemplate($templateKey, $data, $user->locale);

        // Log the WhatsApp message
        Log::info('WhatsApp sent', [
            'to' => $user->phone,
            'message' => $message,
        ]);

        // TODO: Implement actual Twilio WhatsApp sending
        // $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        // $twilio->messages->create('whatsapp:' . $user->phone, [
        //     'from' => config('services.twilio.whatsapp_from'),
        //     'body' => $message
        // ]);
    }

    /**
     * Get notification template.
     */
    protected function getTemplate(string $key, array $data, string $locale = 'fr'): string
    {
        $templates = $this->getTemplates($locale);

        if (!isset($templates[$key])) {
            return "Template not found: {$key}";
        }

        $template = $templates[$key];

        foreach ($data as $placeholder => $value) {
            $template = str_replace("{{$placeholder}}", $value, $template);
        }

        return $template;
    }

    /**
     * Get email subject for template.
     */
    protected function getEmailSubject(string $key, string $locale = 'fr'): string
    {
        $subjects = [
            'fr' => [
                'insurance_reminder' => 'Rappel: Renouvellement d\'assurance',
                'inspection_reminder' => 'Rappel: Visite technique',
                'payment_success' => 'Confirmation de paiement',
                'payment_failed' => 'Échec du paiement',
            ],
            'en' => [
                'insurance_reminder' => 'Reminder: Insurance Renewal',
                'inspection_reminder' => 'Reminder: Technical Inspection',
                'payment_success' => 'Payment Confirmation',
                'payment_failed' => 'Payment Failed',
            ],
        ];

        return $subjects[$locale][$key] ?? 'E-Auto Gestion Notification';
    }

    /**
     * Get notification templates.
     */
    protected function getTemplates(string $locale = 'fr'): array
    {
        $templates = [
            'fr' => [
                'insurance_reminder' => 'Bonjour {name}, votre assurance pour le véhicule {vehicle} expire le {date}. Pensez à la renouveler !',
                'inspection_reminder' => 'Bonjour {name}, la visite technique de votre véhicule {vehicle} est due le {date}.',
                'payment_success' => 'Bonjour {name}, votre paiement de {amount} FCFA a été reçu avec succès. Merci !',
                'payment_failed' => 'Bonjour {name}, votre paiement de {amount} FCFA a échoué. Veuillez réessayer.',
                'service_request_created' => 'Votre demande de service pour {vehicle} a été créée avec succès.',
            ],
            'en' => [
                'insurance_reminder' => 'Hello {name}, your insurance for vehicle {vehicle} expires on {date}. Please renew it!',
                'inspection_reminder' => 'Hello {name}, the technical inspection of your vehicle {vehicle} is due on {date}.',
                'payment_success' => 'Hello {name}, your payment of {amount} FCFA was received successfully. Thank you!',
                'payment_failed' => 'Hello {name}, your payment of {amount} FCFA has failed. Please try again.',
                'service_request_created' => 'Your service request for {vehicle} has been created successfully.',
            ],
        ];

        return $templates[$locale] ?? $templates['fr'];
    }

    /**
     * Send multiple notifications to a user.
     */
    public function sendMultiple(User $user, array $channels, string $templateKey, array $data = []): array
    {
        $notifications = [];

        foreach ($channels as $channel) {
            $notifications[] = $this->send($user, $channel, $templateKey, $data);
        }

        return $notifications;
    }
}
