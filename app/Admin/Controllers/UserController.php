<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Admin\Controllers\Controller;
use App\Http\Requests\UserQueryRequest;
use App\Query\Services\UserQueryService;

class UserController extends Controller
{
    private $users;

    public function __construct(UserQueryService $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    public function index(UserQueryRequest $request)
    {
        $users = $this->users
            ->query($request->validated())
            ->latest()
            ->paginate();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['devices']);
        return view('admin.users.show', compact('user'));
    }
}
