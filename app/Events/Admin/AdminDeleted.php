<?php

namespace App\Events\Admin;

use App\Models\Admin\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;
    public $admin;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, User $admin)
    {
        $this->actor = $actor;
        $this->admin = $admin;
    }
}
