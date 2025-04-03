<?php

namespace App\Http\Controllers;

use App\Models\KindnessAct;
use App\Models\KindnessActCollaborator;
use App\Models\KindnessActRecipient;
use App\Models\KindnessPoint;
use App\Models\KindnessScore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KindnessActController extends Controller
{
    /**
     * Display a listing of kindness acts (feed).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = KindnessAct::with(['user', 'recipients', 'collaborators'])
            ->where('is_public', true)
            ->orderBy('created_at', 'desc');
            
        // Apply filters if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('impact')) {
            $query->where('expected_impact', $request->impact);
        }
        
        if ($request->has('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }
        
        $kindnessActs = $query->paginate(10);
        
        return response()->json($kindnessActs);
    }

    /**
     * Store a newly created kindness act.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'recipient_type' => 'required|in:anonymous,known',
            'is_public' => 'boolean',
            'allow_verification' => 'boolean',
            'image' => 'nullable|image|max:5120', // 5MB max
            'tags' => 'nullable|array',
            'impact_description' => 'nullable|string',
            'expected_impact' => 'nullable|in:small,medium,large',
            'resources_used' => 'nullable|array',
            'inspiration' => 'nullable|string',
            'follow_up_plans' => 'nullable|string',
            'is_part_of_chain' => 'boolean',
            'previous_act_id' => 'nullable|exists:kindness_acts,id',
            'estimated_completion_time' => 'nullable|string|max:255',
            'is_recurring' => 'boolean',
            'recurring_frequency' => 'nullable|string|max:255',
            'recipients' => 'nullable|array',
            'recipients.*.name' => 'required_with:recipients|string|max:255',
            'recipients.*.email' => 'nullable|email|max:255',
            'recipients.*.relationship' => 'nullable|string|max:255',
            'collaborators' => 'nullable|array',
            'collaborators.*.name' => 'required_with:collaborators|string|max:255',
            'collaborators.*.email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('kindness-acts', 'public');
            }
            
            // Create kindness act
            $kindnessAct = new KindnessAct([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'location' => $request->location,
                'date' => $request->date,
                'recipient_type' => $request->recipient_type,
                'is_public' => $request->is_public ?? true,
                'allow_verification' => $request->allow_verification ?? true,
                'image_path' => $imagePath,
                'tags' => $request->tags,
                'impact_description' => $request->impact_description,
                'expected_impact' => $request->expected_impact ?? 'medium',
                'resources_used' => $request->resources_used,
                'inspiration' => $request->inspiration,
                'follow_up_plans' => $request->follow_up_plans,
                'is_part_of_chain' => $request->is_part_of_chain ?? false,
                'previous_act_id' => $request->previous_act_id,
                'estimated_completion_time' => $request->estimated_completion_time,
                'is_recurring' => $request->is_recurring ?? false,
                'recurring_frequency' => $request->recurring_frequency,
            ]);
            
            $kindnessAct->save();
            
            // Add recipients if provided
            if ($request->has('recipients') && is_array($request->recipients)) {
                foreach ($request->recipients as $recipientData) {
                    $kindnessAct->recipients()->create([
                        'name' => $recipientData['name'],
                        'email' => $recipientData['email'] ?? null,
                        'relationship' => $recipientData['relationship'] ?? null,
                    ]);
                }
            }
            
            // Add collaborators if provided
            if ($request->has('collaborators') && is_array($request->collaborators)) {
                foreach ($request->collaborators as $collaboratorData) {
                    $kindnessAct->collaborators()->create([
                        'name' => $collaboratorData['name'],
                        'email' => $collaboratorData['email'] ?? null,
                    ]);
                }
            }
            
            // Calculate and award points
            $points = $kindnessAct->calculatePoints();
            $kindnessAct->points_earned = $points;
            $kindnessAct->save();
            
            // Create points record
            KindnessPoint::create([
                'user_id' => Auth::id(),
                'kindness_act_id' => $kindnessAct->id,
                'points' => $points,
                'description' => 'Submitted kindness act: ' . $kindnessAct->title,
                'category' => $kindnessAct->category,
            ]);
            
            // Update user's kindness score
            $user = Auth::user();
            $kindnessScore = $user->kindnessScore;
            
            if (!$kindnessScore) {
                $user->initializeKindnessScore();
                $kindnessScore = $user->kindnessScore;
            }
            
            $kindnessScore->updateScores($kindnessAct);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kindness act submitted successfully',
                'kindness_act' => $kindnessAct->load(['recipients', 'collaborators']),
                'points_earned' => $points,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded image if exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit kindness act',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified kindness act.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $kindnessAct = KindnessAct::with(['user', 'recipients', 'collaborators', 'previousAct', 'nextActs'])
            ->findOrFail($id);
            
        // Check if the act is public or belongs to the authenticated user
        if (!$kindnessAct->is_public && $kindnessAct->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        return response()->json($kindnessAct);
    }

    /**
     * Update the specified kindness act.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $kindnessAct = KindnessAct::findOrFail($id);
        
        // Check if the user is authorized to update this act
        if ($kindnessAct->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'category' => 'string|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'date',
            'is_public' => 'boolean',
            'allow_verification' => 'boolean',
            'image' => 'nullable|image|max:5120', // 5MB max
            'tags' => 'nullable|array',
            'impact_description' => 'nullable|string',
            'expected_impact' => 'nullable|in:small,medium,large',
            'resources_used' => 'nullable|array',
            'inspiration' => 'nullable|string',
            'follow_up_plans' => 'nullable|string',
            'is_recurring' => 'boolean',
            'recurring_frequency' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($kindnessAct->image_path && Storage::disk('public')->exists($kindnessAct->image_path)) {
                    Storage::disk('public')->delete($kindnessAct->image_path);
                }
                
                $imagePath = $request->file('image')->store('kindness-acts', 'public');
                $kindnessAct->image_path = $imagePath;
            }
            
            // Update kindness act
            $kindnessAct->fill($request->only([
                'title',
                'description',
                'category',
                'location',
                'date',
                'is_public',
                'allow_verification',
                'tags',
                'impact_description',
                'expected_impact',
                'resources_used',
                'inspiration',
                'follow_up_plans',
                'is_recurring',
                'recurring_frequency',
            ]));
            
            $kindnessAct->save();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kindness act updated successfully',
                'kindness_act' => $kindnessAct->load(['recipients', 'collaborators']),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update kindness act',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified kindness act.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $kindnessAct = KindnessAct::findOrFail($id);
        
        // Check if the user is authorized to delete this act
        if ($kindnessAct->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        try {
            DB::beginTransaction();
            
            // Delete image if exists
            if ($kindnessAct->image_path && Storage::disk('public')->exists($kindnessAct->image_path)) {
                Storage::disk('public')->delete($kindnessAct->image_path);
            }
            
            // Delete related records
            $kindnessAct->recipients()->delete();
            $kindnessAct->collaborators()->delete();
            
            // Update points
            $points = KindnessPoint::where('kindness_act_id', $kindnessAct->id)->first();
            if ($points) {
                $points->kindness_act_id = null;
                $points->description = 'Points from deleted kindness act';
                $points->save();
            }
            
            // Delete the act
            $kindnessAct->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kindness act deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete kindness act',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Like a kindness act.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function like($id): JsonResponse
    {
        $kindnessAct = KindnessAct::findOrFail($id);
        
        $kindnessAct->likes_count += 1;
        $kindnessAct->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Kindness act liked successfully',
            'likes_count' => $kindnessAct->likes_count,
        ]);
    }

    /**
     * Verify a kindness act as a recipient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'recipient_id' => 'required|exists:kindness_act_recipients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kindnessAct = KindnessAct::findOrFail($id);
        $recipient = KindnessActRecipient::findOrFail($request->recipient_id);
        
        // Check if the recipient belongs to this kindness act
        if ($recipient->kindness_act_id !== $kindnessAct->id) {
            return response()->json(['message' => 'Invalid recipient for this kindness act'], 400);
        }
        
        // Check if verification is allowed
        if (!$kindnessAct->allow_verification) {
            return response()->json(['message' => 'Verification is not allowed for this kindness act'], 400);
        }
        
        try {
            DB::beginTransaction();
            
            // Mark recipient as verified
            $recipient->has_verified = true;
            $recipient->save();
            
            // Check if all recipients have verified
            $allVerified = $kindnessAct->recipients()
                ->where('has_verified', false)
                ->doesntExist();
                
            if ($allVerified) {
                $kindnessAct->is_verified = true;
                $kindnessAct->save();
                
                // Award verification points to the user
                KindnessPoint::create([
                    'user_id' => $kindnessAct->user_id,
                    'kindness_act_id' => $kindnessAct->id,
                    'points' => 15,
                    'description' => 'Kindness act verified by recipient(s)',
                    'category' => 'verification',
                ]);
                
                // Update user's kindness score
                $user = $kindnessAct->user;
                $kindnessScore = $user->kindnessScore;
                
                if ($kindnessScore) {
                    $kindnessScore->verification_score = min(5.0, $kindnessScore->verification_score + 0.2);
                    $kindnessScore->current_score = ($kindnessScore->consistency_score + $kindnessScore->impact_score + 
                        $kindnessScore->community_score + $kindnessScore->verification_score + $kindnessScore->diversity_score) / 5;
                    $kindnessScore->save();
                }
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kindness act verified successfully',
                'is_fully_verified' => $kindnessAct->is_verified,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify kindness act',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user's kindness acts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserActs(): JsonResponse
    {
        $kindnessActs = KindnessAct::with(['recipients', 'collaborators'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return response()->json($kindnessActs);
    }
    
    /**
     * Get all kindness acts for admin management.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllActs(): JsonResponse
    {
        // Admin can view all acts regardless of privacy setting
        $kindnessActs = KindnessAct::with(['user', 'recipients', 'collaborators'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return response()->json($kindnessActs);
    }

    /**
     * Approve a pending kindness act.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveAct($id): JsonResponse
    {
        $kindnessAct = KindnessAct::findOrFail($id);
        
        if ($kindnessAct->is_approved) {
            return response()->json([
                'success' => false,
                'message' => 'Kindness act is already approved',
            ], 400);
        }
        
        try {
            DB::beginTransaction();
            
            $kindnessAct->is_approved = true;
            $kindnessAct->approved_at = now();
            $kindnessAct->save();
            
            // Award points to user
            KindnessPoint::create([
                'user_id' => $kindnessAct->user_id,
                'kindness_act_id' => $kindnessAct->id,
                'points' => $kindnessAct->points_earned,
                'description' => 'Approved kindness act: ' . $kindnessAct->title,
                'category' => $kindnessAct->category,
            ]);
            
            // Update user's kindness score
            $user = $kindnessAct->user;
            $kindnessScore = $user->kindnessScore;
            
            if (!$kindnessScore) {
                $user->initializeKindnessScore();
                $kindnessScore = $user->kindnessScore;
            }
            
            $kindnessScore->updateScores($kindnessAct);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kindness act approved successfully',
                'kindness_act' => $kindnessAct->load(['user', 'recipients', 'collaborators']),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve kindness act',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Reject a pending kindness act.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectAct($id): JsonResponse
    {
        $kindnessAct = KindnessAct::findOrFail($id);
        
        if ($kindnessAct->is_approved || $kindnessAct->is_rejected) {
            return response()->json([
                'success' => false,
                'message' => 'Kindness act is already processed',
            ], 400);
        }
        
        try {
            DB::beginTransaction();
            
            $kindnessAct->is_rejected = true;
            $kindnessAct->rejected_at = now();
            $kindnessAct->rejection_reason = request('reason');
            $kindnessAct->save();
            
            // Notify user about rejection
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kindness act rejected successfully',
                'kindness_act' => $kindnessAct->load(['user', 'recipients', 'collaborators']),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject kindness act',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
