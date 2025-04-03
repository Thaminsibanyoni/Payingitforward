<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Point;

class WalletController extends Controller
{
    public function earnPoints(Request $request)
    {
        $user = $request->user();
        $action = $request->input('action');
        $points = $request->input('points');

        Point::create([
            'user_id' => $user->id,
            'points' => $points,
            'action' => $action,
        ]);

        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->balance += $points;
        $wallet->save();

        return response()->json(['message' => 'Points earned successfully'], 200);
    }

    public function redeemReward(Request $request)
    {
        $user = $request->user();
        $rewardId = $request->input('reward_id');

        $reward = Reward::findOrFail($rewardId);
        $wallet = Wallet::where('user_id', $user->id)->firstOrFail();

        if ($wallet->balance >= $reward->points) {
            $wallet->balance -= $reward->points;
            $wallet->save();

            // Logic to handle reward redemption (e.g., send email, update user profile)

            return response()->json(['message' => 'Reward redeemed successfully'], 200);
        } else {
            return response()->json(['message' => 'Insufficient points'], 400);
        }
    }

    public function getBalance(Request $request)
    {
        $user = $request->user();
        $wallet = Wallet::where('user_id', $user->id)->firstOrFail();

        return response()->json(['balance' => $wallet->balance], 200);
    }
}
