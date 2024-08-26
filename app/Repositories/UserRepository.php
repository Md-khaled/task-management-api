<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use App\Responses\JSResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserRepository implements AuthInterface
{
    public function register(Request $request)
    {
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return JSResponse::success($admin->toArray(), 'Admin created successfully');
    }

    public function login(Request $request)
    {
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('User Token', ['user'])->accessToken;
            return JSResponse::success(['user' => $user, 'token' => $token]);
        }
        return JSResponse::authenticationException('Invalid login credentials');

    }

    public function logout($request)
    {
        Auth::user()->token()->revoke();

        return JSResponse::success([],'User logged out successfully!');
    }

    public function user($request)
    {
        return JSResponse::success(['user' => Auth::user()],'single user');
    }
}
