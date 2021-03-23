<?php

namespace App\Http\Controllers\Auth\Firebase;

use Illuminate\Http\Request;
use Entap\OAuth\Firebase\Application\Controllers\Controller;

class UnregisterController extends Controller
{
    /**
     * 認証連携を解除する
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->removeProvider('firebase');
    }
}
