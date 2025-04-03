<header class="bg-white shadow-md p-4 fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div class="logo">
            <a href="{{ route('home') }}" class="text-xl font-bold text-dark-blue">PayingItForward</a>
        </div>
        <nav class="hidden md:block">
            <ul class="flex space-x-6">
                <li><a href="{{ route('home') }}" class="hover:text-light-blue">Home</a></li>
                <li><a href="{{ route('community') }}" class="hover:text-light-blue">Community</a></li>
                <li><a href="{{ route('kindness') }}" class="hover:text-light-blue">Kindness Stories</a></li>
                <li><a href="{{ route('donate') }}" class="hover:text-light-blue">Donate</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-light-blue">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-light-blue">Contact Us</a></li>
                <li><a href="{{ route('register') }}" class="bg-dark-blue hover:bg-light-blue text-white font-bold py-2 px-4 rounded">Register</a></li>
                <li><a href="{{ route('login') }}" class="bg-dark-blue hover:bg-light-blue text-white font-bold py-2 px-4 rounded">Login</a></li>
            </ul>
        </nav>
        
        <div class="md:hidden">
            <button id="menu-toggle" class="text-blue-600 hover:text-blue-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
</header>