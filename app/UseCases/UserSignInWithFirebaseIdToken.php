<?php
namespace App\UseCases;

use App\Models\User;
use App\Models\AuthProvider;
use Illuminate\Support\Facades\DB;
use App\UseCases\UserVerifyFirebaseIdToken;

class UserSignInWithFirebaseIdToken
{
    protected $verifyService;

    public function __construct(UserVerifyFirebaseIdToken $verifyService)
    {
        $this->verifyService = $verifyService;
    }

    public function signIn(string $idToken)
    {
        $uid = $this->verifyService->verify($idToken);

        $user = User::withProvider('firebase', $uid)->firstOrCreate();
        $user->saveProvider('firebase', $uid);

        return $user->createToken('Firebase Token');
    }
}
