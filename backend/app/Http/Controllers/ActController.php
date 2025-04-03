<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Point;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ActController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $act = Act::create($request->all());

        // Award 10 points to the creator
        $user = auth()->user();
        if ($user) {
            $this->awardPoints($user, 10, 'act_creation');
        }

        return response()->json($act, 201);
    }

    private function awardPoints($user, $points, $type)
    {
        // Update wallet balance
        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->balance += $points;
        $wallet->save();

        // Record transaction
        Point::create([
            'user_id' => $user->id,
            'points' => $points,
            'type' => $type,
            'description' => ucfirst($type)." point award",
        ]);
    }
}
