<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // PayPal Integration
    public function handlePayPalCallback(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $response = Http::withBasicAuth(
            config('services.paypal.client_id'),
            config('services.paypal.secret')
        )->post(config('services.paypal.url').'/v1/payments/payment/'.$paymentId.'/execute', [
            'payer_id' => $payerId
        ]);

        if ($response->successful()) {
            // Process successful payment
            return response()->json([
                'status' => 'completed',
                'txn_id' => $response->json('id')
            ]);
        }

        Log::error('PayPal payment failed: '.$response->body());
        return response()->json(['error' => 'Payment failed'], 400);
    }

    // Binance Integration
    public function createBinanceOrder(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string|size:3'
        ]);

        $payload = [
            'merchantTradeNo' => uniqid(),
            'totalAmount' => $validated['amount'],
            'currency' => $validated['currency'],
            'timestamp' => time()
        ];

        $signature = hash_hmac('sha256', http_build_query($payload), 
            config('services.binance.secret'));

        $response = Http::withHeaders([
            'X-MBX-APIKEY' => config('services.binance.key')
        ])->post(config('services.binance.url').'/sapi/v1/payment/create', [
            ...$payload,
            'signature' => $signature
        ]);

        return $response->json();
    }
}
