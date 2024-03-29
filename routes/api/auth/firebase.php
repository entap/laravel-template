<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Firebase\LoginController;
use App\Http\Controllers\Auth\Firebase\RegisterController;
use App\Http\Controllers\Auth\Firebase\UnregisterController;
use App\Http\Controllers\Auth\Firebase\CreateCustomTokenController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post(
        'custom-token',
        CreateCustomTokenController::class
    );
    Route::post('user', RegisterController::class);
    Route::delete('user', UnregisterController::class);
});
Route::post('token', LoginController::class);
