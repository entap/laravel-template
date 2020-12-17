<?php

namespace App\Http\Controllers\Auth\Firebase;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\UserCreateFirebaseCustomToken;

class CreateCustomTokenController extends Controller
{
    protected $customTokenService;

    public function __construct(
        UserCreateFirebaseCustomToken $customTokenService
    ) {
        $this->customTokenService = $customTokenService;
    }

    public function __invoke(Request $request)
    {
        $user = $request->user();
        $provider = $user->getProvider('firebase');
        $uid = $provider ? $provider->code : Str::uuid();
        $customToken = $this->customTokenService->create($uid);
        return [
            'custom_token' => $customToken,
        ];
    }
}
