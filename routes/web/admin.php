<?php

use App\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\UserOpinionController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\Settings\MenuController;
use App\Http\Controllers\Admin\DynamicContentController;
use App\Http\Controllers\Admin\PackageReleaseController;
use App\Http\Controllers\Admin\DynamicCategoryController;
use App\Http\Controllers\Admin\User\AcceptUserController;
use App\Http\Controllers\Admin\User\RejectUserController;
use App\Http\Controllers\Admin\User\SuspendUserController;
use App\Http\Controllers\Admin\User\UserSegmentController;
use App\Http\Controllers\Admin\Settings\UserGroupController;
use App\Http\Controllers\Admin\User\TemporaryUserController;
use App\Http\Controllers\Admin\User\UnsuspendUserController;
use App\Http\Controllers\Admin\DuplicateMailTemplateController;
use App\Http\Controllers\Admin\AgreementTypeAgreementController;

Admin::routeGroup(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name(
        'admin.login'
    );
    Route::post('/login', [LoginController::class, 'login']);

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', HomeController::class)->name('admin.home');

        /*
        |--------------------------------------------------------------------------
        | 認証
        |--------------------------------------------------------------------------
        */
        Route::post('/logout', [LoginController::class, 'logout'])->name(
            'admin.logout'
        );

        /*
        |--------------------------------------------------------------------------
        | 基本設定
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'settings/users',
            \App\Http\Controllers\Admin\Settings\UserController::class
        )->names('admin.settings.users');

        Route::resource('settings/roles', RoleController::class)->names(
            'admin.settings.roles'
        );

        Route::resource(
            'settings/menu/items',
            MenuController::class
        )->names('admin.settings.menu.items');

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

        // その他

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

        Route::put(
            'users/{user}/unsuspend',
            UnsuspendUserController::class
        )->name('admin.users.unsuspend');

        Route::resource('user-segments', UserSegmentController::class, [
            'except' => ['create', 'store'],
        ])->names('admin.user-segments');

        Route::resource('temporary-users', TemporaryUserController::class, [
            'only' => ['index', 'show'],
        ])->names('admin.temporary-users');

        Route::post(
            'temporary-users/{temporaryUser}/accept',
            AcceptUserController::class
        )->name('admin.temporary-users.accept');

        Route::post(
            'temporary-users/{temporaryUser}/reject',
            RejectUserController::class
        )->name('admin.temporary-users.reject');

        Route::resource('dynamic-pages', DynamicPageController::class)->names(
            'admin.dynamic-pages'
        );
        Route::resource('dynamic-contents', DynamicContentController::class, [
            'only' => 'show',
        ])->names('admin.dynamic-contents');

        Route::resource(
            'dynamic-categories',
            DynamicCategoryController::class
        )->names('admin.dynamic-categories');

        Route::resource('opinions', UserOpinionController::class, [
            'only' => ['index', 'show', 'destroy'],
        ])->names('admin.opinions');

        Route::resource('jobs', AdminJobController::class, [
            'only' => ['index'],
        ])->names('admin.jobs');

        Route::resource(
            'agreement_types',
            AgreementTypeController::class
        )->names('admin.agreement_types');

        Route::resource(
            'agreement_types.agreements',
            AgreementTypeAgreementController::class,
            ['only' => ['create', 'store', 'destroy']]
        )->names('admin.agreement_types.agreements');

        // Logs
        Route::get('logs', [LogController::class, 'index'])->name(
            'admin.logs.index'
        );
        Route::get('logs/show', [LogController::class, 'show'])->name(
            'admin.logs.show'
        );

        // Packages
        Route::resource('packages', PackageController::class)->names(
            'admin.packages'
        );
        Route::resource('packages.releases', PackageReleaseController::class, [
            'except' => ['index', 'show'],
        ])->names('admin.packages.releases');
    });
});
