<?php

namespace App\Events;

use App\Models\AgreementType;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 規約タイプを削除した
 */
class AgreementTypeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actor;

    public $agreementType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Authenticatable $actor,
        AgreementType $agreementType
    ) {
        $this->actor = $actor;
        $this->agreementType = $agreementType;
    }
}
