<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\AdminLogin;
use App\Responses\JSResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(AdminLogin $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return JSResponse::unauthorized('Invalid login credentials');
        }
        $admin = $request->user('admin');
        $token = $admin->createToken('Admin Personal Access Token')->accessToken;
        return JSResponse::success(['user' => $admin, 'token' => $token]);
    }

}
