    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'bitcoin' => 'nullable|string',
                'payfast' => 'nullable|string',
                'paypal' => 'nullable|string',
                'paystack' => 'nullable|string',
                'flutterwave' => 'nullable|string',
            ]);

            // Save the API keys to the database or configuration
            foreach ($validatedData as $key => $value) {
                \Config::set("services.$key.api_key", $value);
            }

            // Log successful API key update
            \Log::info("Admin updated API keys");

            return response()->json(['message' => 'API keys updated successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Update API keys error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'withdrawal_id' => 'required|integer',
            ]);

            $withdrawalId = $validatedData['withdrawal_id'];

            // Logic to approve withdrawal (e.g., update database)
            // Assuming there's a Withdrawal model and we're updating its status
            $withdrawal = \App\Models\Withdrawal::findOrFail($withdrawalId);
            $withdrawal->status = 'approved';
            $withdrawal->save();

            // Log successful withdrawal approval
            \Log::info("Admin approved withdrawal ID: {$withdrawalId}");

            return response()->json(['message' => 'Withdrawal approved successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Approve withdrawal error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function denyWithdrawal(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'withdrawal_id' => 'required|integer',
            ]);

            $withdrawalId = $validatedData['withdrawal_id'];

            // Logic to deny withdrawal (e.g., update database)
            // Assuming there's a Withdrawal model and we're updating its status
            $withdrawal = \App\Models\Withdrawal::findOrFail($withdrawalId);
            $withdrawal->status = 'denied';
            $withdrawal->save();

            // Log successful withdrawal denial
            \Log::info("Admin denied withdrawal ID: {$withdrawalId}");

            return response()->json(['message' => 'Withdrawal denied successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Deny withdrawal error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function setRewardRate(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'reward_rate' => 'required|numeric|min:0',
            ]);

            $rewardRate = $validatedData['reward_rate'];

            // Save the reward rate to the configuration
            \Config::set('app.reward_rate', $rewardRate);

            // Log successful reward rate update
            \Log::info("Admin set reward rate to {$rewardRate}");

            return response()->json(['message' => 'Reward rate set successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Set reward rate error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getTransactions(Request $request)
    {
        try {
            // Validate request data if necessary (e.g., filters, pagination)
            // For now, no specific validation is required

            // Logic to get transactions
            $transactions = \App\Models\Transaction::all();

            // Log successful transaction retrieval
            \Log::info("Admin retrieved transactions");

            return response()->json($transactions, 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Get transactions error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Forgot Password
    public function forgotPassword(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $validatedData['email'])->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Generate and send password reset link
            $token = \Str::random(60);
            \DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]);

            // Send email with reset link
            \Mail::to($user->email)->send(new \App\Mail\PasswordReset($token));

            return response()->json(['message' => 'Password reset link sent'], 200);
        } catch (\Exception $e) {
            \Log::error("Forgot password error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // User Management
    public function getUsers(Request $request)
    {
        try {
            $users = User::all();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            \Log::error("Get users error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,' . $id,
                'role' => 'nullable|in:user,admin',
            ]);

            $user = User::findOrFail($id);
            if (isset($validatedData['name'])) {
                $user->name = $validatedData['name'];
            }
            if (isset($validatedData['email'])) {
                $user->email = $validatedData['email'];
            }
            if (isset($validatedData['role'])) {
                $user->role = $validatedData['role'];
            }
            $user->save();

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update user error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function deleteUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Delete user error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Dashboard & Statistics
    public function getDashboardOverview(Request $request)
    {
        try {
            $userCount = User::count();
            $kindnessActCount = \App\Models\KindnessAct::count();
            $donationCount = \App\Models\Transaction::where('type', 'donation')->count();

            return response()->json([
                'user_count' => $userCount,
                'kindness_act_count' => $kindnessActCount,
                'donation_count' => $donationCount,
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Get dashboard overview error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getReports(Request $request)
    {
        try {
            $reports = [
                'kindness_activities' => \App\Models\KindnessAct::with('user')->get(),
                'community_growth' => \App\Models\User::select(\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as count'))->groupBy('date')->get(),
            ];

            return response()->json($reports, 200);
        } catch (\Exception $e) {
            \Log::error("Get reports error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Community & Engagement
    public function getCommunityPosts(Request $request)
    {
        try {
            $posts = \App\Models\CommunityPost::with('user')->get();
            return response()->json($posts, 200);
        } catch (\Exception $e) {
            \Log::error("Get community posts error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateCommunityPost(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'nullable|string',
                'content' => 'nullable|string',
            ]);

            $post = \App\Models\CommunityPost::findOrFail($id);
            if (isset($validatedData['title'])) {
                $post->title = $validatedData['title'];
            }
            if (isset($validatedData['content'])) {
                $post->content = $validatedData['content'];
            }
            $post->save();

            return response()->json(['message' => 'Community post updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update community post error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function deleteCommunityPost(Request $request, $id)
    {
        try {
            $post = \App\Models\CommunityPost::findOrFail($id);
            $post->delete();

            return response()->json(['message' => 'Community post deleted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Delete community post error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getComments(Request $request)
    {
        try {
            $comments = \App\Models\Comment::with('user')->get();
            return response()->json($comments, 200);
        } catch (\Exception $e) {
            \Log::error("Get comments error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateComment(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'content' => 'nullable|string',
            ]);

            $comment = \App\Models\Comment::findOrFail($id);
            if (isset($validatedData['content'])) {
                $comment->content = $validatedData['content'];
            }
            $comment->save();

            return response()->json(['message' => 'Comment updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update comment error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function deleteComment(Request $request, $id)
    {
        try {
            $comment = \App\Models\Comment::findOrFail($id);
            $comment->delete();

            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Delete comment error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Content Management
    public function getHomepageSettings(Request $request)
    {
        try {
            $settings = \Config::get('homepage');
            return response()->json($settings, 200);
        } catch (\Exception $e) {
            \Log::error("Get homepage settings error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateHomepageSettings(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'hero_banner' => 'nullable|string',
                'text' => 'nullable|string',
                'images' => 'nullable|array',
            ]);

            foreach ($validatedData as $key => $value) {
                \Config::set("homepage.$key", $value);
            }

            return response()->json(['message' => 'Homepage settings updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update homepage settings error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getAboutPage(Request $request)
    {
        try {
            $about = \Config::get('about');
            return response()->json($about, 200);
        } catch (\Exception $e) {
            \Log::error("Get about page error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateAboutPage(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'mission' => 'nullable|string',
                'vision' => 'nullable|string',
                'team_info' => 'nullable|string',
            ]);

            foreach ($validatedData as $key => $value) {
                \Config::set("about.$key", $value);
            }

            return response()->json(['message' => 'About page updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update about page error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getContactSettings(Request $request)
    {
        try {
            $contact = \Config::get('contact');
            return response()->json($contact, 200);
        } catch (\Exception $e) {
            \Log::error("Get contact settings error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateContactSettings(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'form_details' => 'nullable|string',
                'support_details' => 'nullable|string',
            ]);

            foreach ($validatedData as $key => $value) {
                \Config::set("contact.$key", $value);
            }

            return response()->json(['message' => 'Contact settings updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update contact settings error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

// Points & Rewards System
    public function getUserPoints(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $points = \App\Models\KindnessPoint::where('user_id', $user->id)->sum('points');

            return response()->json(['points' => $points], 200);
        } catch (\Exception $e) {
            \Log::error("Get user points error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateUserPoints(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'points' => 'required|integer',
            ]);

            $user = User::findOrFail($id);
            $currentPoints = \App\Models\KindnessPoint::where('user_id', $user->id)->sum('points');
            $newPoints = $validatedData['points'];

            if ($newPoints < $currentPoints) {
                \App\Models\KindnessPoint::create([
                    'user_id' => $user->id,
                    'points' => $newPoints - $currentPoints,
                    'reason' => 'Admin adjustment',
                ]);
            } elseif ($newPoints > $currentPoints) {
                \App\Models\KindnessPoint::create([
                    'user_id' => $user->id,
                    'points' => $newPoints - $currentPoints,
                    'reason' => 'Admin adjustment',
                ]);
            }

            return response()->json(['message' => 'User points updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update user points error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Reward Management
    public function getRewards(Request $request)
    {
        try {
            // Validate request data if necessary (e.g., filters, pagination)
            // For now, no specific validation is required

            // Logic to get rewards
            $rewards = \App\Models\Badge::all();

            // Log successful retrieval
            \Log::info("Admin retrieved rewards");

            return response()->json($rewards, 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Get rewards error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function createReward(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'points_required' => 'required|integer|min:0',
                'image_url' => 'nullable|url',
            ]);

            // Create new reward
            $reward = new \App\Models\Badge();
            $reward->name = $validatedData['name'];
            $reward->description = $validatedData['description'] ?? '';
            $reward->points_required = $validatedData['points_required'];
            $reward->image_url = $validatedData['image_url'] ?? '';
            $reward->save();

            // Log successful creation
            \Log::info("Admin created new reward: {$reward->id}");

            return response()->json(['message' => 'Reward created successfully'], 201);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Create reward error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateReward(Request $request, $id)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'points_required' => 'nullable|integer|min:0',
                'image_url' => 'nullable|url',
            ]);

            // Find and update reward
            $reward = \App\Models\Badge::findOrFail($id);
            if (isset($validatedData['name'])) {
                $reward->name = $validatedData['name'];
            }
            if (isset($validatedData['description'])) {
                $reward->description = $validatedData['description'];
            }
            if (isset($validatedData['points_required'])) {
                $reward->points_required = $validatedData['points_required'];
            }
            if (isset($validatedData['image_url'])) {
                $reward->image_url = $validatedData['image_url'];
            }
            $reward->save();

            // Log successful update
            \Log::info("Admin updated reward ID: {$id}");

            return response()->json(['message' => 'Reward updated successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Update reward error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function deleteReward(Request $request, $id)
    {
        try {
            // Find and delete reward
            $reward = \App\Models\Badge::findOrFail($id);
            $reward->delete();

            // Log successful deletion
            \Log::info("Admin deleted reward ID: {$id}");

            return response()->json(['message' => 'Reward deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Delete reward error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Donations & Wallet
    public function getDonations(Request $request)
    {
        try {
            $donations = \App\Models\Transaction::where('type', 'donation')->get();
            return response()->json($donations, 200);
        } catch (\Exception $e) {
            \Log::error("Get donations error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // General Settings
    public function getSettings(Request $request)
    {
        try {
            $settings = \Config::get('app.settings');
            return response()->json($settings, 200);
        } catch (\Exception $e) {
            \Log::error("Get settings error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updateSettings(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'site_name' => 'nullable|string',
                'site_description' => 'nullable|string',
                'site_keywords' => 'nullable|array',
                'maintenance_mode' => 'nullable|boolean',
            ]);

            foreach ($validatedData as $key => $value) {
                \Config::set("app.settings.$key", $value);
            }

            return response()->json(['message' => 'Settings updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error("Update settings error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getSecurityLogs(Request $request)
    {
        try {
            $logs = \App\Models\SecurityLog::all();
            return response()->json($logs, 200);
        } catch (\Exception $e) {
            \Log::error("Get security logs error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'bitcoin' => 'nullable|string',
                'payfast' => 'nullable|string',
                'paypal' => 'nullable|string',
                'paystack' => 'nullable|string',
                'flutterwave' => 'nullable|string',
            ]);

            // Save the API keys to the database or configuration
            foreach ($validatedData as $key => $value) {
                \Config::set("services.$key.api_key", $value);
            }

            // Log successful API key update
            \Log::info("Admin updated API keys");

            return response()->json(['message' => 'API keys updated successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Update API keys error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getApiKeys(Request $request)
    {
        try {
            // Retrieve API keys from configuration
            $apiKeys = [
                'bitcoin' => \Config::get('services.bitcoin.api_key', ''),
                'payfast' => \Config::get('services.payfast.api_key', ''),
                'paypal' => \Config::get('services.paypal.api_key', ''),
                'paystack' => \Config::get('services.paystack.api_key', ''),
                'flutterwave' => \Config::get('services.flutterwave.api_key', ''),
            ];

            // Log successful API key retrieval
            \Log::info("Admin retrieved API keys");

            return response()->json($apiKeys, 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Get API keys error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function approveWithdrawal(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'withdrawal_id' => 'required|integer',
            ]);

            $withdrawalId = $validatedData['withdrawal_id'];

            // Logic to approve withdrawal (e.g., update database)
            // Assuming there's a Withdrawal model and we're updating its status
            $withdrawal = \App\Models\Withdrawal::findOrFail($withdrawalId);
            $withdrawal->status = 'approved';
            $withdrawal->save();

            // Log successful withdrawal approval
            \Log::info("Admin approved withdrawal ID: {$withdrawalId}");

            return response()->json(['message' => 'Withdrawal approved successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Approve withdrawal error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function denyWithdrawal(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'withdrawal_id' => 'required|integer',
            ]);

            $withdrawalId = $validatedData['withdrawal_id'];

            // Logic to deny withdrawal (e.g., update database)
            // Assuming there's a Withdrawal model and we're updating its status
            $withdrawal = \App\Models\Withdrawal::findOrFail($withdrawalId);
            $withdrawal->status = 'denied';
            $withdrawal->save();

            // Log successful withdrawal denial
            \Log::info("Admin denied withdrawal ID: {$withdrawalId}");

            return response()->json(['message' => 'Withdrawal denied successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Deny withdrawal error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function setRewardRate(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'reward_rate' => 'required|numeric|min:0',
            ]);

            $rewardRate = $validatedData['reward_rate'];

            // Save the reward rate to the configuration
            \Config::set('app.reward_rate', $rewardRate);

            // Log successful reward rate update
            \Log::info("Admin set reward rate to {$rewardRate}");

            return response()->json(['message' => 'Reward rate set successfully'], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Set reward rate error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function getTransactions(Request $request)
    {
        try {
            // Validate request data if necessary (e.g., filters, pagination)
            // For now, no specific validation is required

            // Logic to get transactions
            $transactions = \App\Models\Transaction::all();

            // Log successful transaction retrieval
            \Log::info("Admin retrieved transactions");

            return response()->json($transactions, 200);
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error("Get transactions error: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
