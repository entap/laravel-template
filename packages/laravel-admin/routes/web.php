<?php

use Entap\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use Entap\Admin\Application\Controllers\HomeController;
use Entap\Admin\Application\Controllers\RoleController;
use Entap\Admin\Application\Controllers\UserController;
use Entap\Admin\Application\Controllers\MenuItemController;
use Entap\Admin\Application\Controllers\UserGroupController;
use Entap\Admin\Application\Controllers\Auth\LoginController;
use Entap\Admin\Application\Controllers\MailTemplateController;
use Entap\Admin\Application\Controllers\DuplicateMailTemplateController;

Admin::routeGroup(function () {
    Route::get('/', HomeController::class)->name('admin.home');

    /*
    |--------------------------------------------------------------------------
    | 認証
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name(
        'admin.login'
    );
    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/logout', [LoginController::class, 'logout'])->name(
        'admin.logout'
    );

    /*
    |--------------------------------------------------------------------------
    | 基本設定
    |--------------------------------------------------------------------------
    */

    Route::resource('settings/users', UserController::class)->names(
        'admin.settings.users'
    );

    Route::resource('settings/roles', RoleController::class)->names(
        'admin.settings.roles'
    );

    Route::resource('settings/menu/items', MenuItemController::class)->names(
        'admin.settings.menu.items'
    );

    Route::resource('settings/user-groups', UserGroupController::class, [
        'except' => 'show',
    ])->names('admin.settings.user-groups');

    /*
    |--------------------------------------------------------------------------
    | メール
    |--------------------------------------------------------------------------
    */

    Route::resource('mails', MailTemplateController::class, [
        'except' => 'show',
    ])->names('admin.mails');

    Route::post(
        'mails/{mail}/duplicate',
        DuplicateMailTemplateController::class
    )->name('admin.mails.duplicate');
});
