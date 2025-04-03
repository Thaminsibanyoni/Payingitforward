<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Post routes
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});

// Story routes
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/stories', [StoryController::class, 'index']);
    Route::post('/stories', [StoryController::class, 'store']);
    Route::put('/stories/{id}', [StoryController::class, 'update']);
    Route::delete('/stories/{id}', [StoryController::class, 'destroy']);
});

// Message routes
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::delete('/messages/{id}', [MessageController::class, 'destroy']);
});

// Wallet routes
Route::middleware('auth:api')->group(function () {
    Route::post('/earn-points', [WalletController::class, 'earnPoints']);
    Route::post('/redeem-reward', [WalletController::class, 'redeemReward']);
    Route::get('/balance', [WalletController::class, 'getBalance']);
});

// Reward routes
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/rewards', [RewardController::class, 'index']);
    Route::post('/rewards', [RewardController::class, 'store']);
    Route::put('/rewards/{id}', [RewardController::class, 'update']);
    Route::delete('/rewards/{id}', [RewardController::class, 'destroy']);
});

// Donation routes
Route::middleware('auth:api')->group(function () {
    Route::post('/donate', [DonationController::class, 'donate']);
    Route::get('/transactions', [DonationController::class, 'getTransactions']);
    Route::post('/approve-withdrawal/{id}', [DonationController::class, 'approveWithdrawal']);
});
