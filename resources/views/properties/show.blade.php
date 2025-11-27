<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} · Property Details</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            @import"https://cdn.jsdelivr.net/npm/tailwindcss@4.0.7/dist/tailwind.min.css";
        </style>
    @endif
</head>

<body class="bg-slate-100 text-slate-900 dark:bg-slate-950 dark:text-slate-50">
    @php
        $features = collect($property->features ?? []);
        $infrastructures = $property->infrastructures->sortBy('pivot.distance_meters');
    @endphp

    <div class="min-h-screen px-4 py-10 sm:px-6 lg:px-10">
        <div class="mx-auto max-w-5xl space-y-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('rental-chat.create') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                    <span aria-hidden="true">&larr;</span>
                    Back to rental assistant
                </a>
                <span
                    class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:border-slate-800 dark:text-slate-400">
                    Property #{{ $property->id }}
                </span>
            </div>

            <section
                class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm uppercase tracking-wide text-slate-500 dark:text-slate-400">Featured home
                            </p>
                            <h1 class="text-4xl font-semibold tracking-tight text-slate-900 dark:text-white">
                                {{ $property->title }}
                            </h1>
                        </div>
                        <div class="text-base text-slate-600 dark:text-slate-300">
                            <p>{{ $property->address_line1 }}</p>
                            @if ($property->address_line2)
                                <p>{{ $property->address_line2 }}</p>
                            @endif
                            <p>{{ $property->city }}, {{ $property->state }} {{ $property->postal_code }}</p>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-slate-600 dark:text-slate-300">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                {{ number_format($property->bedrooms ?? 0) }} bd
                            </span>
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                {{ number_format($property->bathrooms ?? 0, 1) }} ba
                            </span>
                            @if ($property->square_feet)
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                    {{ number_format($property->square_feet) }} sq ft
                                </span>
                            @endif
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-slate-900 px-3 py-1 font-semibold text-white dark:bg-white dark:text-slate-900">
                                {{ $property->pets_allowed ? 'Pets welcome' : 'No pets' }}
                            </span>
                        </div>
                    </div>
                    <div class="space-y-3 text-right">
                        <p class="text-4xl font-bold text-slate-900 dark:text-white">
                            ${{ number_format($property->rent_per_month) }}
                            <span class="text-base font-medium text-slate-500 dark:text-slate-400">/ month</span>
                        </p>
                        @if ($property->security_deposit)
                            <p class="text-sm text-slate-500 dark:text-slate-400">Security deposit:
                                ${{ number_format($property->security_deposit) }}</p>
                        @endif
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            Available {{ $property->available_on?->toFormattedDateString() ?? 'soon' }}
                        </p>
                        <a href="{{ route('rental-chat.create') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-base font-semibold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200">
                            Start a new chat about this home
                        </a>
                    </div>
                </div>
            </section>

            <div class="grid gap-6 lg:grid-cols-3">
                <section
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:col-span-2">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Overview</h2>
                    <p class="mt-3 text-base text-slate-600 dark:text-slate-300">
                        {{ $property->description ?? 'No description provided yet.' }}
                    </p>

                    <h3 class="mt-6 text-sm font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Features</h3>
                    @if ($features->isNotEmpty())
                        <ul class="mt-3 flex flex-wrap gap-2">
                            @foreach ($features as $feature)
                                <li
                                    class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Amenities coming soon.</p>
                    @endif
                </section>

                <section
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Quick facts</h2>
                    <dl class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        <div
                            class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3 dark:border-slate-800">
                            <dt>Monthly rent</dt>
                            <dd class="font-semibold text-slate-900 dark:text-white">
                                ${{ number_format($property->rent_per_month) }}</dd>
                        </div>
                        <div
                            class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3 dark:border-slate-800">
                            <dt>Available</dt>
                            <dd class="font-semibold text-slate-900 dark:text-white">
                                {{ $property->available_on?->toFormattedDateString() ?? 'Flexible' }}
                            </dd>
                        </div>
                        <div
                            class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3 dark:border-slate-800">
                            <dt>Security deposit</dt>
                            <dd class="font-semibold text-slate-900 dark:text-white">
                                {{ $property->security_deposit ? '$' . number_format($property->security_deposit) : 'TBD' }}
                            </dd>
                        </div>
                        <div
                            class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3 dark:border-slate-800">
                            <dt>Pets</dt>
                            <dd class="font-semibold text-slate-900 dark:text-white">
                                {{ $property->pets_allowed ? 'Allowed' : 'Not allowed' }}
                            </dd>
                        </div>
                    </dl>
                </section>
            </div>

            <section
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-wide text-slate-500 dark:text-slate-400">Nearby</p>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Infrastructure & commute</h2>
                    </div>
                    <span
                        class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ $infrastructures->count() }}
                        locations</span>
                </div>

                <div class="mt-5 grid gap-4 lg:grid-cols-2">
                    @forelse ($infrastructures as $infrastructure)
                        <article
                            class="rounded-xl border border-slate-100 bg-slate-50 p-4 shadow-sm dark:border-slate-800 dark:bg-slate-800/60">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        {{ $infrastructure->category }}
                                    </p>
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                        {{ $infrastructure->name }}
                                    </h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ $infrastructure->city ?? $property->city }}
                                    </p>
                                </div>
                                <span
                                    class="inline-flex min-w-18 items-center justify-center rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-900 dark:text-slate-100">
                                    {{ $infrastructure->pivot->travel_mode ?? 'N/A' }}
                                </span>
                            </div>
                            <dl class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                                @if ($infrastructure->pivot->distance_meters)
                                    <div class="flex items-center justify-between">
                                        <dt>Distance</dt>
                                        <dd>{{ number_format($infrastructure->pivot->distance_meters / 1000, 1) }} km
                                        </dd>
                                    </div>
                                @endif
                                @if ($infrastructure->pivot->travel_time_minutes)
                                    <div class="flex items-center justify-between">
                                        <dt>Travel time</dt>
                                        <dd>{{ $infrastructure->pivot->travel_time_minutes }} min</dd>
                                    </div>
                                @endif
                                @if ($infrastructure->pivot->notes)
                                    <div>
                                        <dt class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                            Notes
                                        </dt>
                                        <dd class="text-sm text-slate-600 dark:text-slate-300">
                                            {{ $infrastructure->pivot->notes }}
                                        </dd>
                                    </div>
                                @endif
                            </dl>
                        </article>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No infrastructure data available yet.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</body>

</html>
