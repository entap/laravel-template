<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAccepted;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Controller;

class AcceptUserController extends Controller
{
    /**
     * ユーザーを承認する
     */
    public function __invoke(TemporaryUser $temporaryUser)
    {
        $user = DB::transaction(function () use ($temporaryUser) {
            $user = User::create($temporaryUser->only(['email', 'name']));
            $temporaryUser->delete();
            return $user;
        });

        event(new UserAccepted(request()->user(), $temporaryUser, $user));

        return redirect()->route('admin.temporary-users.index');
    }
}
