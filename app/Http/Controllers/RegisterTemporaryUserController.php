<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterTemporaryUserController extends Controller
{
    public function create()
    {
        return view('temporary_users.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'name' => 'nullable|string|max:255',
        ]);
        // uniqueは上書きされるので分けて実行する
        $request->validate([
            'email' => Rule::unique('temporary_users'),
        ]);

        $temporaryUser = TemporaryUser::create($data);

        if ($request->expectsJson()) {
            return $temporaryUser;
        }
        return view('temporary_users.registered', compact('temporaryUser'));
    }
}
