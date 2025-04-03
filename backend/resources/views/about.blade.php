@extends('layouts.app')

@section('title', 'About - PayingItForward')

@section('content')
<section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-6xl font-bold text-center text-blue-900 mb-8">About PayingItForward</h1>
        <div class="grid md:grid-cols-2 gap-12">
            <div>
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    At PayingItForward, we believe in the power of kindness to create positive change. Our mission is to build a global community where people can support each other through acts of generosity, creating a ripple effect of compassion.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    We provide a platform that connects individuals and organizations, making it easy to give and receive help in meaningful ways.
                </p>
            </div>
            <div>
                <img src="/images/about-hero.jpg" alt="About PayingItForward" class="rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Our Values</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Compassion</h3>
                <p class="text-gray-600">We approach every interaction with empathy and understanding.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Community</h3>
                <p class="text-gray-600">We believe in the power of collective action to create change.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Integrity</h3>
                <p class="text-gray-600">We are committed to transparency and ethical practices.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Our Team</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="/images/team1.jpg" alt="Team Member" class="rounded-full w-32 h-32 mx-auto mb-4">
                <h3 class="text-xl font-bold text-center text-blue-900 mb-2">John Doe</h3>
                <p class="text-gray-600 text-center">CEO & Founder</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="/images/team2.jpg" alt="Team Member" class="rounded-full w-32 h-32 mx-auto mb-4">
                <h3 class="text-xl font-bold text-center text-blue-900 mb-2">Jane Smith</h3>
                <p class="text-gray-600 text-center">Chief Operations Officer</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="/images/team3.jpg" alt="Team Member" class="rounded-full w-32 h-32 mx-auto mb-4">
                <h3 class="text-xl font-bold text-center text-blue-900 mb-2">Mike Johnson</h3>
                <p class="text-gray-600 text-center">Head of Technology</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Our Impact</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-blue-900 text-center mb-2">1,203+</div>
                <div class="text-gray-600 text-center">Acts of Kindness</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-blue-900 text-center mb-2">$582K+</div>
                <div class="text-gray-600 text-center">Donations Raised</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-blue-900 text-center mb-2">4,892+</div>
                <div class="text-gray-600 text-center">Community Members</div>
            </div>
        </div>
    </div>
</section>
@endsection
