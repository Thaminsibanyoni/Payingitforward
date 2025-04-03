<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/community', [App\Http\Controllers\CommunityController::class, 'index'])->name('community');
Route::get('/donations', [App\Http\Controllers\DonationController::class, 'index'])->name('donations');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/kindness', [App\Http\Controllers\KindnessController::class, 'index'])->name('kindness');
