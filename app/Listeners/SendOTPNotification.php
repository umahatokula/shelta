<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\SendOPT;
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
    public function handle(OPTGenerated $OPTGenerated)
    {
        // dd(to($OPTGenerated->recipients->email));
        Mail::to($OPTGenerated->recipients->email)
            ->send(new SendOPT($OPTGenerated->content));

        // if ($OPTGenerated->recipients->client) {
        //   $phone_number = $OPTGenerated->recipients->client->phone;

        //   if ($phone_number) {
        //     User::sendMessage($OPTGenerated->content, $phone_number);
        //   }

        // }

    }
}
