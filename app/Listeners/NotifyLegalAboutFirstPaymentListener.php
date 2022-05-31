<?php

namespace App\Listeners;

use App\Events\FirstPaymentMade;
use App\Helpers\Helpers;
use App\Mail\PropertyFirstPaymentForAdminMailable;
use App\Mail\PropertyPaymentCompleteForAdminMailable;
use App\Mail\PropertyPaymentCompleteForClientMailable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyLegalAboutFirstPaymentListener implements ShouldQueue
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
     * @param  \App\Events\FirstPaymentMade  $event
     * @return void
     */
    public function handle(FirstPaymentMade $event)
    {

        $message = $event->message;
        $users = User::permission('generate land papers')->get(); // Returns only users with the permission to 'generate land papers';


        $receiverNumbers = $users->pluck('phone')->toArray();
        Helpers::sendSMSMessage($receiverNumbers, $message); // send sms
        Helpers::sendWhatsAppMessage($receiverNumbers, $message); // send whatsapp message


        // ===========SNED EMAIL===============
        try {

            // MAIL ADMIN
            Mail::to($users)->send(new PropertyFirstPaymentForAdminMailable($event->transaction));


        } catch (\Exception $e) {

            \Log::info($e);

        }
    }
}
