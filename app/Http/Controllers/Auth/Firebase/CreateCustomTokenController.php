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
        $customToken = $this->customTokenService->create(
            $user->firebase_id ? $user->firebase_id : Str::uuid()
        );
        return [
            'custom_token' => $customToken,
        ];
    }
}
