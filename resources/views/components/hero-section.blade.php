<section class="relative overflow-hidden bg-gradient-to-b from-white to-gray-50/50 py-20 dark:from-gray-900 dark:to-gray-800/50 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-16 lg:grid-cols-2 lg:items-center lg:gap-12">
            <!-- Left Content -->
            <div class="flex flex-col justify-center space-y-8">
                <div>
                    <p class="mb-3 inline-block rounded-full bg-orange-100 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                        Welcome to Realestate
                    </p>
                    <h1 class="mb-6 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-gray-50 sm:text-5xl lg:text-6xl">
                        Start Your Real Estate Journey Today
                    </h1>
                    <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                        Discover your perfect home with our comprehensive property listings. Whether you're looking to rent or buy, we have the ideal property waiting for you.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4">
                    <button class="group rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-8 py-3.5 font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95">
                        <span class="flex items-center gap-2">
                            Rent
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </button>
                    <button class="rounded-xl border-2 border-gray-300 bg-white px-8 py-3.5 font-semibold text-gray-700 transition-all hover:border-gray-400 hover:bg-gray-50 hover:shadow-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:bg-gray-700">
                        Buy
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="rounded-2xl border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input
                                type="text"
                                placeholder="Search for the location you want"
                                class="w-full rounded-xl border-0 bg-transparent px-4 py-3 pl-11 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:text-gray-50 dark:placeholder-gray-400"
                            />
                            <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <button class="rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-8 py-3 font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95">
                            Search
                        </button>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-3 gap-6 rounded-2xl border border-gray-200 bg-white/50 p-6 backdrop-blur-sm dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="text-center">
                        <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-gray-50">90K</div>
                        <div class="text-xs font-medium uppercase tracking-wide text-gray-600 dark:text-gray-400">Happy Buyer</div>
                    </div>
                    <div class="text-center">
                        <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-gray-50">30K</div>
                        <div class="text-xs font-medium uppercase tracking-wide text-gray-600 dark:text-gray-400">Client Review</div>
                    </div>
                    <div class="text-center">
                        <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-gray-50">4.7</div>
                        <div class="text-xs font-medium uppercase tracking-wide text-gray-600 dark:text-gray-400">Rating</div>
                    </div>
                </div>

                <!-- Social Proof -->
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="h-12 w-12 rounded-full border-3 border-white bg-gradient-to-br from-orange-400 to-orange-600 shadow-md dark:border-gray-800"></div>
                        @endfor
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-50">Trusted by thousands</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">of satisfied clients</p>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative">
                <div class="relative h-[600px] w-full overflow-hidden rounded-3xl bg-gradient-to-br from-gray-100 to-gray-200 shadow-2xl dark:from-gray-800 dark:to-gray-900">
                    <div class="flex h-full w-full items-center justify-center">
                        <svg class="h-40 w-40 text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <!-- Overlay boxes for features -->
                    <div class="absolute left-6 top-1/4 animate-pulse rounded-xl bg-white/95 p-4 shadow-xl backdrop-blur-md">
                        <div class="flex items-center gap-2">
                            <div class="h-2 w-2 rounded-full bg-orange-500"></div>
                            <div class="text-sm font-semibold text-gray-900">Door Glass</div>
                        </div>
                    </div>
                    <div class="absolute right-6 top-1/3 animate-pulse rounded-xl bg-white/95 p-4 shadow-xl backdrop-blur-md" style="animation-delay: 0.2s;">
                        <div class="flex items-center gap-2">
                            <div class="h-2 w-2 rounded-full bg-orange-500"></div>
                            <div class="text-sm font-semibold text-gray-900">Natural Lighting</div>
                        </div>
                    </div>
                    <div class="absolute bottom-1/4 left-1/4 animate-pulse rounded-xl bg-white/95 p-4 shadow-xl backdrop-blur-md" style="animation-delay: 0.4s;">
                        <div class="flex items-center gap-2">
                            <div class="h-2 w-2 rounded-full bg-orange-500"></div>
                            <div class="text-sm font-semibold text-gray-900">Modern Design</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
