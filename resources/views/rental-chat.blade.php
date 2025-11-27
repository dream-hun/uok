<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Chat Assistant</title>
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

<body class="bg-slate-100 text-slate-900 dark:bg-slate-950 dark:text-slate-100 font-['Instrument_Sans',ui-sans-serif]">
    @php
        $result = $result ?? null;
        $properties = collect($result['properties'] ?? []);
    @endphp
    <div class="min-h-screen px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl space-y-8">
            <div class="space-y-2 text-center">
                <p class="text-sm uppercase tracking-wide text-slate-500 dark:text-slate-400">Assistant</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">Find the right rental
                    in seconds</h1>
                <p class="text-base text-slate-600 dark:text-slate-300">
                    Ask anything about availability, price, or nearby infrastructure. Answers come from your curated
                    inventory.
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <section
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <form method="POST" action="{{ route('rental-chat.store') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label for="question" class="text-sm font-medium text-slate-700 dark:text-slate-200">Your
                                question</label>
                            <textarea id="question" name="question" rows="5" required
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                placeholder="Looking for a 2 bedroom under $2,800 near the metro...">{{ old('question') }}</textarea>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="city"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">City</label>
                                <input id="city" name="city" type="text" value="{{ old('city') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="e.g. Seattle">
                            </div>
                            <div>
                                <label for="state"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">State /
                                    Region</label>
                                <input id="state" name="state" type="text" value="{{ old('state') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="e.g. WA">
                            </div>
                            <div>
                                <label for="max_rent" class="text-sm font-medium text-slate-700 dark:text-slate-200">Max
                                    rent (per month)</label>
                                <input id="max_rent" name="max_rent" type="number" min="0"
                                    value="{{ old('max_rent') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="2800">
                            </div>
                            <div>
                                <label for="min_bedrooms"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">Min bedrooms</label>
                                <input id="min_bedrooms" name="min_bedrooms" type="number" min="0"
                                    value="{{ old('min_bedrooms') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="2">
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-base font-semibold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100 sm:w-auto">
                                Ask the assistant
                            </button>

                        </div>
                    </form>

                    @if ($errors->any())
                        <div
                            class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-200">
                            <p class="font-semibold mb-2">We need a bit more info:</p>
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </section>

                <section
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-wide text-slate-500 dark:text-slate-400">Assistant
                                response</p>
                            <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Context-aware summary</h2>
                        </div>
                        <span
                            class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">Live</span>
                    </div>

                    <div class="mt-4 space-y-4">
                        @if ($result)
                            <div
                                class="rounded-xl border border-slate-100 bg-slate-50 p-4 text-slate-700 shadow-sm dark:border-slate-800 dark:bg-slate-800/60 dark:text-slate-200">
                                {{ $result['answer'] }}
                            </div>

                            <div class="space-y-4">
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Referenced properties
                                </p>
                                @foreach ($properties as $property)
                                    @php($detailsRoute = !empty($property['slug']) ? route('properties.show', $property['slug']) : null)
                                    <article
                                        class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm transition hover:border-slate-200 dark:border-slate-800 dark:bg-slate-900/60">
                                        <div class="flex items-baseline justify-between gap-4">
                                            <div>
                                                <p
                                                    class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                    Property #{{ $property['id'] }}</p>
                                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                                    {{ $property['title'] }}</h3>
                                            </div>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                ${{ number_format($property['rent_per_month']) }}/mo
                                            </p>
                                        </div>
                                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                                            {{ $property['city'] }}, {{ $property['state'] }} &middot;
                                            {{ $property['bedrooms'] }} bd · {{ $property['bathrooms'] }} ba &middot;
                                            Available {{ $property['available_on'] ?? 'soon' }}
                                        </p>
                                        @if (!empty($property['infrastructures']))
                                            <ul class="mt-3 space-y-1 text-sm text-slate-600 dark:text-slate-300">
                                                @foreach ($property['infrastructures'] as $infra)
                                                    <li class="flex items-center gap-2">
                                                        <span
                                                            class="inline-flex min-w-18 rounded-full border border-slate-200 px-2 py-0.5 text-xs font-medium uppercase tracking-wide text-slate-500 dark:border-slate-700 dark:text-slate-300">
                                                            {{ $infra['category'] }}
                                                        </span>
                                                        <span class="flex-1">
                                                            {{ $infra['name'] }}
                                                            <span class="text-slate-400 dark:text-slate-500">
                                                                @if ($infra['distance_meters'])
                                                                    ·
                                                                    {{ number_format($infra['distance_meters'] / 1000, 1) }}
                                                                    km
                                                                @endif
                                                                @if ($infra['travel_time_minutes'])
                                                                    · {{ $infra['travel_time_minutes'] }} min via
                                                                    {{ $infra['travel_mode'] }}
                                                                @endif
                                                            </span>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        @if ($detailsRoute)
                                            <div class="mt-4 flex justify-end">
                                                <a href="{{ $detailsRoute }}"
                                                    class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:border-slate-500 dark:hover:bg-slate-800/60">
                                                    View details
                                                    <span aria-hidden="true">&rarr;</span>
                                                </a>
                                            </div>
                                        @endif
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="rounded-xl border border-dashed border-slate-300 p-6 text-center text-slate-500 dark:border-slate-700 dark:text-slate-400">
                                Submit a question to see tailored recommendations grounded in your dataset.
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
