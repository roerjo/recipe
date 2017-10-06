<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RecipeCreatedOrUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $recipe;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($recipe, $request)
    {
        $this->recipe = $recipe;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
