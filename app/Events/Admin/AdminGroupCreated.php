<?php

namespace App\Events\Admin;

use App\Models\Admin\UserGroup;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * 管理グループを作成した
 */
class AdminGroupCreated
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
