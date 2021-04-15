<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GroupUserController extends Controller
{
    /**
     * 招待フォームを表示する
     */
    public function showInviteForm(Request $request, Group $group)
    {
        $roleOptions = [
            'group_owner',
            'group_member',
        ];
        return view('groups.members.invite', compact('group', 'roleOptions'));
    }

    /**
     * ユーザーを招待する
     */
    public function invite(Request $request, Group $group)
    {
        // TODO ロールの設定は別のアクションにして、最初はgroup_memberでもいいかも
        // TODO 存在しないユーザーは招待メールとかから作成する流れにする

        $request->validate([
            'email' => 'required|exists:users,email',
            'role' => 'required|in:group_owner,group_member',
        ]);

        $this->authorize('writeMember', $group);

        $targetUser = User::findByEmail($request->email);
        $member =$group->getUser($targetUser->id);
        if (empty($member)) {
            $member = $group->assignUser($targetUser->id);
            $member->syncRoles([$request->role]);
        }

        if ($request->expectsJson()) {
            return $member;
        }
        return redirect()->route('groups.members.index', $group)->with('success', __('Member is invisted.'));
    }
}
