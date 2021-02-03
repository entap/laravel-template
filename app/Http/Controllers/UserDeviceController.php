<?php

namespace App\Http\Controllers;

use App\Models\UserDevice;
use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    /**
     * 新しい端末を登録する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        return $user->devices()->create($request->all());
    }

    /**
     * 端末を更新する
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 端末を削除する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
