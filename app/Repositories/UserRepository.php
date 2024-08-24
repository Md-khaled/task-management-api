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
        if (!Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return JSResponse::authenticationException('Invalid login credentials');
        }
        $user = auth()->guard('web')->user();
        $token = $user->createToken('User_PersonalAccess_Token')->accessToken;
        return JSResponse::success(['user' => $user, 'token' => $token]);
    }

    public function logout($request)
    {
        Auth::guard('web')->logout();
        return JSResponse::success([],'User logged out successfully!');
    }
}
