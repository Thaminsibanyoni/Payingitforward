@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-[70vh] bg-blue-900 text-white flex items-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6">A small act of kindness can change the world</h1>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('register') }}" class="bg-white text-blue-900 px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-100 transition-colors">
                Join the Movement
            </a>
            <a href="/donate" class="border-2 border-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-900 transition-colors">
                Make a Donation
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-12 text-center">
            <div class="p-6">
                <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hands-helping text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Give Kindness</h3>
                <p class="text-gray-600">Support causes you care about through donations or volunteer work</p>
            </div>
            <div class="p-6">
                <div class="bg-orange-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Receive Help</h3>
                <p class="text-gray-600">Request support from our compassionate community when you need it</p>
            </div>
            <div class="p-6">
                <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Join Community</h3>
                <p class="text-gray-600">Connect with like-minded people making a difference</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-green-900 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Sign Up</h3>
                <p class="text-gray-600">Create your account to join our community of kindness</p>
            </div>
            <div class="text-center p-6">
                <div class="bg-orange-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-orange-900 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Find a Cause</h3>
                <p class="text-gray-600">Discover meaningful opportunities to make a difference</p>
            </div>
            <div class="text-center p-6">
                <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-blue-900 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Give or Receive</h3>
                <p class="text-gray-600">Support others or request help when you need it</p>
            </div>
        </div>
    </div>
</section>

<!-- Impact Stats -->
<section class="bg-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-blue-900 mb-2">1,203+</div>
                <div class="text-gray-600">Acts of Kindness</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-blue-900 mb-2">$582K+</div>
                <div class="text-gray-600">Donations Raised</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-blue-900 mb-2">4,892+</div>
                <div class="text-gray-600">Community Members</div>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Recent Success Stories</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="/images/story1.jpg" alt="Success story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <img src="/images/user1.jpg" alt="User" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <div class="font-semibold">Sarah Johnson</div>
                            <div class="text-sm text-gray-500">Cape Town</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Thanks to PayItForward, we provided school supplies for 200 children in need!"</p>
                </div>
            </div>
            <!-- Repeat similar blocks for other stories -->
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">About Us</h3>
                <ul class="space-y-2">
                    <li><a href="/about" class="hover:text-blue-300">Our Mission</a></li>
                    <li><a href="/team" class="hover:text-blue-300">Meet the Team</a></li>
                    <li><a href="/impact" class="hover:text-blue-300">Our Impact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/kindness" class="hover:text-blue-300">Spread Kindness</a></li>
                    <li><a href="/community" class="hover:text-blue-300">Join Community</a></li>
                    <li><a href="/events" class="hover:text-blue-300">Upcoming Events</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Contact Us</h3>
                <ul class="space-y-2">
                    <li>Email: info@payitforward.com</li>
                    <li>Phone: +27 21 123 4567</li>
                    <li>Address: Cape Town, South Africa</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="hover:text-blue-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="hover:text-blue-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="hover:text-blue-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center">
            <p>&copy; 2025 PayItForward. All rights reserved.</p>
        </div>
    </div>
</footer>
@endsection
