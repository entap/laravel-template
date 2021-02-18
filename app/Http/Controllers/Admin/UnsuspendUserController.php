<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UnsuspendUserController extends Controller
{
    public function __invoke(User $user)
    {
        $user->unsuspend();

        return back();
    }
}
