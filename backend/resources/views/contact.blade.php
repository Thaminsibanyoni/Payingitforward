<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')

@section('title', 'Contact Us - Paying It Forward')

@section('content')
    <header class="mb-4">
        <h1 class="text-2xl font-bold text-blue-900">We'd Love to Hear from You!</h1>
   <header class="mb-4">
       <h1 class="text-3xl font-bold text-center text-dark-blue">Contact Us</h1>
   </header>

   <section class="mb-8">
       <h2 class="text-2xl font-semibold text-dark-blue mb-2">Support & Inquiries</h2>
       <p class="mb-4">
           We're here to help! If you have any questions, concerns, or feedback, please don't hesitate to reach out.
       </p>

       <h3 class="text-xl font-semibold mb-2">Frequently Asked Questions (FAQ)</h3>
       <div class="bg-gray-100 p-4 rounded-lg mb-4">
           <p class="text-gray-600">Placeholder for FAQ content. Common questions and answers will go here.</p>
       </div>

       <h3 class="text-xl font-semibold mb-2">Contact Form</h3>
       <form action="#" method="post" class="mb-4">
           @csrf
           <div class="mb-4">
               <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
               <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
           </div>
           <div class="mb-4">
               <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
               <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
           </div>
           <div class="mb-4">
               <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
               <textarea name="message" id="message" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
           </div>
           <button type="submit" class="bg-dark-blue hover:bg-light-blue text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
               Send Message
           </button>
       </form>

       <h3 class="text-xl font-semibold mb-2">Quick Assistance</h3>
       <p>
           For immediate support, you can reach us via:
       </p>
       <ul class="list-disc list-inside">
           <li><strong>WhatsApp:</strong> +1 (555) 123-4567 (Placeholder)</li>
           <li><strong>Email:</strong> support@payingitforward.org (Placeholder)</li>
       </ul>
   </section>
@endsection

</html>
