<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;

Route::prefix('admin')->controller(AdminAuthController::class)
    ->group(function () {
        Route::post('registration', 'register')->name('register');
        Route::post('login', 'login')->name('login');
        Route::middleware(['auth:api-admin', 'scope:admin'])->group( function () {
            Route::post('logout', 'logout')->name('logout');
            Route::get('/user', 'me')->name('me');
        });
    });
