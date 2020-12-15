<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Http\Controllers\Controller;
use App\UseCases\UserVerifyFirebaseIdToken;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $verifyService;

    public function __construct(UserVerifyFirebaseIdToken $verifyService)
    {
        $this->verifyService = $verifyService;
    }

    public function __invoke(Request $request)
    {
        $user = $request->user();

        // TODO id_tokenは必須
        $uid = $this->verifyService->verify($request->input('id_token'));

        // TODO 他人が既に使っているuidはダメ

        $user->update(['firebase_id' => $uid]);
    }
}
