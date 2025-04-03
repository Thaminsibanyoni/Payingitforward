<footer class="bg-dark-blue text-gray-300 py-12 mt-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8 mb-8">
            <!-- Social Links -->
            <div class="space-y-4">
                <h3 class="text-white font-bold text-lg mb-4">Connect With Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-400 transition-colors">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400 transition-colors">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400 transition-colors">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400 transition-colors">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4">
                <h3 class="text-white font-bold text-lg mb-4">Stay Updated</h3>
                <form class="flex gap-2">
                    <input type="email" placeholder="Enter your email"
                           class="flex-1 px-4 py-2 rounded-lg bg-gray-800 border border-gray-200/10 focus:outline-none focus:border-blue-500">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg font-semibold transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-2">
                <h3 class="text-white font-bold text-lg mb-4">Contact Us</h3>
                <p class="flex items-center gap-2">
                    <i class="fas fa-envelope"></i>
                    support@payingitforward.org
                </p>
                <p class="flex items-center gap-2">
                    <i class="fas fa-phone"></i>
                    +1 (555) 123-4567
                </p>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 text-center">
            <p>&copy; {{ date('Y') }} PayingItForward. All rights reserved.</p>
            <div class="mt-2">
                <a href="#" class="hover:text-light-blue mx-2">Terms & Conditions</a>
                <a href="#" class="text-gray-400 hover:text-light-blue mx-2">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>