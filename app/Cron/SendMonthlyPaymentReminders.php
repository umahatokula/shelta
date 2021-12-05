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
        // $clientIds = Property::whereBetween('date_of_first_payment', [Carbon::today(), Carbon::today()->addDays(1)])
        // ->orWhereBetween('date_of_first_payment', [Carbon::today(), Carbon::today()->addDays(7)])
        // ->whereNotNull('client_id')
        // ->pluck('client_id');

        // $clients = Client::whereIn('id', $clientIds)->get();

        $clients = Client::whereIn('id', function ($query) {
            $query->select('client_id')
                ->from('properties')
                ->whereBetween('date_of_first_payment', [Carbon::today(), Carbon::today()->addDays(1)])
                ->orWhereBetween('date_of_first_payment', [Carbon::today(), Carbon::today()->addDays(7)])
                ->whereNotNull('client_id')
                ->pluck('client_id');
        })->get();

        foreach ($clients as $client) {
            Mail::to($client)->queue(new SendMonthlyPaymentRemindersMailable($client));
        }
        
    }
    
}