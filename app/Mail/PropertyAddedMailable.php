<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PropertyAddedMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $client;
    public $properties;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Client $client, Array $properties)
    {
        $this->properties = $properties;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Property Update')
        ->view('emails.propertyAdded');
    }
}
