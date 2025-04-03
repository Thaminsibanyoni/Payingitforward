<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

class RewardController extends Controller
{
    public function index()
    {
        return Reward::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'required|integer',
        ]);

        $reward = Reward::create($validatedData);

        return response()->json($reward, 201);
    }

    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'points' => 'sometimes|required|integer',
        ]);

        $reward->update($validatedData);

        return response()->json($reward, 200);
    }

    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();

        return response()->json(null, 204);
    }
}
