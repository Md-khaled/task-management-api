<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\User\UserAuthController;

Route::controller(UserAuthController::class)
    ->group(function () {
        Route::post('registration', 'register')->name('register');
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });
