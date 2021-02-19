<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationDeviceController extends Controller
{
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

    public function unregister(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required|string',
        ]);

        $user = $request->user();
        $user
            ->notificationDevices()
            ->hasToken($validatedData['token'])
            ->delete();

        return response()->noContent();
    }
}
