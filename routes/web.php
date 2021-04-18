<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\GroupDescendantController;
use App\Http\Controllers\ShowDynamicPageController;
use App\Http\Controllers\FixTemporaryUserController;
use App\Http\Controllers\GroupDescendantMemberController;
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

    Route::resource('groups.descendants', GroupDescendantController::class);

    Route::resource('groups.members', GroupMemberController::class, [
        'only' => ['index', 'create', 'store', 'show'],
    ]);

    Route::resource(
        'groups.descendants.members',
        GroupDescendantMemberController::class,
        ['only' => ['create', 'store', 'destroy']]
    );
});
