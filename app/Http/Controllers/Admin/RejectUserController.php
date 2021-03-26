<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserRejected;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryUser;
use App\Http\Controllers\Admin\Controller;
use App\Notifications\TemporaryUserRejected;

class RejectUserController extends Controller
{
    /**
     * ユーザーを否認する
     */
    public function __invoke(Request $request, TemporaryUser $temporaryUser)
    {
        $data = $request->validate([
            'reason' => 'nullable|string|max:1000',
        ]);
        $data['token'] = Str::uuid();

        $rejectedTemporaryUser = $temporaryUser
            ->rejectedTemporaryUsers()
            ->create($data);

        $temporaryUser->notify(
            new TemporaryUserRejected($rejectedTemporaryUser)
        );

        event(new UserRejected(request()->user(), $temporaryUser));

        return redirect()->route('admin.temporary-users.index');
    }
}
