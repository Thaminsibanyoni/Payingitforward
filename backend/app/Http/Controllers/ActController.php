<?php

namespace App\Http\Controllers;

use App\Models\Act;
use Illuminate\Http\Request;

class ActController extends Controller
{
    public function index()
    {
        return Act::with(['giver', 'receiver'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $act = $request->user()->actsGiven()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'pending'
        ]);

        return response()->json($act, 201);
    }

    public function complete(Act $act)
    {
        $this->authorize('complete', $act);

        $act->update(['status' => 'completed']);
        $act->giver->increment('acts_given');
        $act->receiver->increment('acts_received');

        return response()->json($act);
    }

    public function payForward(Act $act)
    {
        $this->authorize('payForward', $act);

        $act->update(['status' => 'paid_forward']);
        $act->giver->increment('acts_given');
        $act->receiver->increment('acts_received');

        return response()->json($act);
    }

    public function registerOnChain(Request $request)
    {
        $user = $request->user();
        
        // TODO: Implement blockchain registration
        return response()->json([
            'message' => 'User registered on blockchain',
            'address' => '0x...'
        ]);
    }

    public function logActOnChain(Request $request, Act $act)
    {
        $this->authorize('logAct', $act);
        
        // TODO: Implement blockchain logging
        return response()->json([
            'message' => 'Act logged on blockchain',
            'tx_hash' => '0x...'
        ]);
    }

    public function getTokenBalance(Request $request, $address)
    {
        // TODO: Implement balance check
        return response()->json([
            'address' => $address,
            'balance' => '0'
        ]);
    }
}
