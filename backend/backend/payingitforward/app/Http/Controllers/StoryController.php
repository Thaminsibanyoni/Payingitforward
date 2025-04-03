<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        return Story::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $story = Story::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        return response()->json($story, 201);
    }

    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $story->update($validatedData);

        return response()->json($story, 200);
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return response()->json(null, 204);
    }
}
