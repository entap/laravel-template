<?php

use App\Http\Controllers\Admin\MailTemplateController;
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
});
