<section class="bg-white py-20 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col items-center justify-between gap-6 lg:flex-row">
            <div class="text-center lg:text-left">
                <h2 class="mb-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-50 sm:text-4xl">
                    Browse Property Category
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Explore our diverse range of property categories to find your perfect match.
                </p>
            </div>
            <div class="hidden items-center gap-3 lg:flex">
                <button class="category-prev group rounded-full border border-gray-300 bg-white p-3 shadow-sm transition-all hover:scale-110 hover:border-orange-500 hover:bg-orange-50 hover:shadow-md dark:border-gray-600 dark:bg-gray-800 dark:hover:border-orange-500 dark:hover:bg-orange-900/20">
                    <svg class="h-5 w-5 text-gray-700 transition-colors group-hover:text-orange-500 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <span class="min-w-[60px] text-center text-sm font-medium text-gray-600 dark:text-gray-400">
                    <span class="category-current">01</span>/<span class="category-total">07</span>
                </span>
                <button class="category-next group rounded-full border border-gray-300 bg-white p-3 shadow-sm transition-all hover:scale-110 hover:border-orange-500 hover:bg-orange-50 hover:shadow-md dark:border-gray-600 dark:bg-gray-800 dark:hover:border-orange-500 dark:hover:bg-orange-900/20">
                    <svg class="h-5 w-5 text-gray-700 transition-colors group-hover:text-orange-500 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="category-carousel grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $categories = [
                    ['name' => 'Near Beach', 'icon' => '🌊'],
                    ['name' => 'Minimalist', 'icon' => '🏡'],
                    ['name' => 'Modern', 'icon' => '🏢'],
                    ['name' => 'Penthouse', 'icon' => '🏙️'],
                ];
            @endphp

            @foreach($categories as $category)
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl dark:bg-gray-800">
                    <div class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800">
                        <div class="flex h-full w-full items-center justify-center">
                            <span class="text-6xl transition-transform group-hover:scale-110">{{ $category['icon'] }}</span>
                        </div>
                        <div class="absolute right-4 top-4">
                            <div class="rounded-full bg-gradient-to-br from-orange-500 to-orange-600 p-2.5 shadow-lg shadow-orange-500/30 transition-transform group-hover:scale-110 group-hover:translate-x-1">
                                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 transition-colors group-hover:text-orange-500 dark:text-gray-50">
                            {{ $category['name'] }}
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.category-carousel');
        const prevBtn = document.querySelector('.category-prev');
        const nextBtn = document.querySelector('.category-next');
        const currentSpan = document.querySelector('.category-current');
        const totalSpan = document.querySelector('.category-total');

        let currentIndex = 0;
        const totalItems = 7; // Total categories
        const visibleItems = 4;

        if (totalSpan) {
            totalSpan.textContent = String(totalItems).padStart(2, '0');
        }

        function updateCarousel() {
            if (currentSpan) {
                currentSpan.textContent = String(currentIndex + 1).padStart(2, '0');
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (currentIndex < totalItems - visibleItems) {
                    currentIndex++;
                    updateCarousel();
                }
            });
        }

        updateCarousel();
    });
</script>
