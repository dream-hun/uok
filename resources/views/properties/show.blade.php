<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} · Property Details</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50">
    <x-header />

    @php
        $features = collect($property->features ?? []);
        $infrastructures = $property->infrastructures->sortBy('pivot.distance_meters');
    @endphp

    <main class="min-h-screen">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="space-y-8">
                <!-- Breadcrumb and Property ID -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <a href="/"
                        class="group inline-flex items-center gap-2 text-sm font-semibold text-gray-600 transition-colors hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                        <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Properties
                    </a>
                    <span class="rounded-full border border-gray-200 bg-white px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-gray-600 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        Property #{{ $property->id }}
                    </span>
                </div>

                <!-- Main Property Card -->
                <section class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800">
                    <!-- Property Image Header -->
                    <div class="relative h-64 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 sm:h-80 lg:h-96">
                        <div class="flex h-full w-full items-center justify-center">
                            <svg class="h-32 w-32 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="p-8 lg:p-12">
                        <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                            <div class="space-y-6 flex-1">
                                <div>
                                    <p class="mb-2 inline-block rounded-full bg-orange-100 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                                        Featured Home
                                    </p>
                                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                                        {{ $property->title }}
                                    </h1>
                                </div>

                                <div class="flex items-start gap-2 text-base text-gray-600 dark:text-gray-300">
                                    <svg class="mt-0.5 h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <p>{{ $property->address_line1 }}</p>
                                        @if ($property->address_line2)
                                            <p>{{ $property->address_line2 }}</p>
                                        @endif
                                        <p>{{ $property->city }}, {{ $property->state }} {{ $property->postal_code }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3">
                                    <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ number_format($property->bedrooms ?? 0) }} Bedrooms
                                    </span>
                                    <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                        </svg>
                                        {{ number_format($property->bathrooms ?? 0, 1) }} Bathrooms
                                    </span>
                                    @if ($property->square_feet)
                                        <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                            </svg>
                                            {{ number_format($property->square_feet) }} sq ft
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-orange-500/25">
                                        {{ $property->pets_allowed ? '🐾 Pets Welcome' : '🚫 No Pets' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Price and CTA -->
                            <div class="space-y-4 rounded-2xl border border-gray-200 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800/50 lg:min-w-[280px]">
                                <div>
                                    <p class="text-4xl font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($property->rent_per_month) }}
                                        <span class="text-lg font-medium text-gray-500 dark:text-gray-400">/ month</span>
                                    </p>
                                </div>
                                @if ($property->security_deposit)
                                    <div class="flex items-center justify-between border-t border-gray-200 pt-3 dark:border-gray-700">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Security deposit</span>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            ${{ number_format($property->security_deposit) }}
                                        </span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between border-t border-gray-200 pt-3 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Available</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $property->available_on?->toFormattedDateString() ?? 'Soon' }}
                                    </span>
                                </div>
                                <a href="{{ route('rental-chat.create') }}"
                                    class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-orange-500/25 transition-all hover:scale-105 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95">
                                    <span>Start a new chat</span>
                                    <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Overview and Quick Facts -->
                <div class="grid gap-6 lg:grid-cols-3">
                    <!-- Overview Section -->
                    <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800 lg:col-span-2">
                        <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Overview</h2>
                        <p class="mb-8 leading-relaxed text-gray-600 dark:text-gray-300">
                            {{ $property->description ?? 'No description provided yet.' }}
                        </p>

                        <div>
                            <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Features & Amenities
                            </h3>
                            @if ($features->isNotEmpty())
                                <ul class="flex flex-wrap gap-2">
                                    @foreach ($features as $feature)
                                        <li class="rounded-full bg-gradient-to-r from-orange-50 to-orange-100 px-4 py-2 text-sm font-medium text-orange-700 dark:from-orange-900/30 dark:to-orange-800/30 dark:text-orange-300">
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Amenities coming soon.</p>
                            @endif
                        </div>
                    </section>

                    <!-- Quick Facts Section -->
                    <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Quick Facts</h2>
                        <dl class="space-y-4">
                            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Monthly rent</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    ${{ number_format($property->rent_per_month) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Available</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ $property->available_on?->toFormattedDateString() ?? 'Flexible' }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Security deposit</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ $property->security_deposit ? '$' . number_format($property->security_deposit) : 'TBD' }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Pets</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ $property->pets_allowed ? 'Allowed' : 'Not allowed' }}
                                </dd>
                            </div>
                        </dl>
                    </section>
                </div>

                <!-- Infrastructure & Commute Section -->
                <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800 lg:p-8">
                    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="mb-2 text-sm font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Nearby
                            </p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                Infrastructure & Commute
                            </h2>
                        </div>
                        <span class="rounded-full bg-orange-100 px-4 py-1.5 text-sm font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-400">
                            {{ $infrastructures->count() }} locations
                        </span>
                    </div>

                    <div class="grid gap-4 lg:grid-cols-2">
                        @forelse ($infrastructures as $infrastructure)
                            <article class="group overflow-hidden rounded-xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-5 shadow-sm transition-all hover:border-orange-200 hover:shadow-md dark:border-gray-700 dark:from-gray-800/60 dark:to-gray-800 dark:hover:border-orange-800">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-orange-600 dark:text-orange-400">
                                            {{ $infrastructure->category }}
                                        </p>
                                        <h3 class="mb-1 text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $infrastructure->name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $infrastructure->city ?? $property->city }}
                                        </p>
                                    </div>
                                    <span class="rounded-full bg-gradient-to-r from-orange-500 to-orange-600 px-3 py-1 text-xs font-bold text-white shadow-sm">
                                        {{ $infrastructure->pivot->travel_mode ?? 'N/A' }}
                                    </span>
                                </div>
                                <dl class="mt-4 space-y-2 border-t border-gray-200 pt-4 dark:border-gray-700">
                                    @if ($infrastructure->pivot->distance_meters)
                                        <div class="flex items-center justify-between text-sm">
                                            <dt class="font-medium text-gray-600 dark:text-gray-400">Distance</dt>
                                            <dd class="font-semibold text-gray-900 dark:text-white">
                                                {{ number_format($infrastructure->pivot->distance_meters / 1000, 1) }} km
                                            </dd>
                                        </div>
                                    @endif
                                    @if ($infrastructure->pivot->travel_time_minutes)
                                        <div class="flex items-center justify-between text-sm">
                                            <dt class="font-medium text-gray-600 dark:text-gray-400">Travel time</dt>
                                            <dd class="font-semibold text-gray-900 dark:text-white">
                                                {{ $infrastructure->pivot->travel_time_minutes }} min
                                            </dd>
                                        </div>
                                    @endif
                                    @if ($infrastructure->pivot->notes)
                                        <div class="pt-2">
                                            <dt class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                                Notes
                                            </dt>
                                            <dd class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $infrastructure->pivot->notes }}
                                            </dd>
                                        </div>
                                    @endif
                                </dl>
                            </article>
                        @empty
                            <div class="col-span-2 rounded-xl border border-gray-200 bg-gray-50 p-8 text-center dark:border-gray-700 dark:bg-gray-800/50">
                                <p class="text-gray-600 dark:text-gray-400">No infrastructure data available yet.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </main>

    <x-footer />

    <!-- Rental Chat Popup -->
    <x-rental-chat-popup />
</body>

</html>
