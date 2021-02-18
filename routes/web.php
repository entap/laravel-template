<?php

use Entap\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\UserController;
use App\Http\Controllers\UserSegmentController;
use App\Http\Controllers\TemporaryUserController;
use App\Http\Controllers\AcceptTemporaryUserController;
use App\Http\Controllers\RejectTemporaryUserController;

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
});
