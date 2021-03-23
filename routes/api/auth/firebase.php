<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Firebase\LoginController;
use App\Http\Controllers\Auth\Firebase\RegisterController;
use App\Http\Controllers\Auth\Firebase\UnregisterController;
use App\Http\Controllers\Auth\Firebase\CreateCustomTokenController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post(
        'auth/firebase/custom-token',
        CreateCustomTokenController::class
    );
    Route::post('auth/firebase/user', RegisterController::class);
    Route::delete('auth/firebase/user', UnregisterController::class);
});
Route::post('auth/firebase/token', LoginController::class);
