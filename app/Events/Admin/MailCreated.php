<?php

namespace App\Events\Admin;

use App\Models\Admin\MailTemplate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * メールテンプレートを作成した
 */
class MailCreated
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
