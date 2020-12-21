<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Http\Controllers\Controller;
use Entap\OAuth\Firebase\Application\Services\CreateCustomTokenService;
use Illuminate\Http\Request;

class CreateCustomTokenController extends Controller
{
    protected $firebase;

    public function __construct(CreateCustomTokenService $firebase)
    {
        $this->firebase = $firebase;

        $this->middleware(config('oauth-firebase.routes.api.middleware'));
    }

    public function __invoke(Request $request)
    {
        return $this->firebase->createCustomToken($request->user());
    }
}
