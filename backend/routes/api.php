<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

Route::prefix('v1')->group(function() {
    // Authentication routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // User endpoints
        Route::get('/user', [AuthController::class, 'getCurrentUser']);
        Route::put('/user', [AuthController::class, 'updateProfile']);
        Route::post('/user/kyc', [AuthController::class, 'submitKyc']);
        Route::get('/user/transactions', [AuthController::class, 'getTransactions']);
        
        // Notifications
        Route::get('/notifications', [AuthController::class, 'getNotifications']);
        Route::put('/notifications/{id}/read', [AuthController::class, 'markNotificationRead']);

        // Act endpoints
        Route::apiResource('acts', ActController::class)->only([
            'index', 'store'
        ]);
        
        Route::post('/acts/{act}/complete', [ActController::class, 'complete']);
        Route::post('/acts/{act}/pay-forward', [ActController::class, 'payForward']);
        
        // Blockchain endpoints
        Route::post('/blockchain/register', [ActController::class, 'registerOnChain']);
        Route::post('/blockchain/log-act', [ActController::class, 'logActOnChain']);
        Route::get('/blockchain/balance/{address}', [ActController::class, 'getTokenBalance']);
        
        // Payment endpoints
        Route::post('/payments/deposit', [PaymentController::class, 'initiateDeposit']);
        Route::post('/payments/withdraw', [PaymentController::class, 'initiateWithdrawal']);
        Route::get('/payments/gateways', [PaymentController::class, 'getPaymentGateways']);
    });
});
