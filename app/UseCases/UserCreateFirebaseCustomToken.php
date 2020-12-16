<?php
namespace App\UseCases;

use Kreait\Firebase\Auth;

class UserCreateFirebaseCustomToken
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function create(string $uid): string
    {
        return (string) $this->auth->createCustomToken($uid);
    }
}
