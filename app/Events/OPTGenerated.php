<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OPTGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;
    public $user;
    public $otp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($content, $user, $otp)
    {
        $this->content = $content;
        $this->user = $user;
        $this->otp = $otp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
