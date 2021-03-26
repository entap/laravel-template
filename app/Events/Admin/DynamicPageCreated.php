<?php

namespace App\Events\Admin;

use App\Models\DynamicPage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * 動的コンテンツを作成した
 */
class DynamicPageCreated
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
