<?php

namespace App\Console;

use App\Console\Commands\CheckFastingCommand;
use App\Console\Commands\DeleteUserCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        DeleteUserCommand::class,
        CheckFastingCommand::class
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('app:delete-user')->daily()->at('00:00');
         $schedule->command('app:check-fasting-command')->daily()->at('00:00');
         $schedule->command('app:reminder-command')->everySecond();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
