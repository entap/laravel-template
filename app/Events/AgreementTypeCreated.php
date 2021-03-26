<?php

namespace App\Events;

use App\Models\AgreementType;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * 規約タイプを作成した
 */
class AgreementTypeCreated
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
