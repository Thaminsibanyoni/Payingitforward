@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        @if($story->image)
        <img src="{{ asset('storage/' . $story->image) }}" 
             alt="{{ $story->title }}" 
             class="w-full h-96 object-cover rounded-lg mb-6">
        @endif
        
        <h1 class="text-3xl font-bold mb-4">{{ $story->title }}</h1>
        
        <div class="flex items-center text-gray-600 mb-6">
            <div class="flex items-center mr-4">
                <i class="fas fa-user mr-2"></i>
                {{ $story->user->name }}
            </div>
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                {{ $story->created_at->format('M d, Y') }}
            </div>
        </div>

        <div class="prose max-w-none">
            {!! nl2br(e($story->story)) !!}
        </div>
    </div>
</div>
@endsection