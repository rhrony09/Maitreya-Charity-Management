<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $schedule->command('queue:work')->everyMinute()->runInBackground();
        $schedule->command('monthly:remainder')->monthlyOn(01, '10:00')->runInBackground();
        $schedule->command('monthly:remainder')->monthlyOn(10, '10:00')->runInBackground();
        $schedule->command('clear:logs')->monthlyOn(01, '00:00')->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
