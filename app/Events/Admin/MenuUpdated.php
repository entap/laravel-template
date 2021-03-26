<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * メニューを更新した
 */
class MenuUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor)
    {
        $this->actor = $actor;
    }
}
