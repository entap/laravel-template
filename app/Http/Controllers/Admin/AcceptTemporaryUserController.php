<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Controller;

class AcceptTemporaryUserController extends Controller
{
    /**
     * 仮登録ユーザーを承認する
     */
    public function __invoke(TemporaryUser $temporaryUser)
    {
        DB::transaction(function () use ($temporaryUser) {
            User::create($temporaryUser->only(['email', 'name']));
            $temporaryUser->delete();
        });

        return redirect()->route('admin.temporary-users.index');
    }
}
