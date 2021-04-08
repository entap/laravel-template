<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    /**
     * グループに所属するユーザーを一覧する
     */
    public function index(Group $group)
    {
        return $group->users;
    }
}
