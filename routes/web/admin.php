<?php

use Entap\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\EntryController;
use App\Admin\Controllers\TableController;
use App\Admin\Controllers\PackageController;
use App\Http\Controllers\AdminJobController;
use App\Admin\Controllers\DynamicPageController;
use App\Admin\Controllers\UserOpinionController;
use App\Admin\Controllers\UserSegmentController;
use App\Admin\Controllers\TemporaryUserController;
use App\Admin\Controllers\DynamicContentController;
use App\Admin\Controllers\PackageReleaseController;
use App\Admin\Controllers\DynamicCategoryController;
use App\Http\Controllers\Admin\SuspendUserController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\UnsuspendUserController;
use App\Admin\Controllers\AcceptTemporaryUserController;
use App\Admin\Controllers\RejectTemporaryUserController;
use App\Http\Controllers\Admin\AgreementTypeAgreementController;

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

    Route::resource('agreement_types', AgreementTypeController::class)->names(
        'admin.agreement_types'
    );

    Route::resource(
        'agreement_types.agreements',
        AgreementTypeAgreementController::class,
        ['only' => ['create', 'store', 'destroy']]
    )->names('admin.agreement_types.agreements');

    // Logs
    Route::get('logs', [TableController::class, 'index'])->name(
        'admin.logs.index'
    );
    Route::get('logs/show', [EntryController::class, 'index'])->name(
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
