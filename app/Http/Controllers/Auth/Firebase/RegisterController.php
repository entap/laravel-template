<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Gateways\Firebase\VerifyIdTokenGateway;
use App\Http\Controllers\Controller;
use App\UseCases\UserVerifyFirebaseIdToken;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $firebase;

    public function __construct(VerifyIdTokenGateway $firebase)
    {
        $this->firebase = $firebase;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $user = $request->user();

        $uid = $this->firebase->verify($request->input('id_token'));

        // TODO 別のユーザーが既に使っているuidはダメ

        $user->saveProvider('firebase', $uid);
    }
}
