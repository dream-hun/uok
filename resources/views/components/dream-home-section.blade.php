<section id="properties" class="bg-white py-16 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-gray-50">FIND YOUR DREAM HOME</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Browse through our extensive collection of properties and find the perfect place to call home.
            </p>
        </div>

        <!-- Filter Bar -->
        <div class="mb-16 rounded-2xl border border-gray-200 bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
            <form class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="relative">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Property</label>
                    <select class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm transition-all focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-50">
                        <option>All Properties</option>
                        <option>House</option>
                        <option>Apartment</option>
                        <option>Condominium</option>
                        <option>Villa</option>
                    </select>
                </div>
                <div class="relative">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" placeholder="Enter location" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm placeholder-gray-500 transition-all focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-50 dark:placeholder-gray-400" />
                </div>
                <div class="relative">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Date</label>
                    <input type="date" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm transition-all focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-50" />
                </div>
                <div class="relative">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Price</label>
                    <select class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm transition-all focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-50">
                        <option>Any Price</option>
                        <option>$0 - $1,000</option>
                        <option>$1,000 - $2,500</option>
                        <option>$2,500 - $5,000</option>
                        <option>$5,000+</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Property Listings -->
        @if($properties->isEmpty())
            <div class="rounded-2xl border border-gray-200 bg-white p-12 text-center dark:border-gray-700 dark:bg-gray-800">
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    No properties available at this time.
                </p>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($properties as $property)
                    <x-property :$property />
                @endforeach
            </div>

            <!-- Explore All Properties Button -->
            <div class="mt-16 text-center">
                <button class="group rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-10 py-4 font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95">
                    <span class="flex items-center justify-center gap-2">
                        Explore all Properties
                        <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </button>
            </div>
        @endif
    </div>
</section>
