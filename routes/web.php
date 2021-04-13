<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\GroupDescendantController;
use App\Http\Controllers\ShowDynamicPageController;
use App\Http\Controllers\FixTemporaryUserController;
use App\Http\Controllers\RegisterTemporaryUserController;

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

Route::view('/', 'welcome');

Route::group([], base_path('routes/web/admin.php'));

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

// Grouping

Route::get('groups/{group}', [GroupController::class, 'show'])->name(
    'groups.show'
);

Route::get('groups/{group}/descendants', [
    GroupDescendantController::class,
    'index',
])->name('groups.descendants.index');

// FIXME 廃止する
Route::get('groups/{group}/users', [GroupUserController::class, 'index']);

Route::get('groups/{group}/members', [GroupMemberController::class, 'index']);

Route::get('groups/{group}/members/{member}', [
    GroupMemberController::class,
    'show',
]);

Route::post('groups/{group}/users', [GroupUserController::class, 'invite']);

Route::post('groups/{group}/descendants/{descendant}/users', [
    GroupDescendantController::class,
    'assign',
]);
