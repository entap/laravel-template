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

        // TODO ここからサービスにまとめる
        $provider = AuthProvider::where('name', 'firebase')
            ->where('code', $uid)
            ->first();
        if ($provider) {
            $user = $provider->user;
        } else {
            $user = DB::transaction(function () use ($uid) {
                // TODO User作るのアプリケーション依存なので共通化できない
                // 見つからないときはエラーにしてregisterしてもらう？
                $user = User::create();

                $user->authProviders()->create([
                    'name' => 'firebase',
                    'code' => $uid,
                ]);

                return $user;
            });
        }
        // TODO ここまで？token作るとこまでやってもいいかも。

        return $user->createToken('Firebase Token');
    }
}
