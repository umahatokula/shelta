<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\SendOPT;
use App\Helpers\Helpers;
use App\Events\OPTGenerated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOTPNotification
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
     * @param  SendOPT  $event
     * @return void
     */
    public function handle(OPTGenerated $event)
    {
        try {
            Mail::to($event->user->email)
            ->send(new SendOPT($event->content));
        } catch (\Exception $e) {
            \Log::info($e);
        }
    
        // ===========SNED SMS===============
        $message = $event->content;
        $receiverNumber = null;

        if ($event->user->hasRole('staff')) {

            if ($event->user->staff) {
                $receiverNumber = $event->user->staff->phone;
            }
            
        }

        if ($event->user->hasRole('client')) {

            if ($event->user->client) {
                $receiverNumber = $event->user->client->phone;
            }

        }

        if ($receiverNumber) {
            Helpers::sendSMSMessage($receiverNumber, $message); // send sms
        }

    }
}
