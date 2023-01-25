<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Option;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:flush')->weekly();

        $schedule->command('queue:restart')->hourly();

        $schedule->command('clear-cache')->weekly();

        $schedule->command('logs:clean')->dailyAt('1:00');

        $schedule->command('queue:work --daemon --sleep=3 --tries=3')
                    ->everyMinute()
                    ->withoutOverlapping()
                    ->sendOutputTo(storage_path().'/logs/queue-jobs.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        if (empty($_SERVER['SERVER_NAME'])) {
            $_SERVER['SERVER_NAME'] = parse_url(config('app.url'), PHP_URL_HOST);
        }

        require base_path('routes/console.php');
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return date_default_timezone_get();
    }
}
