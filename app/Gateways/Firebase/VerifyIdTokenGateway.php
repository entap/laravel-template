<?php
namespace App\Gateways\Firebase;

use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Entap\OAuth\Firebase\Application\Gateways\Firebase\VerifiedToken;
use InvalidArgumentException;

class VerifyIdTokenGateway
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function verify(string $idToken): VerifiedToken
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
        } catch (InvalidArgumentException $e) {
            abort(400, 'Invalid token: ' . $e->getMessage());
        }

        return new VerifiedToken($verifiedIdToken->claims()->get('sub'));
    }
}
