<?php

namespace App\Events;

use App\Models\UserSegment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * ユーザーセグメントを削除した
 */
class UserSegmentDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $userSegment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Authenticatable $actor,
        UserSegment $userSegment
    ) {
        $this->actor = $actor;
        $this->userSegment = $userSegment;
    }
}
