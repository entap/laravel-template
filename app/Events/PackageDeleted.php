<?php

namespace App\Events;

use App\Models\Package;
use Illuminate\Auth\Authenticatable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * パッケージを削除した
 */
class PackageDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $package;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, Package $package)
    {
        $this->actor = $actor;
        $this->package = $package;
    }
}
