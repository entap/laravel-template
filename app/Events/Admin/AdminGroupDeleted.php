<?php

namespace App\Events\Admin;

use App\Models\Admin\UserGroup;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 管理グループを削除した
 */
class AdminGroupDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $adminGroup;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, UserGroup $adminGroup)
    {
        $this->actor = $actor;
        $this->adminGroup = $adminGroup;
    }
}
