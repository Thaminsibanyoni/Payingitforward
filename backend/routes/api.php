<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ActController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PaymentController;

Route::apiResource('acts', ActController::class);
Route::post('/acts/{act}/likes', [LikeController::class, 'store']);
Route::post('/acts/{act}/comments', [CommentController::class, 'store']);

Route::apiResource('rewards', RewardController::class);
Route::apiResource('donations', DonationController::class);
Route::apiResource('wallets', WalletController::class);
Route::apiResource('points', PointController::class);

Route::post('/donations/process', [DonationController::class, 'processDonation']);
Route::post('/donations/approve', [DonationController::class, 'approveDonation']);
Route::post('/rewards/approve', [RewardsController::class, 'approveReward']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
