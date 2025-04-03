@extends('layouts.app')

@section('title', 'Community - PayingItForward')

@section('content')
<section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-6xl font-bold text-center text-blue-900 mb-8">Our Community</h1>
        <p class="text-xl text-center text-gray-600 max-w-2xl mx-auto mb-12">
            Join a network of compassionate individuals making a difference through acts of kindness. Together, we can create a ripple effect of positive change.
        </p>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Connect</h3>
                <p class="text-gray-600">Meet like-minded individuals passionate about making a difference.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Support</h3>
                <p class="text-gray-600">Give and receive help through our community platform.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lightbulb text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Inspire</h3>
                <p class="text-gray-600">Share your stories and ideas to motivate others.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Community Stories</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/story1.jpg" alt="Community Story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Helping Hands</h3>
                    <p class="text-gray-600 mb-4">How our community came together to support a local family in need.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/story2.jpg" alt="Community Story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Education for All</h3>
                    <p class="text-gray-600 mb-4">Our initiative to provide school supplies to underprivileged children.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/story3.jpg" alt="Community Story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Green Future</h3>
                    <p class="text-gray-600 mb-4">How we're working together to create a more sustainable community.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Get Involved</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-usd text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Donate</h3>
                <p class="text-gray-600">Support causes that matter to you through financial contributions.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hands-helping text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Volunteer</h3>
                <p class="text-gray-600">Give your time and skills to make a difference in your community.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullhorn text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Advocate</h3>
                <p class="text-gray-600">Spread awareness and inspire others to join the movement.</p>
            </div>
        </div>
    </div>
</section>
@endsection
