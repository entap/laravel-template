<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserDeviceRequest;
use App\Models\UserDevice;
use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    /**
     * 新しい端末を登録する
     *
     * @param  \App\Http\Requests\SaveUserDeviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserDeviceRequest $request)
    {
        $user = $request->user();
        return $user->devices()->create($request->validated());
    }

    /**
     * 端末を更新する
     *
     * @param  \App\Http\Requests\SaveUserDeviceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserDeviceRequest $request, int $id)
    {
        $user = $request->user();
        $device = $user->devices()->findOrFail($id);

        return $device->update($request->validated());
    }

    /**
     * 端末を削除する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        $user = $request->user();
        $device = $user->devices()->findOrFail($id);

        $device->delete();

        return response()->noContent();
    }
}
