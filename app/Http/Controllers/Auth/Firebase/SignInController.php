<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Http\Controllers\Controller;
use App\UseCases\UserSignInWithFirebaseIdToken;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    protected $auth;

    public function __construct(UserSignInWithFirebaseIdToken $auth)
    {
        $this->auth = $auth;
    }

    function __invoke(Request $request)
    {
        $token = $this->auth->signIn($request->input('id_token'));
        return [
            'access_token' => $token->accessToken,
        ];
    }
}
