<section class="bg-gradient-to-b from-gray-50 to-white py-20 dark:from-gray-800 dark:to-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 grid gap-8 lg:grid-cols-2 lg:items-center">
            <div>
                <div class="mb-6 flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 shadow-lg shadow-orange-500/25">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 002 2h2.945M15 11a3 3 0 11-6 0M15 11a3 3 0 016 0M18 11a3 3 0 11-6 0M18 11a3 3 0 016 0M9 11a3 3 0 11-6 0M9 11a3 3 0 016 0" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-50 sm:text-4xl">
                        Our Sustainable Solutions
                    </h2>
                </div>
            </div>
            <div>
                <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                    We are committed to providing eco-friendly and sustainable real estate solutions that benefit both you and the environment. Our innovative approaches ensure a greener future.
                </p>
            </div>
        </div>

        <div class="grid gap-8 sm:grid-cols-2">
            @php
                $solutions = [
                    [
                        'title' => 'Solar Energy Solutions',
                        'description' => 'Harness the power of the sun with our integrated solar energy systems for sustainable living.',
                        'icon' => '☀️',
                    ],
                    [
                        'title' => 'Smart Home Technology',
                        'description' => 'Experience the future with intelligent home automation systems that optimize energy consumption.',
                        'icon' => '🏠',
                    ],
                    [
                        'title' => 'Sustainable Construction',
                        'description' => 'Built with eco-friendly materials and practices that reduce environmental impact.',
                        'icon' => '🌱',
                    ],
                    [
                        'title' => 'Green Consulting',
                        'description' => 'Expert guidance on making your property more sustainable and energy-efficient.',
                        'icon' => '💡',
                    ],
                ];
            @endphp

            @foreach($solutions as $solution)
                <div class="group overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:bg-gray-800">
                    <div class="relative h-52 overflow-hidden bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20">
                        <div class="flex h-full w-full items-center justify-center">
                            <span class="text-7xl transition-transform group-hover:scale-110">{{ $solution['icon'] }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-3 text-xl font-bold text-gray-900 transition-colors group-hover:text-orange-500 dark:text-gray-50">
                            {{ $solution['title'] }}
                        </h3>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            {{ $solution['description'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
