<?php

namespace App\Listeners;

use App\Events\FirstPaymentMade;
use App\Events\NotifyLegal;
use App\Events\PaymentComplete;
use App\Models\User;
use App\Helpers\Helpers;
use App\Events\PaymentMade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\PropertyPaymentCompleteForAdminMailable;
use App\Mail\PropertyPaymentCompleteForClientMailable;

class CompletePaymentNotification implements ShouldQueue
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
     * @param $event
     * @return void
     */
    public function handle($event)
    {

        $property = $event->transaction->property;

        if (!$property->date_of_first_payment) {

            event(new FirstPaymentMade($event->transaction));
        }

        if (\intval($property->totalPaid()) >= \intval($property->getPropertyPrice())) {

            event(new PaymentComplete($event->transaction));
        }


    }
}
