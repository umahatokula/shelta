<?php

namespace App\Cron;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMonthlyPaymentRemindersMailable;

class SendMonthlyPaymentReminders {
    
    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke () {

        $nextDueDate = Carbon::parse('12/24/2021')->addDays(7);
    
        $properties = App\Models\Property::with('client')
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
            Mail::to($property->client)->queue(new SendMonthlyPaymentRemindersMailable($property));
        }
        
    }
    
}