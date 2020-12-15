<?php
namespace App\UseCases;

use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;

class UserVerifyFirebaseIdToken
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function verify(string $idToken): string
    {
        // TODO GWにでも突っ込むか？
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
        } catch (InvalidToken $e) {
            // TODO エラー処理
            echo 'The token is invalid: ' . $e->getMessage();
        } catch (\InvalidArgumentException $e) {
            // TODO エラー処理
            echo 'The token could not be parsed: ' . $e->getMessage();
        }
        $uid = $verifiedIdToken->claims()->get('sub');
        return $uid;
    }
}
