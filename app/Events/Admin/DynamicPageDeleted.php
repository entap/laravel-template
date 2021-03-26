<?php

namespace App\Events\Admin;

use App\Models\DynamicPage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 動的コンテンツを削除した
 */
class DynamicPageDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $page;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, DynamicPage $page)
    {
        $this->actor = $actor;
        $this->page = $page;
    }
}
