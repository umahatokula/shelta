<?php

namespace App\Listeners;

use App\Events\PaymentMade;
use App\Mail\PaymentMadeMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentMadeNotification;
use PDF;

class SendReceiptNotification implements ShouldQueue
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
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->transaction->client, new PaymentMadeNotification($event->transaction));
    }
}
