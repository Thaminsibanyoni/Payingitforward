<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')

@section('title', 'Donate - Paying It Forward')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-bold text-center mb-4 text-dark-blue">Support Paying It Forward</h1>
        <p class="text-lg text-center mb-6">
            Your generous donations help us continue our mission of spreading kindness and building a supportive community. Every contribution, big or small, makes a difference!
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold text-center mb-4">Why Donate?</h2>
        <p class="text-center">
            Donations directly support our platform, enabling us to:
        </p>
        <ul class="list-disc list-inside text-center">
            <li>Maintain and improve the website and its features.</li>
            <li>Expand our reach to connect more people.</li>
            <li>Develop new initiatives to promote kindness.</li>
            <li>Provide resources and support to our community members.</li>
        </ul>
        
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold text-center mb-4">Donation Options</h2>
        <div class="grid md:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-lg p-6 shadow">
                <h3 class="text-xl font-semibold mb-2">One-Time Donation</h3>
                <p class="text-gray-600 mb-4">Make a single contribution of any amount.</p>
                
            </div>

            
            <div class="bg-white rounded-lg p-6 shadow">
                <h3 class="text-xl font-semibold mb-2">Recurring Donation</h3>
                <p class="text-gray-600 mb-4">Set up a monthly or yearly recurring donation.</p>
                
            </div>
        </div>
        <div class="mt-4 text-center">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-dark-blue">
                <span class="ml-2 text-gray-700">Donate Anonymously</span>
            </label>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold text-center mb-4">Payment Methods</h2>
        <p class="text-center text-gray-600">
            Placeholder for payment integration options (PayFast, PayPal, card payments).
        </p>
        
    </section>

    <section>
        <h2 class="text-2xl font-bold text-center mb-4">Top Contributors</h2>
        <p class="text-center text-gray-600">
            Placeholder for leaderboard (optional, based on user preference).
        </p>
        
    </section>
@endsection
</html>