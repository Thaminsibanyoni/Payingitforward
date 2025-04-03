<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function addReward(Request $request)
    {
        // Set donation milestones & reward users.
    }

    public function redeemReward(Request $request)
    {
        // Manage redemption requests.
    }
    public function approveReward(Request $request){
        //Admin manually approves large rewards.
    }
}