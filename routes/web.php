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
use App\Http\Controllers\ShowDynamicPageController;
use App\Admin\Controllers\DynamicCategoryController;
use App\Http\Controllers\FixTemporaryUserController;
use App\Http\Controllers\Admin\SuspendUserController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\UnsuspendUserController;
use App\Admin\Controllers\AcceptTemporaryUserController;
use App\Admin\Controllers\RejectTemporaryUserController;
use App\Http\Controllers\RegisterTemporaryUserController;
use App\Http\Controllers\Admin\AgreementTypeAgreementController;

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

Route::middleware('admin.auth')->group(base_path('routes/web/admin.php'));

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
