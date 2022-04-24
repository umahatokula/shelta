<?php

namespace App\Listeners;

use App\Models\User;
use App\Helpers\Helpers;
use App\Events\PaymentMade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\PropertyPaymentCompleteForAdminMailable;
use App\Mail\PropertyPaymentCompleteForClientMailable;

class CompletePaymentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentMade  $event
     * @return void
     */
    public function handle(PaymentMade $event)
    {
        $paymentIsComplete = false;
        $property = $event->transaction->property;
        if (\intval($property->totalPaid()) >= \intval($property->getPropertyPrice())) {
            $paymentIsComplete = true;
        }



        if ($paymentIsComplete) {

            $message = 'Payment completed';
            // $users = User::permission('generate land papers')->get(); // Returns only users with the permission to 'generate land papers';
            $users = User::skip(1)->take(3)->whereNull('client_id')->get();
            // dd($users);

            foreach ($users as $user) {

                // ===========SNED SMS===============
                $receiverNumber = $user->client->phone;

                if ($receiverNumber) {
                    Helpers::sendSMSMessage($receiverNumber, $message); // send sms
                }
            }


            // ===========SNED EMAIL===============
            try {

                // MAIL ADMIN
                Mail::to($users)
                    ->send(new PropertyPaymentCompleteForAdminMailable($event->transaction));

                // MAIL CLIENT
                Mail::to($event->transaction->client)
                    ->send(new PropertyPaymentCompleteForClientMailable($event->transaction));
                    

            } catch (\Exception $e) {

                \Log::info($e);

            }

        }

    }
}
