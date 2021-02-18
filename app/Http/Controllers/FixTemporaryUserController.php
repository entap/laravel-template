<?php

namespace App\Http\Controllers;

use App\Models\RejectedTemporaryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
        ]);
        $temporaryUser = $rejectedTemporaryUser->temporaryUser;

        DB::transaction(function () use ($data, $temporaryUser) {
            $temporaryUser->update($data);
            $temporaryUser->rejectedTemporaryUsers()->delete();
        });

        return view('temporary_users.fixed', compact('temporaryUser'));
    }
}
