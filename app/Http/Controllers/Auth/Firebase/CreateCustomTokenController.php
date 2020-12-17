<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Http\Controllers\Controller;
use Entap\OAuth\Firebase\Application\Gateways\Firebase\CreateCustomTokenGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateCustomTokenController extends Controller
{
    protected $firebase;

    public function __construct(CreateCustomTokenGateway $firebase)
    {
        $this->firebase = $firebase;

        $this->middleware(config('oauth-firebase.route.middleware'));
    }

    public function __invoke(Request $request)
    {
        $user = $request->user();
        $provider = $user->getProvider('firebase');
        $uid = $provider ? $provider->code : Str::uuid();
        $customToken = $this->firebase->createCustomToken($uid);
        return [
            'custom_token' => $customToken,
        ];
    }
}
