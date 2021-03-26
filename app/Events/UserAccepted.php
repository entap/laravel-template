<?php

namespace App\Events;

use App\Models\TemporaryUser;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * ユーザーを承認した
 */
class UserAccepted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $temporaryUser;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Authenticatable $actor,
        TemporaryUser $temporaryUser,
        User $user
    ) {
        $this->actor = $actor;
        $this->temporaryUser = $temporaryUser;
        $this->user = $user;
    }
}
