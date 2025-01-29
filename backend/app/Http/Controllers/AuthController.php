<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use App\Models\KycSubmission;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
            'phone' => 'required|string|unique:users'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        // Send phone verification SMS
        $this->sendVerificationCode($user->phone);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()->load('kyc'),
            'kyc_status' => $request->user()->kyc_status
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function submitKycDocs(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:passport,id_card,drivers_license',
            'front_image' => 'required|image|max:2048',
            'back_image' => 'nullable|image|max:2048',
            'selfie_image' => 'required|image|max:2048'
        ]);

        $user = $request->user();

        $submission = KycSubmission::create([
            'user_id' => $user->id,
            'document_type' => $request->document_type,
            'front_image_path' => $request->file('front_image')->store('kyc_docs'),
            'back_image_path' => $request->file('back_image')?->store('kyc_docs'),
            'selfie_image_path' => $request->file('selfie_image')->store('kyc_selfies'),
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'KYC documents submitted for review',
            'submission_id' => $submission->id
        ]);
    }

    private function sendVerificationCode($phone)
    {
        // Twilio verification logic
        $code = rand(100000, 999999);
        
        // Store code in cache for verification
        \Cache::put("phone_verification:$phone", $code, now()->addMinutes(15));
        
        // Actual Twilio API call would go here
        // Twilio::sendSms($phone, "Your verification code is: $code");
        
        return $code;
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric'
        ]);

        $user = $request->user();
        $storedCode = \Cache::get("phone_verification:{$user->phone}");

        if ($storedCode == $request->code) {
            $user->phone_verified_at = now();
            $user->save();
            \Cache::forget("phone_verification:{$user->phone}");
            
            return response()->json(['message' => 'Phone verified successfully']);
        }

        return response()->json(['message' => 'Invalid verification code'], 401);
    }
}
