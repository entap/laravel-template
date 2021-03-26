<?php

namespace App\Events;

use App\Models\PackageRelease;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * リリースを作成した
 */
class ReleaseCreated
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
