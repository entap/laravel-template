<?php

use App\Http\Controllers\Admin\DuplicateMailTemplateController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Entap\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;

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

Admin::routes(function () {
    Route::get('users', [UserController::class, 'index'])->name(
        'admin.users.index'
    );
    Route::resource('mails', MailTemplateController::class, [
        'except' => 'show',
    ])->names('admin.mails');
    Route::post(
        'mails/{mail}/duplicate',
        DuplicateMailTemplateController::class
    )->name('admin.mails.duplicate');

    Route::get('settings', [SettingsController::class, 'index'])->name(
        'admin.settings.index'
    );
    // Route::get('settings/edit');
    Route::resource('settings/properties', PropertyController::class, [
        'only' => ['create', 'store', 'edit', 'update'],
    ])->names('admin.settings.properties');
    // Route::get('settings/properties/{property}/edit');
    // Route::put('settings/properties/{property}');
    // Route::delete('settings/properties/{property}');
    // Route::get('settings/groups/create');
    // Route::post('settings/groups');
    // Route::get('settings/groups/{group}/edit');
    // Route::put('settings/groups/{group}');
    // Route::delete('settings/groups/{group}');
    // Route::get('settings/csv/export');
    // Route::post('settings/csv/import');
});
