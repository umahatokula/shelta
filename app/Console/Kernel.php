<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Property;
use App\Models\PaymentDefault;
use App\Cron\SendMonthlyPaymentReminders;
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
        // $schedule->call(new SendMonthlyPaymentReminders)->dailyAt('20:00');

        // send payment due reminders
        $schedule->call(new SendMonthlyPaymentReminders)->everyMinute();
        
        // get payment defaulters
        $schedule->call(function () {
            
            $pastDueProperties = Property::where(function($query) {
                return $query->whereDay('date_of_first_payment', '=', Carbon::yesterday()->format('d'));
            })
            ->whereNotIn('id', function ($query) {
                $query->select('transactions.property_id') // get all previous day's transactions
                    ->from('transactions')
                    ->whereDate('transactions.date', '=', Carbon::yesterday());
            })->get();

            $inserts = [];
            foreach ($pastDueProperties as $property) {

                $defaultAmount = $property->getMonthlyPaymentAmount() * 0.2;

                if ($defaultAmount > 0) {
                    $inserts[] = [
                        'client_id'      => $property->client_id,
                        'property_id'    => $property->id,
                        'default_amount' => $defaultAmount,
                        'created_at'     => Carbon::now(),
                        'updated_at'     => Carbon::now(),
                    ];
                }
                
            }

            PaymentDefault::insert($inserts);

        })->everyMinute();
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
