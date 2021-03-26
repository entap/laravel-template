<?php

namespace App\Events;

use App\Models\TemporaryUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * ユーザーを否認した
 */
class UserRejected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $temporaryUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Authenticatable $actor,
        TemporaryUser $temporaryUser
    ) {
        $this->actor = $actor;
        $this->temporaryUser = $temporaryUser;
    }
}
