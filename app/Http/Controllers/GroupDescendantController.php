<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupDescendantController extends Controller
{
    public function index(Group $group)
    {
        return $group->descendants->toTree();
    }
}
