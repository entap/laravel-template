<?php

namespace App\Events\Auth\Firebase;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Firebaseでログインした
 */
class Login
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $guard;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $guard, Authenticatable $user)
    {
        $this->guard = $guard;
        $this->user = $user;
    }
}
