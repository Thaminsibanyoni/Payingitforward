<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the rewards.
     */
    public function index()
    {
        $rewards = Reward::all();
        return response()->json($rewards);
    }

    /**
     * Store a newly created reward in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points_needed' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
        ]);

        $reward = Reward::create($validatedData);
        return response()->json($reward, 201);
    }

    /**
     * Display the specified reward.
     */
    public function show(Reward $reward)
    {
        return response()->json($reward);
    }

    /**
     * Update the specified reward in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'points_needed' => 'integer|min:1',
            'image_url' => 'nullable|url',
        ]);

        $reward->update($validatedData);
        return response()->json($reward, 200);
    }

    /**
     * Remove the specified reward from storage.
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();
        return response()->json(null, 204);
    }
}
