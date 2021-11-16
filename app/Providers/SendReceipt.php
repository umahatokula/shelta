<?php

namespace App\Providers;

use App\Providers\PaymentMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReceipt
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
        //
    }
}
