<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentWasCreated
{
    use Dispatchable, SerializesModels;
    public $comment;
    public $body;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment,$body)
    {
        $this->comment = $comment;
        $this->body=$body;
    }
}
