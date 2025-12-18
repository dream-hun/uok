<header class="sticky top-0 z-50 border-b border-gray-200/50 bg-white/95 backdrop-blur-sm dark:border-gray-800/50 dark:bg-gray-900/95">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 transition-opacity hover:opacity-80">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 shadow-lg shadow-orange-500/20">
                    <span class="text-xl font-bold text-white">R</span>
                </div>
                <span class="text-2xl font-bold tracking-tight">
                    <span class="text-orange-500">R</span><span class="text-gray-900 dark:text-gray-100">ENTER</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden items-center gap-1 md:flex">
                <a href="/" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Home</a>
                <a href="#properties" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Properties</a>
                <a href="#rent" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Rent</a>
                <a href="#sell" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Sell</a>
                <a href="#find-agent" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Find Agent</a>
                <a href="#add-properties" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Add Properties</a>
                <a href="#about" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">About Us</a>
            </div>

            <!-- Contact Us Button -->
            <div class="hidden items-center gap-4 md:flex">
                <button class="rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95">
                    Contact Us
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <button class="rounded-lg p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800 md:hidden" id="mobile-menu-button" aria-label="Toggle menu">
                <svg class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden border-t border-gray-200 pb-4 pt-4 dark:border-gray-800 md:hidden" id="mobile-menu">
            <div class="flex flex-col gap-1">
                <a href="/" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Home</a>
                <a href="#properties" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Properties</a>
                <a href="#rent" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Rent</a>
                <a href="#sell" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Sell</a>
                <a href="#find-agent" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Find Agent</a>
                <a href="#add-properties" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">Add Properties</a>
                <a href="#about" class="rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-orange-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-orange-400">About Us</a>
                <button class="mt-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 active:scale-95">
                    Contact Us
                </button>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
