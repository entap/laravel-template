<?php

namespace App\Listeners;

use App\Models\LogAdminActionEntry;
use App\Facades\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminActionLogger
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // public function handleUserCreated(UserCreated $event)
    // {
    //     LogAdminActionEntry::create([
    //         'admin_user_id' => optional(Admin::user())->id,
    //         'action' => 'users.created',
    //     ]);
    // }

    public function subscribe($events)
    {
        // $events->listen(UserCreated::class, [self::class, 'handleUserCreated']);
    }
}
