<?php
namespace App\UseCases;

use App\Models\User;

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
        $user = User::where('firebase_id', $uid)->firstOrCreate([
            'firebase_id' => $uid,
        ]);

        return $user->createToken('Firebase Token');
    }
}
