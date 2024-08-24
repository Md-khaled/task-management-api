<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\Admin;
use App\Responses\JSResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminRepository implements AuthInterface
{
    public function register(Request $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return JSResponse::success($admin->toArray(), 'Admin created successfully');
    }

    public function login(Request $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return JSResponse::authenticationException('Invalid login credentials');
        }
        $admin = auth()->guard('admin')->user();
        $token = $admin->createToken('Admin_PersonalAccess_Token')->accessToken;
        return JSResponse::success(['user' => $admin, 'token' => $token]);
    }

    public function logout($request)
    {
        Auth::guard('admin')->logout();
        return JSResponse::success([], 'Admin logged out successfully!');
    }
}
