<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $response = Http::post('https://sandbox.payfast.co.za/eng/process', [
            'merchant_id' => env('PAYFAST_MERCHANT_ID'),
            'merchant_key' => env('PAYFAST_MERCHANT_KEY'),
            'amount' => $request->amount,
            'item_name' => 'Donation',
            'return_url' => route('payment.callback'),
            'cancel_url' => route('payment.cancel'),
            'notify_url' => route('payment.notify'),
        ]);

        if ($response->successful()) {
            $payment = Payment::create([
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'status' => 'pending',
                'transaction_id' => $response->json('pf_payment_id'),
            ]);

            return response()->json([
                'payment_url' => $response->json('form_url'),
                'payment_id' => $payment->id,
            ]);
        }

        return response()->json(['error' => 'Payment creation failed'], 500);
    }

    public function paymentCallback(Request $request)
    {
        $payment = Payment::where('transaction_id', $request->pf_payment_id)->first();
        if ($payment) {
            $payment->update([
                'status' => 'completed',
            ]);
        }

        return view('payment.success');
    }

    public function paymentCancel(Request $request)
    {
        $payment = Payment::where('transaction_id', $request->pf_payment_id)->first();
        if ($payment) {
            $payment->update([
                'status' => 'cancelled',
            ]);
        }

        return view('payment.cancel');
    }

    public function paymentNotify(Request $request)
    {
        // Handle payment notification from PayFast
        // Update payment status based on the notification
    }
}
