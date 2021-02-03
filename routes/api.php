<?php

use App\Http\Controllers\UserDeviceController;
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

Route::middleware('auth:api')->group(function () {
    Route::apiResource('user/devices', UserDeviceController::class, [
        'only' => ['store'],
    ]);
});

// Firebase

Route::post(
    'auth/firebase/token',
    \App\Http\Controllers\Auth\Firebase\LoginController::class
);
Route::post(
    'auth/firebase/custom-token',
    \App\Http\Controllers\Auth\Firebase\CreateCustomTokenController::class
);

// LINE

Route::post(
    'auth/line/token',
    \App\Http\Controllers\Auth\Line\LoginController::class
);
