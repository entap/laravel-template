<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
use Illuminate\Http\Request;

class RegisterTemporaryUserController extends Controller
{
    public function create()
    {
        return view('temporary_users.register');
    }

    public function store(Request $request)
    {
        // FIXME emailをユニークにする
        // FIXME emailをusersとも合わせてユニークにする
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
        ]);
        $temporaryUser = TemporaryUser::create($data);

        if ($request->expectsJson()) {
            return $temporaryUser;
        }
        return view('temporary_users.registered', compact('temporaryUser'));
    }
}
