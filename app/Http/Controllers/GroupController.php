<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * 自分が所属するグループを一覧する
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('groups.index', [
            'groups' => $user->groups,
        ]);
    }

    /**
     * グループを取得する
     */
    public function show(Group $group)
    {
        $this->authorize('read', $group);

        return view('groups.show', compact('group'));
    }
}
