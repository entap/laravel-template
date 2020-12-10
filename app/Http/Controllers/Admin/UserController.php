<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Query\Services\UserQueryService;

class UserController extends Controller
{
    private $users;

    public function __construct(UserQueryService $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $this->users->query($request->all())->get();
        return view('admin.users.index', compact('users'));
    }
}
