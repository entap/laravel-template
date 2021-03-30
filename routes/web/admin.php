<?php

use App\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Settings\RoleController;
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
use App\Http\Controllers\Settings\UserRoleController;

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

        // 管理ユーザー

        Route::resource(
            'settings/users',
            \App\Http\Controllers\Admin\Settings\UserController::class
        )->names('admin.settings.users');

        Route::resource('settings/roles', RoleController::class)->names(
            'admin.settings.roles'
        );

        Route::resource('settings/user-groups', UserGroupController::class, [
            'except' => 'show',
        ])->names('admin.settings.user-groups');

        // 管理メニュー

        Route::resource('settings/menu/items', MenuController::class)->names(
            'admin.settings.menu.items'
        );

        // メール

        Route::resource('mails', MailTemplateController::class, [
            'except' => 'show',
        ])->names('admin.mails');
        Route::post(
            'mails/{mail}/duplicate',
            DuplicateMailTemplateController::class
        )->name('admin.mails.duplicate');

        // 一般ユーザー

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

        Route::post('users/{user}/tester/assign', [
            UserRoleController::class,
            'assignTesterRole',
        ])->name('admin.users.assign-tester-role');
        Route::post('users/{user}/tester/remove', [
            UserRoleController::class,
            'removeTesterRole',
        ])->name('admin.users.remove-tester-role');

        Route::resource('user-segments', UserSegmentController::class, [
            'except' => ['create', 'store'],
        ])->names('admin.user-segments');

        // 仮登録

        Route::resource('temporary-users', TemporaryUserController::class, [
            'only' => ['index', 'show'],
        ])->names('admin.temporary-users');
        Route::post(
            'temporary-users/{temporaryUser}/accept',
            AcceptUserController::class
        )->name('admin.temporary-users.accept');
        Route::get('temporary-users/{temporaryUser}/reject', [
            RejectUserController::class,
            'showRejectForm',
        ])->name('admin.temporary-users.reject');
        Route::post('temporary-users/{temporaryUser}/reject', [
            RejectUserController::class,
            'reject',
        ]);

        // 動的コンテンツ

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

        // 問い合わせ

        Route::resource('opinions', UserOpinionController::class, [
            'only' => ['index', 'show', 'destroy'],
        ])->names('admin.opinions');

        // 管理ジョブ

        Route::resource('jobs', AdminJobController::class, [
            'only' => ['index'],
        ])->names('admin.jobs');

        // 規約管理

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
