<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupMemberController extends Controller
{
    /**
     * メンバーを取得する
     */
    public function show(Group $group, GroupMember $member)
    {
        //
    }
}
