<?php
namespace App\Gateways\Firebase;

use Kreait\Firebase\Auth;
use InvalidArgumentException;
use App\Gateways\Firebase\VerifiedToken;

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
