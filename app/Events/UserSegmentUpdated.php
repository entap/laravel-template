<?php

namespace App\Events;

use App\Models\UserSegment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * ユーザーセグメントを更新した
 */
class UserSegmentUpdated
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
