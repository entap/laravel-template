<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * グループを取得する
     */
    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }
}
