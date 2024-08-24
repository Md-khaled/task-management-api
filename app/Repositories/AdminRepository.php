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
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $admin = $request->user('admin');
        $token = $admin->createToken('Admin Personal Access Token')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
