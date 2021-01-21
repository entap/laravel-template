<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Controllers\Controller;
use App\Query\Services\UserQueryService;

class UserController extends Controller
{
    private $users;

    public function __construct(UserQueryService $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $this->users->query($request->all())->paginate();

        return view('admin.users.index', compact('users'));
    }
}
