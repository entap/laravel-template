<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupDescendantController extends Controller
{
    /**
     * 配下のグループを一覧する
     */
    public function index(Request $request, Group $group)
    {
        if ($request->expectsJson()) {
            return $group->descendants->toTree();
        }
        return view('groups.descendants.index', compact('group'));
    }

    /**
     * 作成フォームを表示する
     */
    public function create(Request $request, Group $group)
    {
        return view('groups.descendants.create', compact('group'));
    }

    /**
     * 配下のグループを作成する
     */
    public function store(Request $request, Group $group)
    {
        $request->validate([
            'parent_id' => 'required|exists:groups,id',
            'name' => 'required|string|max:255',
        ]);

        $this->authorize('writeDescendantGroup', $group);

        abort_unless(
            $group->id == $request->parent_id ||
                $group->descendants()->find($request->parent_id),
            403
        );

        $group->descendants()->create($request->all());

        return redirect()->route('groups.descendants.index', $group);
    }

    /**
     * 配下のグループにユーザーを追加する
     */
    public function assign(Request $request, Group $group, string $descendant)
    {
        // TODO コントローラーを分ける

        $descendant = $group->descendants()->findOrFail($descendant);
        $this->authorize('writeDescendantMember', $group);

        $request->validate([
            'member_id' => ['required'],
        ]);
        $parentMember = $group->members()->find($request->member_id);

        $descendant->assignUser($parentMember->user_id);
    }
}
