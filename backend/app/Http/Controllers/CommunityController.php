<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KindnessStory;

class CommunityController extends Controller
{
    public function postStory(Request $request)
    {
        // This logic is now handled in KindnessController@submit
    }

    public function moderateStory(Request $request)
    {
        // Approve or reject stories (admin function).  This will be handled in the AdminController.
    }
     public function show()
    {
        $stories = KindnessStory::where('status', 'approved')->latest()->get();
        return view('community', compact('stories'));
    }
}
