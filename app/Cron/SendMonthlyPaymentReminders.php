<?php

namespace App\Cron;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
use App\Models\PaymentReminderSetting;
use Illuminate\Support\Facades\Notification;
use App\Mail\SendMonthlyPaymentRemindersMailable;
use App\Notifications\PaymentReminderNotification;

class SendMonthlyPaymentReminders {
    
    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke () {

        $paymentReminderDates = PaymentReminderSetting::all();

        foreach ($paymentReminderDates as $paymentReminderDate) {

            $nextDueDate = Carbon::today()->addDays($paymentReminderDate->number_of_days_before_due_date);
            // dd($nextDueDate);
        
            $properties = Property::with('client')
                ->whereNotNull('client_id')
                ->whereNotNull('date_of_first_payment')
                ->get()
                ->filter(function ($property, $key) use($nextDueDate) {
                    
                    $day = 28;
                    if ($property->date_of_first_payment->day < 28) {
                        $day = $property->date_of_first_payment->day;
                    }
        
                    $dueDate = 28;
                    if ($nextDueDate->day < 28) {
                        $dueDate = $nextDueDate->day;
                    }
        
                    return $day == $dueDate;
                })
                ->filter(function ($property, $key) {
                    return $property->transactionTotal() < $property->estatePropertyType->price;
                });

            foreach ($properties as $property) {
                Notification::send($property->client, new PaymentReminderNotification($property, $paymentReminderDate->message));
            }
        }
        
    }
    
}