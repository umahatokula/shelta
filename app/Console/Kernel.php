<?php

namespace App\Console;

use App\Models\PaymentDefaultSetting;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\Property;
use App\Services\Services;
use App\Models\PaymentDefault;
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
        $schedule->call(new SendMonthlyPaymentReminders)->everyMinute();

        // get payment defaulters
        $schedule->call(function () {

            $dueProperties = (new Property())->getPropertiesDueForReminder(-1);

            $yestedaysTransactions = Transaction::whereDate('instalment_date', Carbon::yesterday())->isApproved()->pluck('property_id')->toArray();

            $pastDueProperties = $dueProperties->filter(function ($property) use($yestedaysTransactions) {
                return !in_array($property->id, $yestedaysTransactions);
            });

            // get default %
            $default_percentage = !PaymentDefaultSetting::first() ? 0 : PaymentDefaultSetting::first()->default_percentage;

            $inserts = [];
            foreach ($pastDueProperties as $property) {

                $defaultAmount = $property->getMonthlyPaymentAmount() * ($default_percentage / 100);

                // if ($defaultAmount > 0) {
                $inserts[] = [
                    'client_id'             => $property->client_id,
                    'property_id'           => $property->id,
                    'default_amount'        => $defaultAmount,
                    'missed_date'           => Carbon::yesterday(),
                    'created_at'            => Carbon::now(),
                    'updated_at'            => Carbon::now(),
                    'defaulters_group_id'   => PaymentDefault::getDefaultersGroup($property),
                ];
                // }

            }

            PaymentDefault::insert($inserts);

        })
            ->at('01:00')
//            ->everyMinute()
            ->when(function () {
                $days = range(2, 29);
                $today = Carbon::today();

                return in_array($today->day, $days);
            });;
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
