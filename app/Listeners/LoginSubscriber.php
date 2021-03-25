<?php

namespace App\Listeners;

use App\Events\Auth\Firebase\Login as FirebaseLogin;
use App\Events\Auth\Line\Login as LineLogin;
use App\Models\LogUserLoginEntry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class LoginSubscriber
{
    public function handleLineLogin(LineLogin $event)
    {
        LogUserLoginEntry::log($event->user, 'line');
    }

    public function handleFirebaseLogin(FirebaseLogin $event)
    {
        LogUserLoginEntry::log($event->user, 'firebase');
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(LineLogin::class, [self::class, 'handleLineLogin']);
        $events->listen(FirebaseLogin::class, [
            self::class,
            'handleFirebaseLogin',
        ]);
    }
}
