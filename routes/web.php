<?php

use Entap\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\UserSegmentController;
use App\Admin\Controllers\TemporaryUserController;
use App\Http\Controllers\FixTemporaryUserController;
use App\Http\Controllers\Admin\SuspendUserController;
use App\Http\Controllers\Admin\UnsuspendUserController;
use App\Admin\Controllers\AcceptTemporaryUserController;
use App\Admin\Controllers\DynamicPageController;
use App\Admin\Controllers\RejectTemporaryUserController;
use App\Http\Controllers\RegisterTemporaryUserController;
use App\Http\Controllers\ShowDynamicPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Admin::routeGroup(function () {
    Route::resource('users', UserController::class, [
        'only' => ['index', 'show'],
    ])->names('admin.users');

    Route::get('users/{user}/suspend', [
        SuspendUserController::class,
        'showSuspendForm',
    ]);

    Route::put('users/{user}/suspend', [
        SuspendUserController::class,
        'suspend',
    ])->name('admin.users.suspend');

    Route::put('users/{user}/unsuspend', UnsuspendUserController::class)->name(
        'admin.users.unsuspend'
    );

    Route::resource('user-segments', UserSegmentController::class, [
        'except' => ['create', 'store'],
    ])->names('admin.user-segments');

    Route::resource('temporary-users', TemporaryUserController::class, [
        'only' => ['index', 'show'],
    ])->names('admin.temporary-users');

    Route::post(
        'temporary-users/{temporaryUser}/accept',
        AcceptTemporaryUserController::class
    )->name('admin.temporary-users.accept');

    Route::post(
        'temporary-users/{temporaryUser}/reject',
        RejectTemporaryUserController::class
    )->name('admin.temporary-users.reject');

    Route::resource('dynamic-pages', DynamicPageController::class, [
        'except' => ['show', 'update'],
    ])->names('admin.dynamic-pages');
});

Route::get('temporary-users', [
    RegisterTemporaryUserController::class,
    'create',
]);
Route::post('temporary-users', [
    RegisterTemporaryUserController::class,
    'store',
])->name('temporary-users.register');
Route::get('temporary-users/{rejectedTemporaryUser:token}/edit', [
    FixTemporaryUserController::class,
    'edit',
])->name('temporary-users.edit');
Route::put('temporary-users/{rejectedTemporaryUser:token}', [
    FixTemporaryUserController::class,
    'update',
])->name('temporary-users.fix');

Route::get('dynamic-pages/{page:slug}', ShowDynamicPageController::class);
