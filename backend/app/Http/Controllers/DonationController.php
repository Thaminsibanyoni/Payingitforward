<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
   public function show()
   {
       return view('donate');
   }

    public function processDonation(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'payment_method' => 'required|string',
        ]);

        $donation = Donation::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'currency' => $validatedData['currency'],
            'status' => 'pending', // Initial status
            'payment_method' => $validatedData['payment_method'],
        ]);

        // Here you would integrate with the payment gateway (PayFast, PayPal, Stripe)
        // and update the donation status based on the payment result.

        return response()->json(['message' => 'Donation created', 'donation' => $donation], 201);
    }
    public function approveDonation(Request $request)
    {
        //Admin reviews & approves donation entries.
    }
}
