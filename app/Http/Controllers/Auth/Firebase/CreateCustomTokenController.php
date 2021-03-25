<?php

namespace App\Http\Controllers\Auth\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\Firebase\CreateCustomTokenService;

class CreateCustomTokenController extends Controller
{
    protected $firebase;

    public function __construct(CreateCustomTokenService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function __invoke(Request $request)
    {
        return $this->firebase->createCustomToken($request->user());
    }
}
