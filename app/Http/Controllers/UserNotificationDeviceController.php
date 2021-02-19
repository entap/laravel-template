<?php

namespace App\Http\Controllers;

use App\Models\UserNotificationDevice;
use Illuminate\Http\Request;

class UserNotificationDeviceController extends Controller
{
    /**
     * 通知先の端末を登録する
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required|string|max:255',
        ]);

        $user = $request->user();
        $device = $user
            ->notificationDevices()
            ->updateOrCreate(
                ['token' => $validatedData['token']],
                ['token' => $validatedData['token']]
            );

        return $device;
    }

    /**
     * 通知先の端末を削除する
     */
    public function unregister(Request $request, string $token)
    {
        $user = $request->user();
        $user
            ->notificationDevices()
            ->hasToken($token)
            ->delete();

        return response()->noContent();
    }
}
