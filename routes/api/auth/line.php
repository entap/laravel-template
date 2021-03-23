<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Line\LoginController;
use App\Http\Controllers\Auth\Line\RegisterController;
use App\Http\Controllers\Auth\Line\UnregisterController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('user', RegisterController::class);
    Route::delete('user', UnregisterController::class);
});
Route::post('token', LoginController::class);
