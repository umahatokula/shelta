<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\Log;

class LogEmail
{
    public function handle(MessageSending $event) {
        $message = $event->message;

        // The Swift_Message has a __toString method so you should be able to log it ;)
        Log::info($message);
    }
}
