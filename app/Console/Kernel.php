<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('data link')->everyTenMinutes()->appendOutputTo(storage_path().'/logs/laravel_output.log');
        $schedule->command('data percentage')->everyTenMinutes()->appendOutputTo(storage_path().'/logs/laravel_output.log');
        $schedule->command('data truncate')->dailyAt("01:00")->appendOutputTo(storage_path().'/logs/laravel_output.log');
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
