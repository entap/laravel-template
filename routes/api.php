<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDeviceController;
use App\Http\Controllers\ShowDynamicPageController;
use App\Http\Controllers\FixTemporaryUserController;
use App\Http\Controllers\RegisterTemporaryUserController;
use App\Http\Controllers\SendOpinionController;
use App\Http\Controllers\UserNotificationDeviceController;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', UserController::class);

    Route::apiResource('/user/devices', UserDeviceController::class, [
        'only' => ['store', 'update', 'destroy'],
    ]);

    Route::post('/notification/devices', [
        UserNotificationDeviceController::class,
        'register',
    ]);

    Route::delete('/notification/devices/{device:token}', [
        UserNotificationDeviceController::class,
        'unregister',
    ]);

    Route::post('opinions', [SendOpinionController::class, 'send']);
});

Route::post('temporary-users', [
    RegisterTemporaryUserController::class,
    'store',
])->name('api.temporary-users.register');
Route::put('temporary-users/{rejectedTemporaryUser:token}', [
    FixTemporaryUserController::class,
    'update',
])->name('api.temporary-users.fix');

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

// Dynamic Contents

Route::get('dynamic-pages/{page:slug}', ShowDynamicPageController::class)->name(
    'api.dynamic_pages.show'
);
