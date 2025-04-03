<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')

@section('title', 'Login - Paying It Forward')

@section('content')
<div class="bg-white p-8 rounded shadow-md w-96">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Sign In
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                Forgot Password?
            </a>
        </div>
    </form>

    <p class="mt-4">Not a member yet? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Sign up now!</a></p>
</div>
@endsection
