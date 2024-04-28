<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActionWasCreated
{
    use Dispatchable, SerializesModels;

    public $type_event;
    public $description;
    public $user_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type_event,$description,$user_id)
    {
        $this->type_event=$type_event;
        $this->description=$description;
        $this->user_id=$user_id;
    }

}
