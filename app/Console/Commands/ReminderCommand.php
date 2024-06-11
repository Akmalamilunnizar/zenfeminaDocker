<?php

namespace App\Console\Commands;

use App\Models\Reminder;
use App\Models\User;
use App\Notifications\BaseNotification;
use App\Service\ReminderService;
use Illuminate\Console\Command;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminder::where('is_on', 1)->pluck('id');
        foreach ($reminders as $reminderId)
        {
            $reminder = Reminder::find($reminderId);
            ReminderService::sendNotification($reminder);
        }
        $this->info('success');
    }
}
