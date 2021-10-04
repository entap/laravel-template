<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAgreeController;
use App\Http\Controllers\UserDeviceController;
use App\Http\Controllers\SendOpinionController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\UserAgreementController;
use App\Http\Controllers\PackageReleaseController;
use App\Http\Controllers\DynamicCategoryController;
use App\Http\Controllers\ShowDynamicPageController;
use App\Http\Controllers\FixTemporaryUserController;
use App\Http\Controllers\Settings\SystemController;
use App\Http\Controllers\RegisterTemporaryUserController;
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

Route::get('system', SystemController::class);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'show']);

    Route::apiResource('/user/devices', UserDeviceController::class, [
        'only' => ['store', 'update', 'destroy'],
    ]);

    Route::post('/notification/devices', [
        UserNotificationDeviceController::class,
        'register',
    ]);

    Route::delete('/notification/devices/{deviceToken}', [
        UserNotificationDeviceController::class,
        'unregister',
    ]);

    Route::post('opinions', [SendOpinionController::class, 'send']);

    Route::get(
        'agreements/{agreementType:slug}',
        UserAgreementController::class
    );
    Route::post(
        'agreements/{agreementType:slug}/agree',
        UserAgreeController::class
    );

    // Package
    Route::get('packages/{package}/releases', [
        PackageReleaseController::class,
        'index',
    ])->name('api.packages.releases');
});

Route::post('temporary-users', [
    RegisterTemporaryUserController::class,
    'store',
])->name('api.temporary-users.register');
Route::put('temporary-users/{rejectedTemporaryUser:token}', [
    FixTemporaryUserController::class,
    'update',
])->name('api.temporary-users.fix');

Route::group(['prefix' => 'auth'], function () {
    Route::prefix('firebase')->group(base_path('routes/api/auth/firebase.php'));
    Route::prefix('line')->group(base_path('routes/api/auth/line.php'));
});

// Dynamic Contents

Route::get('dynamic-pages/{page:slug}', ShowDynamicPageController::class)->name(
    'api.dynamic_pages.show'
);

Route::get('dynamic-categories', [DynamicCategoryController::class, 'index']);
