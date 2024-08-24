<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\AdminLogin;
use App\Http\Requests\Auth\Admin\AdminRegistration;
use App\Models\Admin;
use App\Responses\JSResponse;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(AdminRegistration $request)
    {
        return $this->authService->register($request);

    }

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
