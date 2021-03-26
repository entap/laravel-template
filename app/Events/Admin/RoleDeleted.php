<?php

namespace App\Events\Admin;

use App\Models\Admin\Role;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * ロールを削除した
 */
class RoleDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $role;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, Role $role)
    {
        $this->actor = $actor;
        $this->role = $role;
    }
}
