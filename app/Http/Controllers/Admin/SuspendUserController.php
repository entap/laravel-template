<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserSuspended;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuspendUserController extends Controller
{
    public function __invoke(User $user)
    {
        $user->suspend();

        event(new UserSuspended($user));

        return back();
    }
}
