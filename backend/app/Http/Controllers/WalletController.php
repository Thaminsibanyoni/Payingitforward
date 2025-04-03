<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display the specified wallet for a user.
     */
    public function show(Request $request)
    {
        $userId = $request->query('user_id');
        if (!$userId) {
            return response()->json(['error' => 'user_id is required'], 400);
        }

        $wallet = Wallet::where('user_id', $userId)->first();

        if (!$wallet) {
            return response()->json(['error' => 'Wallet not found for this user'], 404);
        }

        return response()->json($wallet);
    }

    /**
     * Initialize a wallet for a new user.
     * This would typically be called during user registration.
     */
    public function initializeWallet(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|unique:wallets',
            'balance' => 'numeric|min:0', // Initial balance can be set here, default to 0
        ]);

        $wallet = Wallet::create($validatedData);
        return response()->json($wallet, 201);
    }

    /**
     * Update the wallet balance (e.g., add or deduct points/funds).
     */
    public function updateBalance(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:wallets,user_id',
            'amount' => 'required|numeric', // Amount to add or deduct (can be negative)
        ]);

        $wallet = Wallet::where('user_id', $validatedData['user_id'])->first();

        if (!$wallet) {
            return response()->json(['error' => 'Wallet not found for this user'], 404);
        }

        $wallet->balance += $validatedData['amount'];
        $wallet->save();

        return response()->json($wallet, 200);
    }
}
