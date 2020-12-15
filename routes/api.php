<?php

use App\Http\Controllers\Auth\Firebase\CreateCustomTokenController;
use App\Http\Controllers\Auth\Firebase\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Firebase\SignInController;
use App\Http\Controllers\Auth\Firebase\UnregisterController;

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

Route::post('auth/firebase/token', SignInController::class);
Route::post('auth/firebase/custom-token', CreateCustomTokenController::class);
Route::post('auth/firebase/user', RegisterController::class);
Route::delete('auth/firebase/user', UnregisterController::class);
