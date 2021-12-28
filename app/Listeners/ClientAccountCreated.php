<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ClientAccountCreatedMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ClientAccountCreated as ClientAccountCreatedEvent;

class ClientAccountCreated
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
     * @param  ClientAccountCreatedEvent  $event
     * @return void
     */
    public function handle(ClientAccountCreatedEvent $event)
    {
        $password = $event->client->generatePassword();
        // create user account
        $user = User::updateOrCreate(
            ['email' =>  $event->client->email],
            [
                'name'      => $event->client->sname.' '.$event->client->onames,
                'client_id' => $event->client->id,
                'password'  => \Hash::make($password),
            ]
        );

        // assign role
        $user->assignRole('client');


        // send email
        Mail::to($event->client->email)
            ->send(new ClientAccountCreatedMailable($event->client, $password));
    }
}
