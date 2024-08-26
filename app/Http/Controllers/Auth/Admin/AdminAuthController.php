<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\AdminLogin;
use App\Http\Requests\Auth\Admin\AdminRegistration;
use App\Services\AuthService;
use Illuminate\Support\Facades\Request;


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
        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    public function me(Request $request)
    {
        return $this->authService->user($request);
    }
}
