<?php

namespace App\Services;

use App\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        return $this->authRepository->register($request);
    }

    public function login(Request $request)
    {
        return $this->authRepository->login($request);
    }
}
