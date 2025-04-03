<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Comment;
use App\Models\Point;
use App\Models\Wallet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Act $act)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:500',
        ]);

        // Check if the user has already posted this comment (optional uniqueness check)
        // Assuming basic creation for now
        $comment = $act->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Award 2 points to the commenter
        $this->awardPoints(auth()->user(), 2, 'comment_act');

        // Award 5 points to the act creator
        $this->awardPoints($act->user, 5, 'received_comment');

        return response()->json($comment, 201);
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
