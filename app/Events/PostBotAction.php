<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Response;

class PostBotAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thread_id;
    public $command;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Int $thread_id, String $command)
    {
        $this->thread_id = $thread_id;
        $this->command = $command;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post-bot-action');
    }
}
