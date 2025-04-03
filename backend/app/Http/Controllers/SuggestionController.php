<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuggestionController extends Controller
{
    /**
     * Display a listing of suggestions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'difficulties' => 'nullable|array',
            'difficulties.*' => 'in:Easy,Medium,Hard',
            'impacts' => 'nullable|array',
            'impacts.*' => 'in:Small,Medium,High',
            'categories' => 'nullable|array',
            'categories.*' => 'string',
            'limit' => 'nullable|integer|min:1|max:100',
            'random' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $query = Suggestion::query();
        
        // Apply filters
        if ($request->has('difficulties') && is_array($request->difficulties)) {
            $query->whereIn('difficulty', $request->difficulties);
        }
        
        if ($request->has('impacts') && is_array($request->impacts)) {
            $query->whereIn('impact', $request->impacts);
        }
        
        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereIn('category', $request->categories);
        }
        
        // Featured suggestions
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }
        
        // Random suggestions
        if ($request->has('random') && $request->random) {
            $query->inRandomOrder();
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $limit = $request->limit ?? 10;
        $suggestions = $query->limit($limit)->get();
        
        // Add user-specific flags
        $user = Auth::user();
        if ($user) {
            $suggestions->each(function ($suggestion) use ($user) {
                $suggestion->is_saved = $user->hasSavedSuggestion($suggestion->id);
                $suggestion->is_completed = $user->hasCompletedSuggestion($suggestion->id);
            });
        }
        
        return response()->json($suggestions);
    }

    /**
     * Store a newly created suggestion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'impact' => 'required|in:Small,Medium,High',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $suggestion = new Suggestion([
            'title' => $request->title,
            'description' => $request->description,
            'difficulty' => $request->difficulty,
            'impact' => $request->impact,
            'category' => $request->category,
            'is_featured' => $request->is_featured ?? false,
        ]);
        
        // Calculate estimated points
        $suggestion->estimated_points = $suggestion->calculateEstimatedPoints();
        $suggestion->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Suggestion created successfully',
            'suggestion' => $suggestion,
        ]);
    }

    /**
     * Display the specified suggestion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $suggestion = Suggestion::findOrFail($id);
        
        // Add user-specific flags
        $user = Auth::user();
        if ($user) {
            $suggestion->is_saved = $user->hasSavedSuggestion($suggestion->id);
            $suggestion->is_completed = $user->hasCompletedSuggestion($suggestion->id);
        }
        
        return response()->json($suggestion);
    }

    /**
     * Update the specified suggestion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'in:Easy,Medium,Hard',
            'impact' => 'in:Small,Medium,High',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $suggestion = Suggestion::findOrFail($id);
        
        $suggestion->fill($request->only([
            'title',
            'description',
            'difficulty',
            'impact',
            'category',
            'is_featured',
        ]));
        
        // Recalculate estimated points if difficulty or impact changed
        if ($request->has('difficulty') || $request->has('impact')) {
            $suggestion->estimated_points = $suggestion->calculateEstimatedPoints();
        }
        
        $suggestion->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Suggestion updated successfully',
            'suggestion' => $suggestion,
        ]);
    }

    /**
     * Remove the specified suggestion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $suggestion = Suggestion::findOrFail($id);
        $suggestion->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Suggestion deleted successfully',
        ]);
    }

    /**
     * Save a suggestion for later.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save($id): JsonResponse
    {
        $suggestion = Suggestion::findOrFail($id);
        $user = Auth::user();
        
        if (!$user->hasSavedSuggestion($suggestion->id)) {
            $user->savedSuggestions()->attach($suggestion->id);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Suggestion saved successfully',
        ]);
    }

    /**
     * Unsave a suggestion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsave($id): JsonResponse
    {
        $suggestion = Suggestion::findOrFail($id);
        $user = Auth::user();
        
        $user->savedSuggestions()->detach($suggestion->id);
        
        return response()->json([
            'success' => true,
            'message' => 'Suggestion unsaved successfully',
        ]);
    }

    /**
     * Mark a suggestion as completed.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function complete($id): JsonResponse
    {
        $suggestion = Suggestion::findOrFail($id);
        $user = Auth::user();
        
        if (!$user->hasCompletedSuggestion($suggestion->id)) {
            $user->completedSuggestions()->attach($suggestion->id, ['completed_at' => now()]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Suggestion marked as completed',
        ]);
    }

    /**
     * Get user's saved suggestions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserSavedSuggestions(): JsonResponse
    {
        $user = Auth::user();
        $suggestions = $user->savedSuggestions;
        
        // Add user-specific flags
        $suggestions->each(function ($suggestion) use ($user) {
            $suggestion->is_saved = true;
            $suggestion->is_completed = $user->hasCompletedSuggestion($suggestion->id);
        });
        
        return response()->json($suggestions);
    }

    /**
     * Get user's completed suggestions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserCompletedSuggestions(): JsonResponse
    {
        $user = Auth::user();
        $suggestions = $user->completedSuggestions;
        
        // Add user-specific flags
        $suggestions->each(function ($suggestion) use ($user) {
            $suggestion->is_saved = $user->hasSavedSuggestion($suggestion->id);
            $suggestion->is_completed = true;
            $suggestion->completed_at = $suggestion->pivot->completed_at;
        });
        
        return response()->json($suggestions);
    }
}
