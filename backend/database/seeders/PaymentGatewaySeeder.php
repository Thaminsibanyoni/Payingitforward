<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentGatewaySeeder extends Seeder
{
    public function run()
    {
        DB::table('payment_gateways')->insert([
            [
                'name' => 'PayPal',
                'is_enabled' => true,
                'credentials' => json_encode([
                    'client_id' => env('PAYPAL_CLIENT_ID'),
                    'secret' => env('PAYPAL_SECRET'),
                    'mode' => 'sandbox'
                ])
            ],
            [
                'name' => 'Binance',
                'is_enabled' => true,
                'credentials' => json_encode([
                    'api_key' => env('BINANCE_API_KEY'),
                    'secret' => env('BINANCE_API_SECRET'),
                    'api_url' => env('BINANCE_API_URL')
                ])
            ],
            [
                'name' => 'Flutterwave',
                'is_enabled' => false,
                'credentials' => json_encode([])
            ]
        ]);
    }
}
