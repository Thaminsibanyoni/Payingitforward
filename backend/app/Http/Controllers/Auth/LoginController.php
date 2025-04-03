<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            \Log::info("User {$user->id} logged in successfully.");

            return response()->json(['token' => $token], 200);
        } else {
            \Log::warning("Failed login attempt for email: {$request->email}");
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
