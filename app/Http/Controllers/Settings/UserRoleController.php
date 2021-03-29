<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * 検証権限を割り当てる
     */
    public function assignTesterRole(User $user)
    {
        $user->assignRole('tester');

        // TODO イベントを設定する

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', '検証ユーザーに設定しました。');
    }

    /**
     * 検証権限を外す
     */
    public function removeTesterRole(User $user)
    {
        $user->removeRole('tester');

        // TODO イベントを設定する

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', '検証ユーザーから除外しました。');
    }
}
