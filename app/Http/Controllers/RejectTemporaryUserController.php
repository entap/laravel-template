<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryUser;
use App\Admin\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RejectTemporaryUserController extends Controller
{
    /**
     * 仮登録ユーザーを否認する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TemporaryUser $temporaryUser)
    {
        $data = $request->validate([
            'reason' => 'nullable|string|max:1000',
        ]);
        $data['token'] = Str::uuid();

        $temporaryUser->rejectedTemporaryUsers()->delete();
        $temporaryUser->rejectedTemporaryUsers()->create($data);

        return redirect()->route('admin.temporary-users.index');
    }
}
