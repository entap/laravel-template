<?php

namespace App\Events\Admin;

use App\Models\DynamicCategory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * 動的コンテンツのカテゴリを作成した
 */
class DynamicCategoryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $category;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Authenticatable $actor,
        DynamicCategory $category
    ) {
        $this->actor = $actor;
        $this->category = $category;
    }
}
