<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Firebase\SignInController;
use App\Http\Controllers\Auth\Firebase\RegisterController;
use App\Http\Controllers\Auth\Firebase\UnregisterController;
use App\Http\Controllers\Auth\Firebase\CreateCustomTokenController;
use App\Http\Controllers\Auth\Line\NonceController;
use App\Http\Controllers\Auth\Line\SignInController as LineSignInController;
use App\Http\Controllers\Auth\Line\RegisterController as LineRegisterController;
use App\Http\Controllers\Auth\Line\UnregisterController as LineUnregisterController;

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

Route::post('auth/firebase/token', SignInController::class);

Route::middleware('auth:api')->group(function () {
    Route::post(
        'auth/firebase/custom-token',
        CreateCustomTokenController::class
    );
    Route::post('auth/firebase/user', RegisterController::class);
    Route::delete('auth/firebase/user', UnregisterController::class);
});

// LINE

Route::post('auth/line/nonce', NonceController::class);
Route::post('auth/line/token', LineSignInController::class);

Route::middleware('auth:api')->group(function () {
    Route::post('auth/line/user', LineRegisterController::class);
    Route::delete('auth/line/user', LineUnregisterController::class);
});
