<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\UserSignInWithFirebaseIdToken;
use App\UseCases\UserVerifyFirebaseIdToken;

class SignInController extends Controller
{
    protected $auth;

    public function __construct(UserVerifyFirebaseIdToken $auth)
    {
        $this->auth = $auth;
    }

    function __invoke(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $idToken = $request->input('id_token');

        $uid = $this->auth->verify($idToken);

        $user = User::withProvider('firebase', $uid)->firstOrCreate();
        $user->saveProvider('firebase', $uid);

        $token = $user->createToken('Firebase Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }
}
