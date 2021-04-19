<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupMemberRoleController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, GroupMember $member)
    {
        $this->authorize('writeMember', $group);
        $group->members()->findOrFail($member->id);

        $request->validate([
            'role' => 'required|in:group_owner,group_member',
        ]);

        $member->syncRoles([$request->role]);

        return redirect()
            ->route('groups.members.index', $group)
            ->with(
                'message',
                "{$member->name} の権限を {$request->role} に変更しました。"
            );
    }
}
