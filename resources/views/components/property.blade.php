<a href="{{ route('properties.show', $property) }}"
   class="property-card group block overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-xl dark:border-gray-700 dark:bg-gray-800 dark:hover:border-orange-800"
   @if($property->latitude && $property->longitude)
       data-latitude="{{ $property->latitude }}"
       data-longitude="{{ $property->longitude }}"
       data-property-id="{{ $property->id }}"
   @endif>
    <!-- Property Image -->
    <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800">
        <div class="flex h-full w-full items-center justify-center">
            <svg class="h-20 w-20 text-gray-300 transition-transform group-hover:scale-110 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </div>
        <div class="absolute right-4 top-4">
            <div class="rounded-full bg-gradient-to-br from-orange-500 to-orange-600 p-2.5 shadow-lg shadow-orange-500/30 transition-transform group-hover:scale-110 group-hover:translate-x-1">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Property Content -->
    <div class="p-6">
        <h2 class="mb-3 text-xl font-bold text-gray-900 transition-colors group-hover:text-orange-500 dark:text-gray-50">
            {{ $property->title }}
        </h2>

        <div class="mb-4 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="truncate">
                {{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}
            </span>
        </div>

        <div class="mb-5 flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400">
            @if($property->bedrooms)
                <div class="flex items-center gap-1.5">
                    <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>{{ $property->bedrooms }} Beds</span>
                </div>
            @endif
            @if($property->bathrooms)
                <div class="flex items-center gap-1.5">
                    <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    <span>{{ $property->bathrooms }} Baths</span>
                </div>
            @endif
            @if($property->square_feet)
                <div class="flex items-center gap-1.5">
                    <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                    </svg>
                    <span>{{ number_format($property->square_feet) }} Sqft</span>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between border-t border-gray-200 pt-4 dark:border-gray-700">
            <div>
                <div class="text-2xl font-bold text-gray-900 dark:text-gray-50">
                    ${{ number_format($property->rent_per_month) }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">per month</div>
            </div>
        </div>
    </div>
</a>
