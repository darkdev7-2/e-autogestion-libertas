<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Models\Setting;
use App\Services\NotificationService;
use Carbon\Carbon;

class SendRemindersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send {--days= : Days before due date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send automatic reminders for upcoming vehicle deadlines (insurance, inspection, etc.)';

    /**
     * The notification service instance.
     */
    protected NotificationService $notificationService;

    /**
     * Create a new command instance.
     */
    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to send reminders...');

        // Get reminder days from settings or use defaults
        $reminderDays = Setting::getValue('reminder_days', [14, 7, 2]);

        // If specific days option is provided, use it
        if ($this->option('days')) {
            $reminderDays = [(int) $this->option('days')];
        }

        $totalSent = 0;

        foreach ($reminderDays as $days) {
            $sent = $this->sendRemindersForDay($days);
            $totalSent += $sent;
            $this->info("Sent {$sent} reminders for day -{$days}");
        }

        $this->info("Total reminders sent: {$totalSent}");

        return Command::SUCCESS;
    }

    /**
     * Send reminders for a specific number of days before due date.
     */
    protected function sendRemindersForDay(int $days): int
    {
        $targetDate = Carbon::today()->addDays($days);

        // Get pending reminders due on the target date
        $reminders = Reminder::where('status', 'pending')
            ->whereDate('due_at', $targetDate)
            ->with(['vehicle.client.user'])
            ->get();

        $sent = 0;

        foreach ($reminders as $reminder) {
            try {
                $user = $reminder->vehicle->client->user;
                $vehicle = $reminder->vehicle;

                // Prepare notification data
                $data = [
                    'name' => $user->name,
                    'vehicle' => "{$vehicle->brand} {$vehicle->model} ({$vehicle->registration_number})",
                    'date' => $reminder->due_at->format('d/m/Y'),
                    'days' => $days,
                ];

                // Determine template key based on reminder type
                $templateKey = match ($reminder->type) {
                    'insurance' => 'insurance_reminder',
                    'inspection' => 'inspection_reminder',
                    default => 'insurance_reminder',
                };

                // Get notification channels from settings
                $channels = Setting::getValue('notification_channels', ['sms', 'email']);

                // Send notifications
                $this->notificationService->sendMultiple($user, $channels, $templateKey, $data);

                // Update reminder status
                $reminder->update(['status' => 'sent']);

                $sent++;

                $this->line("✓ Reminder sent to {$user->name} for {$vehicle->brand} {$vehicle->model}");
            } catch (\Exception $e) {
                $this->error("✗ Failed to send reminder ID {$reminder->id}: " . $e->getMessage());
            }
        }

        return $sent;
    }
}
