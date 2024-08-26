<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\UserLogin;
use App\Http\Requests\Auth\User\UserRegistration;
use App\Services\AuthService;
use Illuminate\Support\Facades\Request;

class UserAuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(UserRegistration $request)
    {
        return $this->authService->register($request);

    }

    public function login(UserLogin $request)
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
