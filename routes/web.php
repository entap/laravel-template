<?php

use App\Http\Controllers\Auth\LoginController;
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

// Auth

Route::get('login', [LoginController::class, 'showLoginForm'])->name(
    'auth.login'
);
Route::post('login', [LoginController::class, 'login'])->name('login');
// TODO postに絞る
Route::any('logout', [LoginController::class, 'logout'])->name('logout');

// Admin

Route::group([], base_path('routes/web/admin.php'));

// Temporary User

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

// CMS

Route::get('dynamic-pages/{page:slug}', ShowDynamicPageController::class);

// Grouping

Route::group(['middleware' => 'auth'], function () {
    Route::get('groups', [GroupController::class, 'index']);

    Route::get('groups/{group}', [GroupController::class, 'show'])->name(
        'groups.show'
    );

    Route::get('groups/{group}/descendants', [
        GroupDescendantController::class,
        'index',
    ])->name('groups.descendants.index');

    Route::get('groups/{group}/descendants/create', [
        GroupDescendantController::class,
        'create',
    ])->name('groups.descendants.create');

    Route::get('groups/{group}/descendants/{descendant}/edit', [
        GroupDescendantController::class,
        'edit',
    ])->name('groups.descendants.edit');

    Route::get('groups/{group}/members', [
        GroupMemberController::class,
        'index',
    ])->name('groups.members.index');

    Route::get('groups/{group}/members/{member}', [
        GroupMemberController::class,
        'show',
    ]);

    Route::post('groups/{group}/users', [GroupUserController::class, 'invite']);

    Route::post('groups/{group}/descendants', [
        GroupDescendantController::class,
        'store',
    ])->name('groups.descendants.store');

    Route::put('groups/{group}/descendants/{descendant}', [
        GroupDescendantController::class,
        'update',
    ])->name('groups.descendants.update');

    Route::delete('groups/{group}/descendants/{descendant}', [
        GroupDescendantController::class,
        'destroy',
    ])->name('groups.descendants.destroy');

    Route::post('groups/{group}/descendants/{descendant}/users', [
        GroupDescendantController::class,
        'assign',
    ]);
});
