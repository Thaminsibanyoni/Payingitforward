<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $isAdminRegistration = strpos($request->path(), 'admin/register') !== false;

        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        if ($isAdminRegistration) {
            $validationRules['admin_code'] = 'required|string';
        }

        $validatedData = $request->validate($validationRules);

        $sanitizedData = [
            'name' => filter_var($validatedData['name'], FILTER_SANITIZE_STRING),
            'email' => filter_var($validatedData['email'], FILTER_SANITIZE_EMAIL),
            'password' => $validatedData['password'],
        ];

        if ($isAdminRegistration) {
            $adminCode = config('app.admin_registration_code');

            if ($validatedData['admin_code'] !== $adminCode) {
                return response()->json(['error' => 'Invalid admin registration code'], 403);
            }
        }

        $user = User::create([
            'name' => $sanitizedData['name'],
            'email' => $sanitizedData['email'],
            'password' => Hash::make($sanitizedData['password']),
            'is_admin' => $isAdminRegistration ? true : false,
        ]);

        $user->initializeKindnessScore();

        $token = $user->createToken('auth_token')->plainTextToken;

        \Log::info("User {$user->id} registered successfully.");

        return response()->json(['token' => $token], 201);
    }
}
