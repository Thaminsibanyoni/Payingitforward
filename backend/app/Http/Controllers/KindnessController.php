<?php

namespace App\Http\Controllers;

use App\Models\KindnessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KindnessController extends Controller
{
 public function index()
 {
     $stories = KindnessStory::where('status', 'approved')->latest()->get();
     return view('kindness', compact('stories'));
 }

 public function show(KindnessStory $story)
 {
     return view('kindness.show', compact('story'));
 }

 public function submit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'story' => 'required|string',
            'image' => 'nullable|image|max:2048', // Max file size of 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kindness_stories', 'public');
        }


        $story = KindnessStory::create([
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'title' => $request->title,
            'story' => $request->story,
            'image' => $imagePath,
            'status' => 'pending', // Set initial status to pending
        ]);


        return redirect()->route('kindness')->with('success', 'Your kindness story has been submitted for review.');
    }
}
