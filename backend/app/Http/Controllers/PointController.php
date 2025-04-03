<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of points for a user.
     */
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        if (!$userId) {
            return response()->json(['error' => 'user_id is required'], 400);
        }

        $points = Point::where('user_id', $userId)->get();
        return response()->json($points);
    }

    /**
     * Store a newly created point record.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'act_id' => 'nullable|exists:acts,id', // Optional act for which points are awarded
            'points' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $point = Point::create($validatedData);
        return response()->json($point, 201);
    }

    /**
     * Display the specified point record.
     */
    public function show(Point $point)
    {
        return response()->json($point);
    }

    /**
     * Remove the specified point record from storage.
     */
    public function destroy(Point $point)
    {
        $point->delete();
        return response()->json(null, 204);
    }
}
