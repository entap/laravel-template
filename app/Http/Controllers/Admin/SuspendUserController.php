<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserSuspended;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuspendUserController extends Controller
{
    public function showSuspendForm(User $user)
    {
        return view('admin.users.suspend', compact('user'));
    }

    public function suspend(Request $request, User $user)
    {
        $data = $request->validate([
            'suspending_reason' => 'nullable|string',
        ]);
        $user->suspend($data['suspending_reason']);

        event(new UserSuspended($user));

        return view('admin.users.show', compact('user'));
    }
}
