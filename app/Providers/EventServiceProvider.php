<?php

namespace App\Providers;

use App\Events\OPTGenerated;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendOTPNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OPTGenerated::class => [
            SendOTPNotification::class
        ],
        'App\Events\PaymentMade' => [
            'App\Listeners\SendReceiptNotification'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
