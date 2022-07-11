<?php

namespace App\Console;

use App\Cron\PaymentDefaulters;
use Carbon\Carbon;
use App\Cron\SendMonthlyPaymentReminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

define('DEFAULT_PENALTY_PERCENTAGE', 0);

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

        $schedule->call(function () {
            Log::info(Carbon::now());
        })->everyMinute();

        $schedule->command('backup:run --only-db --only-to-disk=dropbox')->daily()->at('01:00');

        // send payment due reminders
        $schedule->call(function() {
            (new SendMonthlyPaymentReminders)->viaWhatsapp();
        })->dailyAt('10:00');

        $schedule->call(function() {
            (new SendMonthlyPaymentReminders)->viaSMS();
        })->dailyAt('12:00');

        $schedule->call(function() {
            (new SendMonthlyPaymentReminders)->viaEmail();
        })->dailyAt('15:00');

        // get payment defaulters
        $schedule->call(function () {

            PaymentDefaulters::recordDefaulters();

        })
            ->at('01:00')
            ->when(function () {
                $days = range(2, 29);
                $today = Carbon::today();

                return in_array($today->day, $days);
            });
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
