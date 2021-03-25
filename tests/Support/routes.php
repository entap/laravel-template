<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'log.request'], function () {
    Route::post('/', function () {
        return [
            'message' => 'Hello World',
        ];
    })->name('home');

    Route::delete('/user', function () {
        return response()->noContent();
    })->name('user.destroy');
});
