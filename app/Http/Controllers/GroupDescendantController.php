<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupDescendantController extends Controller
{
    /**
     * 配下のグループを一覧する
     */
    public function index(Group $group)
    {
        return $group->descendants->toTree();
    }

    /**
     * 配下のグループにユーザーを追加する
     */
    public function assign(Request $request, Group $group, Group $descendant)
    {
        $this->authorize('writeDescendantMember', [$group, $descendant]);

        $request->validate([
            'member_id' => ['required'],
        ]);
        $parentMember = $group->members()->find($request->member_id);

        $descendant->assignUser($parentMember->user_id);
    }
}
