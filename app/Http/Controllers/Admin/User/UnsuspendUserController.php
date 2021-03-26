<?php

namespace App\Http\Controllers\Admin\User;

use App\Events\UserUnsuspended;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UnsuspendUserController extends Controller
{
    /**
     * 凍結を解除する
     */
    public function __invoke(User $user)
    {
        if ($user->isSuspended()) {
            $user->unsuspend();
            $this->unsuspended($user);
        }

        return back();
    }

    /**
     * 凍結を解除した
     */
    protected function unsuspended(User $user)
    {
        event(new UserUnsuspended(request()->user(), $user));
    }
}
