<?php
namespace App\Services\Auth\Firebase;

use Illuminate\Support\Str;
use App\Gateways\Firebase\CreateCustomTokenGateway;

class CreateCustomTokenService
{
    protected $firebase;

    public function __construct(CreateCustomTokenGateway $firebase)
    {
        $this->firebase = $firebase;
    }

    public function createCustomToken($user)
    {
        $provider = $user->getProvider('firebase');
        $uid = $provider ? $provider->code : Str::uuid();
        $customToken = $this->firebase->createCustomToken($uid);
        return [
            'custom_token' => $customToken,
        ];
    }
}
