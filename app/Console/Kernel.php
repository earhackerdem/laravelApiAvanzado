<?php

namespace App\Console;

use App\Console\Commands\SendEmailVerificationReminderCommand;
use App\Console\Commands\SendNewsletterCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        SendNewsletterCommand::class,
        SendEmailVerificationReminderCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('inspire')
            ->sendOutputTo(storage_path('inspire.log'))
            ->hourly();

        $schedule->call(function () {
            echo 'Test';
        })->everyMinute()
            ->evenInMaintenanceMode();

        $schedule->command('send:newsletter --schedule')
            ->onOneServer()
            ->withoutOverlapping()
            ->everyMinute();

        $schedule->command('send:reminder', ['api'])
            ->onOneServer()
            ->withoutOverlapping()
            ->everyMinute();
        //run with php artisan schedule:run
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
