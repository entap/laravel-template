<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupMemberController extends Controller
{
    /**
     * メンバーを一覧する
     */
    public function index(Request $request, Group $group)
    {
        $this->authorize('readMember', $group);

        if ($request->expectsJson()) {
            return $group->members;
        }
        return view('groups.members.index', [
            'group' => $group,
            'members' => $group->members,
        ]);
    }

    /**
     * 招待フォームを表示する
     */
    public function create(Request $request, Group $group)
    {
        $roleOptions = ['group_owner', 'group_member'];
        return view('groups.members.invite', compact('group', 'roleOptions'));
    }

    /**
     * ユーザーを招待する
     */
    public function store(Request $request, Group $group)
    {
        // TODO ロールの設定は別のアクションにして、最初はgroup_memberでもいいかも
        // TODO 存在しないユーザーは招待メールとかから作成する流れにする

        $request->validate([
            'email' => 'required|exists:users,email',
            'role' => 'required|in:group_owner,group_member',
        ]);

        $this->authorize('writeMember', $group);

        $targetUser = User::findByEmail($request->email);
        $member = $group->getUser($targetUser->id);
        if (empty($member)) {
            $member = $group->assignUser($targetUser->id);
            $member->syncRoles([$request->role]);
        }

        // TODO すでに存在する場合はflashでメッセージを表示する

        if ($request->expectsJson()) {
            return $member;
        }
        return redirect()
            ->route('groups.members.index', $group)
            ->with('success', __('Member is invisted.'));
    }

    /**
     * メンバーを取得する
     */
    public function show(Group $group, GroupMember $member)
    {
        $this->authorize('readMember', $group);

        return $member;
    }
}
