<?php

namespace App\Listeners;

use App\Events\FirstPaymentMade;
use App\Events\PaymentComplete;
use App\Events\PaymentMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentMadeListener
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
     * @param  \App\Events\PaymentMade  $event
     * @return void
     */
    public function handle($event)
    {

        $property = $event->transaction->property;

        if ($event->transaction->is_first_instalment) {

            event(new FirstPaymentMade($event->transaction));
        }

        if (\intval($property->totalPaid()) >= \intval($property->getPropertyPrice())) {

            event(new PaymentComplete($event->transaction));
        }
    }
}
