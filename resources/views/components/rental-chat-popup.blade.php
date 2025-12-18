<div x-data="rentalChat()" x-cloak>
    <!-- Floating Chat Button -->
    <button
        @click="open()"
        class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-r from-orange-500 to-orange-600 shadow-lg shadow-orange-500/25 transition-all duration-300 hover:scale-110 hover:shadow-xl hover:shadow-orange-500/30 active:scale-95"
        aria-label="Open rental chat assistant">
        <svg class="h-6 w-6 text-white transition-transform duration-300" :class="{ 'rotate-12': isOpen }" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
    </button>

    <!-- Chat Modal Overlay -->
    <div x-show="isOpen" @click.self="close()" @keydown.escape.window="close()"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        aria-labelledby="rental-chat-title" aria-modal="true" role="dialog" style="display: none;">
        <div @click.away.stop
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="relative mx-auto w-full max-w-4xl max-h-[90vh] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <!-- Modal Header -->
            <div
                class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4 dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-r from-orange-500 to-orange-600">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h2 id="rental-chat-title" class="text-lg font-semibold text-slate-900 dark:text-white">Rental Chat
                            Assistant</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Find the right rental in seconds</p>
                    </div>
                </div>
                <button @click="close()"
                    class="rounded-lg p-2 text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200"
                    aria-label="Close chat">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="overflow-y-auto max-h-[calc(90vh-140px)]">
                <div class="p-6">
                    <form @submit.prevent="submitForm()" class="space-y-5">
                        @csrf
                        <div>
                            <label for="chat-question"
                                class="text-sm font-medium text-slate-700 dark:text-slate-200">Your question</label>
                            <textarea x-model="form.question" id="chat-question" name="question" rows="5" required
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                placeholder="Looking for a 2 bedroom under $2,800 near the metro..."></textarea>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="chat-city"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">City</label>
                                <input x-model="form.city" id="chat-city" name="city" type="text"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="e.g. Seattle">
                            </div>
                            <div>
                                <label for="chat-state"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">State / Region</label>
                                <input x-model="form.state" id="chat-state" name="state" type="text"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="e.g. WA">
                            </div>
                            <div>
                                <label for="chat-max-rent"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">Max rent (per month)</label>
                                <input x-model.number="form.max_rent" id="chat-max-rent" name="max_rent" type="number"
                                    min="0"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="2800">
                            </div>
                            <div>
                                <label for="chat-min-bedrooms"
                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">Min bedrooms</label>
                                <input x-model.number="form.min_bedrooms" id="chat-min-bedrooms" name="min_bedrooms"
                                    type="number" min="0"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-transparent p-3 text-base text-slate-900 shadow-sm transition hover:border-slate-300 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                    placeholder="2">
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" :disabled="loading"
                                class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-base font-semibold text-white transition hover:bg-slate-800 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100 sm:w-auto">
                                <span x-show="!loading">Ask the assistant</span>
                                <span x-show="loading" class="flex items-center gap-2">
                                    <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Error Display -->
                    <div x-show="errors.length > 0"
                        x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-200"
                        style="display: none;">
                        <p class="mb-2 font-semibold">We need a bit more info:</p>
                        <ul class="list-disc space-y-1 pl-5">
                            <template x-for="error in errors" :key="error">
                                <li x-text="error"></li>
                            </template>
                        </ul>
                    </div>

                    <!-- Results Display -->
                    <div x-show="result" x-cloak
                        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4"
                        class="mt-6 space-y-4" style="display: none;">
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-wide text-slate-500 dark:text-slate-400">Assistant
                                    response</p>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white">Context-aware summary</h3>
                            </div>
                            <span
                                class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">Live</span>
                        </div>

                        <div
                            class="rounded-xl border border-slate-100 bg-slate-50 p-4 text-slate-700 shadow-sm dark:border-slate-800 dark:bg-slate-800/60 dark:text-slate-200"
                            x-text="result?.answer || 'No answer provided.'"></div>

                        <template x-if="result?.properties && result.properties.length > 0">
                            <div class="space-y-4">
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Referenced properties</p>
                                <div class="space-y-4">
                                    <template x-for="property in result.properties" :key="property.id">
                                        <article
                                            class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm transition hover:border-slate-200 dark:border-slate-800 dark:bg-slate-900/60"
                                            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100">
                                            <div class="flex items-baseline justify-between gap-4">
                                                <div>
                                                    <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                        Property #<span x-text="property.id"></span>
                                                    </p>
                                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white"
                                                        x-text="property.title"></h3>
                                                </div>
                                                <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                    $<span x-text="formatNumber(property.rent_per_month)"></span>/mo
                                                </p>
                                            </div>
                                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                                                <span x-text="property.city"></span>, <span x-text="property.state"></span>
                                                &middot;
                                                <span x-text="property.bedrooms"></span> bd · <span
                                                    x-text="property.bathrooms"></span> ba &middot;
                                                Available <span x-text="property.available_on || 'soon'"></span>
                                            </p>
                                            <template x-if="property.infrastructures && property.infrastructures.length > 0">
                                                <ul class="mt-3 space-y-1 text-sm text-slate-600 dark:text-slate-300">
                                                    <template x-for="infra in property.infrastructures" :key="infra.name">
                                                        <li class="flex items-center gap-2">
                                                            <span
                                                                class="inline-flex min-w-18 rounded-full border border-slate-200 px-2 py-0.5 text-xs font-medium uppercase tracking-wide text-slate-500 dark:border-slate-700 dark:text-slate-300"
                                                                x-text="infra.category"></span>
                                                            <span class="flex-1">
                                                                <span x-text="infra.name"></span>
                                                                <span class="text-slate-400 dark:text-slate-500">
                                                                    <template x-if="infra.distance_meters">
                                                                        <span> · <span
                                                                                x-text="formatNumber(infra.distance_meters / 1000, 1)"></span>
                                                                            km</span>
                                                                        </template>
                                                                    <template x-if="infra.travel_time_minutes">
                                                                        <span> · <span x-text="infra.travel_time_minutes"></span>
                                                                            min via <span x-text="infra.travel_mode"></span></span>
                                                                        </template>
                                                                </span>
                                                            </span>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </template>
                                            <template x-if="property.slug">
                                                <div class="mt-4 flex justify-end">
                                                    <a :href="`{{ url('/properties') }}/${property.slug}`"
                                                        class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:border-slate-500 dark:hover:bg-slate-800/60">
                                                        View details
                                                        <span aria-hidden="true">&rarr;</span>
                                                    </a>
                                                </div>
                                            </template>
                                        </article>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function rentalChat() {
        return {
            isOpen: false,
            loading: false,
            errors: [],
            result: null,
            form: {
                question: '',
                city: '',
                state: '',
                max_rent: null,
                min_bedrooms: null,
            },
            open() {
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.isOpen = false;
                document.body.style.overflow = '';
                // Reset form and results after animation
                setTimeout(() => {
                    if (!this.isOpen) {
                        this.reset();
                    }
                }, 300);
            },
            reset() {
                this.errors = [];
                this.result = null;
                this.form = {
                    question: '',
                    city: '',
                    state: '',
                    max_rent: null,
                    min_bedrooms: null,
                };
            },
            async submitForm() {
                this.loading = true;
                this.errors = [];
                this.result = null;

                // Prepare data
                const data = {
                    question: this.form.question,
                    ...(this.form.city && { city: this.form.city }),
                    ...(this.form.state && { state: this.form.state }),
                    ...(this.form.max_rent && { max_rent: this.form.max_rent }),
                    ...(this.form.min_bedrooms && { min_bedrooms: this.form.min_bedrooms }),
                };

                try {
                    const response = await fetch('{{ route("api.rental-chat") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(data),
                    });

                    const responseData = await response.json();

                    if (!response.ok) {
                        if (responseData.errors) {
                            this.errors = Object.values(responseData.errors).flat();
                        } else {
                            this.errors = [responseData.message || 'An error occurred'];
                        }
                    } else {
                        this.result = responseData.data;
                        // Scroll to results smoothly
                        this.$nextTick(() => {
                            const resultsDiv = this.$el.querySelector('[x-show="result"]');
                            if (resultsDiv) {
                                resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            }
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.errors = [error.message || 'An unexpected error occurred. Please try again.'];
                } finally {
                    this.loading = false;
                }
            },
            formatNumber(num, decimals = 0) {
                return Number(num).toLocaleString('en-US', {
                    minimumFractionDigits: decimals,
                    maximumFractionDigits: decimals,
                });
            },
        };
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
