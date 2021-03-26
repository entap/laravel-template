<?php

namespace App\Events\Admin;

use App\Models\Admin\MailTemplate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * メールテンプレートを削除した
 */
class MailDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $mail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $actor, MailTemplate $mail)
    {
        $this->actor = $actor;
        $this->mail = $mail;
    }
}
