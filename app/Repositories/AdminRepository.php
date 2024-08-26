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
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            config(['auth.guards.api.provider' => 'admin']);
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('Admin_PersonalAccess_Token', ['admin'])->accessToken;
            return JSResponse::success(['user' => $admin, 'token' => $token]);
        }

        return JSResponse::authenticationException('Invalid login credentials');
    }

    public function logout($request)
    {
        auth()->user()->token()->revoke();
        return JSResponse::success([], 'Admin logged out successfully!');
    }

    public function user($request)
    {
        return JSResponse::success(['user' => Auth::user()],'single user');
    }
}
