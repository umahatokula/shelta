<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Property;
use App\Services\Services;
use App\Models\PaymentDefault;
use App\Cron\SendMonthlyPaymentReminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->call(new SendMonthlyPaymentReminders)->dailyAt('20:00');

        // send payment due reminders
        $schedule->call(new SendMonthlyPaymentReminders)->dailyAt('10:00');

        // get payment defaulters
        $schedule->call(function () {

            $pastDueProperties = Services::getPaymentDefaulters();

            $inserts = [];
            foreach ($pastDueProperties as $property) {

                $defaultAmount = $property->getMonthlyPaymentAmount() * DEFAULT_PENALTY_PERCENTAGE;

                // if ($defaultAmount > 0) {
                    $inserts[] = [
                        'client_id'      => $property->client_id,
                        'property_id'    => $property->id,
                        'default_amount' => $defaultAmount,
                        'missed_date'    => $property->next_due_date,
                        'created_at'     => Carbon::now(),
                        'updated_at'     => Carbon::now(),
                    ];
                // }

            }

            PaymentDefault::insert($inserts);

        })->dailyAt('01:00');
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
