<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupDescendantMemberController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group, Group $descendant)
    {
        $this->authorize('writeDescendantGroup', $group);
        $group->descendants()->findOrFail($descendant->id);

        $memberOptions = $group
            ->members()
            ->whereNotIn('user_id', $descendant->members->pluck('user_id'))
            ->get();

        // TODO 候補になるメンバーがいなかったら追加できないので、戻ってもいいかも

        return view(
            'groups.descendants.members.create',
            compact('group', 'descendant', 'memberOptions')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group, Group $descendant)
    {
        $this->authorize('writeDescendantGroup', $group);
        $group->descendants()->findOrFail($descendant->id);

        $request->validate([
            'member_id' => [
                'required',
                function ($memberId) use ($group) {
                    return $group->members()->exists($memberId);
                },
            ],
        ]);

        $member = $group->members()->find($request->member_id);
        $descendant->assignUser($member->user_id);

        return redirect()->route('groups.descendants.show', [
            $group,
            $descendant,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Group $group,
        Group $descendant,
        GroupMember $member
    ) {
        $this->authorize('writeDescendantGroup', $group);
        $group->descendants()->findOrFail($descendant->id);
        $descendant->members()->findOrFail($member->id);

        $member->delete();

        return redirect()->route('groups.descendants.show', [
            $group,
            $descendant,
        ]);
    }
}
