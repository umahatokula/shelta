<?php

namespace App\Listeners;

use App\Events\PaymentComplete;
use App\Helpers\Helpers;
use App\Mail\PropertyPaymentCompleteForAdminMailable;
use App\Mail\PropertyPaymentCompleteForClientMailable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NotifyLegalAboutPaymentCompleteListener implements ShouldQueue
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
     * @param  \App\Events\PaymentComplete  $event
     * @return void
     */
    public function handle(PaymentComplete $event)
    {


        try {

            $message = 'Payment complete for '. $event->transaction?->property?->unique_number;
            $users = User::permission('generate land papers')->get(); // Returns only users with the permission to 'generate land papers';

            foreach ($users as $user) {

                if ($user->staff?->phone) {

                    Helpers::sendSMSMessage($user->staff->phone, $message); // send sms
                    Helpers::sendWhatsAppMessage($user->staff->phone, $message); // send whatsapp message
                }

            }

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
