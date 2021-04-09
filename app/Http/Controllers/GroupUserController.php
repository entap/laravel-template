<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    /**
     * グループに所属するユーザーを一覧する
     */
    public function index(Group $group)
    {
        return $group->users;
    }

    /**
     * ユーザーを招待する
     */
    public function invite(Request $request, Group $group)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'role' => 'required|in:group_owner,group_member',
        ]);
        $targetUser = User::findByEmail($request->email);

        if ($group->hasUser($targetUser->id)) {
            return;
        }

        $member = $group->assignUser($targetUser->id);
        $member->syncRoles([$request->role]);
    }
}
