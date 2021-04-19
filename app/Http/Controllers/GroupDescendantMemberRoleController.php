<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupDescendantMemberRoleController extends Controller
{
    /**
     * 配下のグループのメンバーのロールを変更する
     */
    public function update(
        Request $request,
        Group $group,
        Group $descendant,
        GroupMember $member
    ) {
        $this->authorize('writeDescendantGroup', $group);
        $group->descendants()->findOrFail($descendant->id);
        $descendant->members()->findOrFail($member->id);

        $request->validate([
            'role' => 'required|in:group_owner,group_member',
        ]);

        $member->syncRoles([$request->role]);

        return redirect()->route('groups.descendants.show', [
            $group,
            $descendant,
        ]);
    }
}
