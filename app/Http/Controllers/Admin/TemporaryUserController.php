<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TemporaryUser;
use App\Http\Controllers\Admin\Controller;

class TemporaryUserController extends Controller
{
    /**
     * 一覧
     */
    public function index()
    {
        $users = TemporaryUser::pending()
            ->latest()
            ->paginate();

        return view('admin.temporary_users.index', compact('users'));
    }
}
