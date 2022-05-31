<?php

namespace App\Listeners;

use Log;
use App\Mail\PropertyAddedMailable;
use Illuminate\Support\Facades\Mail;
use App\Events\ClientPropertiesUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPropertyAssignedNotification implements ShouldQueue
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
     * @param  ClientPropertiesUpdated  $event
     * @return void
     */
    public function handle(ClientPropertiesUpdated $event)
    {
        Mail::to($event->client->email)
            ->send(new PropertyAddedMailable($event->client, $event->properties));
    }
}
