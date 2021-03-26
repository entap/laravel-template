<?php

namespace App\Events;

use App\Models\PackageRelease;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * リリースを削除した
 */
class ReleaseDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $release;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, PackageRelease $release)
    {
        $this->actor = $actor;
        $this->release = $release;
    }
}
