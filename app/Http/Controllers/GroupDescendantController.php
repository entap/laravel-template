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
