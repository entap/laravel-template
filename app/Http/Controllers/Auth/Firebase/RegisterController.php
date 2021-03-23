<?php

namespace App\Http\Controllers\Auth\Firebase;

use Illuminate\Http\Request;
use Entap\OAuth\Firebase\Application\Controllers\Controller;
use Entap\OAuth\Firebase\Application\Gateways\Firebase\VerifyIdTokenGateway;

class RegisterController extends Controller
{
    protected $firebase;

    public function __construct(VerifyIdTokenGateway $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * 認証連携を登録する
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $user = $request->user();

        $verifiedToken = $this->firebase->verify($request->input('id_token'));
        $uid = $verifiedToken->userId();

        try {
            $user->saveProvider('firebase', $uid);
        } catch (\InvalidArgumentException $e) {
            abort(400, $e->getMessage());
        }
    }
}
