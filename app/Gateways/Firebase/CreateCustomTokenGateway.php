<?php
namespace App\Gateways\Firebase;

use Kreait\Firebase\Auth;

class CreateCustomTokenGateway
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function createCustomToken(string $uid): string
    {
        return (string) $this->auth->createCustomToken($uid);
    }
}
