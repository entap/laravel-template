<?php

namespace App\Events\Admin;

use App\Models\DynamicCategory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 動的コンテンツのカテゴリを削除した
 */
class DynamicCategoryDeleted
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
