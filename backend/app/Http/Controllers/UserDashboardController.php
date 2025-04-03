<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Profile & Activity, Donations & Rewards, Post Kindness Stories, Wallet, Notifications
        return view('dashboard.user_dashboard');
    }

    public function profile() {
        // View/edit personal details. Track contributions.
    }

    public function donations() {
        // View donation history. Check reward points.
    }
     public function rewards() {
        // Redeem rewards
    }

    public function stories() {
        // Submit & track community posts.
    }

    public function wallet() {
        // View balance, add funds, withdraw.
    }

    public function notifications() {
        // Receive updates and alerts.
    }
}