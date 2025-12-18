<section class="bg-gradient-to-b from-white to-gray-50 py-20 dark:from-gray-900 dark:to-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 text-center">
            <h2 class="mb-4 text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-50 sm:text-4xl">
                What People Say
            </h2>
            <p class="mx-auto max-w-2xl text-lg text-gray-600 dark:text-gray-400">
                Don't just take our word for it. Here's what our clients have to say about their experience with us.
            </p>
        </div>

        <div class="relative">
            <!-- Central Testimonial -->
            <div class="mx-auto max-w-3xl">
                <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-xl dark:border-gray-700 dark:bg-gray-800 sm:p-12">
                    <div class="mb-8 flex justify-center">
                        <div class="relative">
                            <div class="h-28 w-28 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 shadow-lg shadow-orange-500/30"></div>
                            <div class="absolute -bottom-1 -right-1 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md dark:bg-gray-700">
                                <svg class="h-5 w-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 text-center">
                        <h3 class="mb-2 text-2xl font-bold text-gray-900 dark:text-gray-50">Nathan Hartman</h3>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kosovo</p>
                    </div>
                    <p class="mb-8 text-center text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                        "I had an amazing experience finding my dream home through Renter. The team was professional, responsive, and helped me every step of the way. Highly recommended!"
                    </p>
                    <div class="flex justify-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-6 w-6 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Surrounding Profile Indicators -->
            <div class="mt-12 flex justify-center gap-3">
                @for($i = 1; $i <= 4; $i++)
                    <div class="h-14 w-14 rounded-full border-2 border-white bg-gradient-to-br from-gray-300 to-gray-400 shadow-md transition-transform hover:scale-110 dark:border-gray-800"></div>
                @endfor
            </div>
        </div>
    </div>
</section>
