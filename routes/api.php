<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*api configuration*/
Route::prefix('admin')->as('admin.')->group(base_path() . '/routes/admin.php');

Route::prefix('user')->as('user.')->group(base_path() . '/routes/user.php');
