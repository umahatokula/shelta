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


        try {

            $message = 'First instalment for '. $event->transaction?->property?->unique_number;
            $users = User::permission('generate land papers')->get(); // Returns only users with the permission to 'generate land papers';

            foreach ($users as $user) {

                if ($user->staff?->phone) {

                    Helpers::sendSMSMessage($user->staff->phone, $message); // send sms
                    Helpers::firstPaymentNotificationViaWhatsapp($user->staff->phone, $event->transaction?->property); // send whatsapp message
                }

            }

            // MAIL ADMIN
            Mail::to($users)->send(new PropertyFirstPaymentForAdminMailable($event->transaction));

        } catch (\Exception $e) {

            \Log::info($e);

        }
    }
}
