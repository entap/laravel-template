<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Gateways\Firebase\CreateCustomTokenGateway;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateCustomTokenController extends Controller
{
    protected $firebase;

    public function __construct(CreateCustomTokenGateway $firebase)
    {
        $this->firebase = $firebase;
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
