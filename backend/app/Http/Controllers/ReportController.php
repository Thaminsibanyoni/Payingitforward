<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Act;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalActs = Act::count();
        $totalDonations = Payment::where('status', 'completed')->sum('amount');
        $mostActiveCategories = Act::select('category_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->with('category:id,name')
            ->take(5)
            ->get();

        return response()->json([
            'total_users' => $totalUsers,
            'total_acts' => $totalActs,
            'total_donations' => $totalDonations,
            'most_active_categories' => $mostActiveCategories,
        ]);
    }
}
