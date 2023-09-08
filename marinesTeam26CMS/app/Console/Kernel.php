<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\UpdatePitBat::class,
        Commands\NewApi::class,
        Commands\TicketApi::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('pitbat:getData')
                 ->dailyAt('4:00');
        $schedule->command('news:api')
                 ->cron('*/'.env('TIME_RUN_API', '1').' * * * *');
        $schedule->command('tickets:api')
                 ->cron('15 * * * *');
        $schedule->command('tickets:api')
                 ->cron('45 * * * *');
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
