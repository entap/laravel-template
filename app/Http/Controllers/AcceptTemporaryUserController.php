<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcceptTemporaryUserController extends Controller
{
    /**
     * 仮登録ユーザーを承認する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TemporaryUser $temporaryUser)
    {
        DB::transaction(function () use ($temporaryUser) {
            User::create($temporaryUser->only(['name']));
            $temporaryUser->delete();
        });

        return redirect()->route('admin.temporary-users.index');
    }
}
