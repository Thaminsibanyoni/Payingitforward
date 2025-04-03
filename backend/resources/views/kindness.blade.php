@extends('layouts.app')

@section('title', 'Kindness Stories - PayingItForward')

@section('content')
<section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-6xl font-bold text-center text-blue-900 mb-8">Kindness Stories</h1>
        <p class="text-xl text-center text-gray-600 max-w-2xl mx-auto mb-12">
            Discover inspiring stories of kindness from our community members. These stories showcase the power of compassion and the positive impact we can make together.
        </p>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/kindness1.jpg" alt="Kindness Story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">A Helping Hand</h3>
                    <p class="text-gray-600 mb-4">How a simple act of kindness changed a life forever.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/kindness2.jpg" alt="Kindness Story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Community Support</h3>
                    <p class="text-gray-600 mb-4">How our community came together during tough times.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/kindness3.jpg" alt="Kindness Story" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">The Power of Giving</h3>
                    <p class="text-gray-600 mb-4">One person's journey to make a difference in their community.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Share Your Story</h2>
        <div class="max-w-2xl mx-auto">
            <form class="bg-white p-8 rounded-lg shadow-md">
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="title">Story Title</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="title" placeholder="Enter your story title">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="story">Your Story</label>
                    <textarea class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="story" rows="6" placeholder="Tell us your story of kindness"></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="image">Upload Image (optional)</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="file" id="image">
                </div>
                <button class="bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition-colors w-full" type="submit">Submit Your Story</button>
            </form>
        </div>
    </div>
</section>
@endsection
