<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
use Illuminate\Http\Request;

class TemporaryUserController extends Controller
{
    public function index()
    {
        $users = TemporaryUser::pending()
            ->latest()
            ->paginate();

        return view('admin.temporary_users.index', compact('users'));
    }
}
