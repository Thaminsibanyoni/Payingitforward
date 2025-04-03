<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Like;
use App\Models\Point;
use App\Models\Wallet;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Act $act)
    {
        // Validate request (assuming user is authenticated)
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if the user has already liked this act
        $existingLike = $act->likes()->where('user_id', auth()->id())->first();
        if ($existingLike) {
            return response()->json(['error' => 'Already liked'], 422);
        }

        // Create the like
        $like = $act->likes()->create([
            'user_id' => auth()->id(),
        ]);

        // Award 2 points to the user who liked
        $this->awardPoints(auth()->user(), 2, 'like_act');

        // Award 5 points to the act creator
        $this->awardPoints($act->user, 5, 'received_like');

        return response()->json($like, 201);
    }

    private function awardPoints($user, $points, $type)
    {
        if (!$user) return;

        // Update wallet balance
        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->balance += $points;
        $wallet->save();

        // Record the point transaction
        Point::create([
            'user_id' => $user->id,
            'points' => $points,
            'type' => $type,
            'description' => ucfirst($type) . ' point award',
        ]);
    }
}
