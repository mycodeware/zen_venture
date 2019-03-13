<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification:request')
                 ->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('notification:identify')
                 ->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('backup:db_public')
                 ->dailyAt('02:00')->runInBackground()->environments(['production']);
        $schedule->command('update:pv')
                 ->dailyAt('03:00')->runInBackground()->environments(['production', 'staging']);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
