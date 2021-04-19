<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GroupMemberUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Group $group)
    {
        $request->validate([
            'email' => 'nullable|email',
            'role' => 'nullable|in:group_owner,group_member',
        ]);

        $email = $request->email;
        $role = $request->role;
        $roleOptions = ['group_owner', 'group_member'];

        return view(
            'groups.members.users.create',
            compact('group', 'email', 'role', 'roleOptions')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        // TODO ロールの設定は別のアクションにして、最初はgroup_memberでもいいかも
        // TODO 存在しないユーザーは招待メールとかから作成する流れにする

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255,unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:group_owner,group_member',
        ]);

        $this->authorize('writeMember', $group);

        $targetUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $member = $group->assignUser($targetUser->id);
        $member->syncRoles([$request->role]);

        if ($request->expectsJson()) {
            return $member;
        }
        return redirect()
            ->route('groups.members.index', $group)
            ->with('success', __('Member is created.'));
    }
}
