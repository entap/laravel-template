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
        $this->authorize('readDescendantGroup', $group);

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
        $this->authorize('writeDescendantGroup', $group);

        return view('groups.descendants.create', compact('group'));
    }

    /**
     * 配下のグループを作成する
     */
    public function store(Request $request, Group $group)
    {
        $this->authorize('writeDescendantGroup', $group);

        $validatedData = $request->validate([
            'parent_id' => 'required|exists:groups,id',
            'name' => 'required|string|max:255',
        ]);

        // TODO バリデーションエラーの方がいいか
        abort_unless(
            $group->id == $request->parent_id ||
                $group->descendants()->find($request->parent_id),
            403
        );

        $descendant = $group->descendants()->create($validatedData);

        if ($request->expectsJson()) {
            return $descendant;
        }
        return redirect()->route('groups.descendants.index', $group);
    }

    /**
     * 詳細を表示する
     */
    public function show(Request $request, Group $group, Group $descendant)
    {
        $this->authorize('readDescendantGroup', $group);
        $group->descendants()->findOrFail($descendant->id);

        $members = $descendant->members;
        $roleOptions = collect(['group_owner', 'group_member']);

        return view(
            'groups.descendants.show',
            compact('group', 'descendant', 'members', 'roleOptions')
        );
    }

    /**
     * 編集フォームを表示する
     */
    public function edit(Request $request, Group $group, Group $descendant)
    {
        $this->authorize('writeDescendantGroup', $group);

        $group->descendants()->findOrFail($descendant->id);

        return view('groups.descendants.edit', compact('group', 'descendant'));
    }

    /**
     * 配下のグループを更新する
     */
    public function update(Request $request, Group $group, Group $descendant)
    {
        $this->authorize('writeDescendantGroup', $group);

        $group->descendants()->findOrFail($descendant->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $descendant->update($validatedData);

        return redirect()->route('groups.descendants.index', $group);
    }

    /**
     * 配下のグループを削除する
     */
    public function destroy(Request $request, Group $group, Group $descendant)
    {
        $group->descendants()->findOrFail($descendant->id);

        $this->authorize('writeDescendantGroup', $group);

        $descendant->delete();

        return redirect()->route('groups.descendants.index', $group);
    }
}
