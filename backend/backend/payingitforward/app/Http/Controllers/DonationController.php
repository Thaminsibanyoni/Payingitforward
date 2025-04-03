<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Wallet;
use App\Models\Transaction;

class DonationController extends Controller
{
    public function donate(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:10',
            'cause_id' => 'required|exists:causes,id',
        ]);

        $user = $request->user();
        $wallet = Wallet::where('user_id', $user->id)->firstOrFail();

        if ($wallet->balance >= $validatedData['amount']) {
            $wallet->balance -= $validatedData['amount'];
            $wallet->save();

            $donation = Donation::create([
                'user_id' => $user->id,
                'cause_id' => $validatedData['cause_id'],
                'amount' => $validatedData['amount'],
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'donation',
                'amount' => $validatedData['amount'],
                'cause_id' => $validatedData['cause_id'],
            ]);

            return response()->json(['message' => 'Donation successful'], 200);
        } else {
            return response()->json(['message' => 'Insufficient funds'], 400);
        }
    }

    public function getTransactions(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('user_id', $user->id)->get();

        return response()->json($transactions, 200);
    }

    public function approveWithdrawal(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->type === 'withdrawal' && $transaction->status === 'pending') {
            $transaction->status = 'approved';
            $transaction->save();

            // Logic to handle withdrawal approval (e.g., send email, update user profile)

            return response()->json(['message' => 'Withdrawal approved'], 200);
        } else {
            return response()->json(['message' => 'Invalid transaction'], 400);
        }
    }
}
