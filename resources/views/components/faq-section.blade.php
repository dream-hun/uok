<section class="bg-white py-16 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2">
            <!-- Left Side - FAQ Content -->
            <div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-gray-50">General F.A.Q</h2>
                <p class="mb-8 text-gray-600 dark:text-gray-400">
                    Find answers to commonly asked questions about our services and processes.
                </p>

                <div class="space-y-4">
                    @php
                        $faqs = [
                            [
                                'question' => 'Does Renter House Estate provide after-sales services?',
                                'answer' => 'Yes, we provide comprehensive after-sales services including property maintenance support, tenant management assistance, and ongoing consultation to ensure your satisfaction.',
                            ],
                            [
                                'question' => 'Does Renter House Estate offer financing options?',
                                'answer' => 'We work with multiple financial partners to provide various financing options tailored to your needs. Our team can help you explore mortgage options, rental payment plans, and other financial solutions.',
                            ],
                            [
                                'question' => 'How long will it take to sell my house?',
                                'answer' => 'The timeline varies depending on market conditions, property location, and pricing. On average, properties sell within 30-90 days. Our experienced team will provide you with a realistic timeline based on your specific property.',
                            ],
                            [
                                'question' => 'How can I schedule a tour of a property?',
                                'answer' => 'You can schedule a property tour by contacting us through our website, calling our office, or using our online booking system. We offer flexible scheduling including weekends and evenings.',
                            ],
                        ];
                    @endphp

                    @foreach($faqs as $index => $faq)
                        <div class="faq-item overflow-hidden rounded-xl border border-gray-200 bg-white transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                            <button class="faq-question flex w-full items-center justify-between p-5 text-left font-semibold text-gray-900 transition-colors hover:bg-gray-50 dark:text-gray-50 dark:hover:bg-gray-700/50" data-index="{{ $index }}">
                                <span class="pr-4">{{ $faq['question'] }}</span>
                                <svg class="faq-icon h-5 w-5 flex-shrink-0 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div class="faq-answer hidden overflow-hidden transition-all">
                                <div class="px-5 pb-5 pt-0 text-gray-600 dark:text-gray-400">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side - Image -->
            <div class="relative hidden lg:block">
                <div class="relative h-full min-h-[500px] overflow-hidden rounded-2xl bg-gradient-to-br from-gray-200 to-gray-300">
                    <div class="flex h-full w-full items-center justify-center text-gray-400">
                        <svg class="h-32 w-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const index = this.dataset.index;
                const answer = this.parentElement.querySelector('.faq-answer');
                const icon = this.querySelector('.faq-icon');
                const isOpen = !answer.classList.contains('hidden');

                // Close all other FAQs
                document.querySelectorAll('.faq-answer').forEach(ans => {
                    if (ans !== answer) {
                        ans.classList.add('hidden');
                        ans.parentElement.querySelector('.faq-icon').classList.remove('rotate-45');
                    }
                });

                // Toggle current FAQ
                if (isOpen) {
                    answer.classList.add('hidden');
                    icon.classList.remove('rotate-45');
                } else {
                    answer.classList.remove('hidden');
                    icon.classList.add('rotate-45');
                }
            });
        });
    });
</script>
