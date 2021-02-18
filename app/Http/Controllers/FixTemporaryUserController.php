<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RejectedTemporaryUser;

class FixTemporaryUserController extends Controller
{
    public function edit(RejectedTemporaryUser $rejectedTemporaryUser)
    {
        $temporaryUser = $rejectedTemporaryUser->temporaryUser;

        return view(
            'temporary_users.fix',
            compact('temporaryUser', 'rejectedTemporaryUser')
        );
    }

    public function update(
        Request $request,
        RejectedTemporaryUser $rejectedTemporaryUser
    ) {
        $temporaryUser = $rejectedTemporaryUser->temporaryUser;
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'name' => 'nullable|string|max:255',
        ]);
        // uniqueは上書きされるので分けて実行する
        $request->validate([
            'email' => Rule::unique('temporary_users')->ignore($temporaryUser),
        ]);

        DB::transaction(function () use ($data, $temporaryUser) {
            $temporaryUser->update($data);
            $temporaryUser->rejectedTemporaryUsers()->delete();
        });

        if ($request->expectsJson()) {
            return $temporaryUser;
        }
        return view('temporary_users.fixed', compact('temporaryUser'));
    }
}
