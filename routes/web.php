<?php

use Entap\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\PropertyGroupController;
use App\Http\Controllers\Admin\DuplicateMailTemplateController;

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
        'except' => ['index', 'show'],
    ])->names('admin.settings.properties');
    Route::resource('settings/groups', PropertyGroupController::class, [
        'except' => ['index', 'show'],
    ])->names('admin.settings.groups');
    // Route::get('settings/csv/export');
    // Route::post('settings/csv/import');
});
