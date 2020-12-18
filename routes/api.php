<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Firebase

// Route::post('auth/firebase/token', SignInController::class);
// Route::post('auth/firebase/custom-token', CreateCustomTokenController::class);

// LINE

// Route::post('auth/line/nonce', LineNonceController::class);
// Route::post('auth/line/token', LineTokenController::class);
