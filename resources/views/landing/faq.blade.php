@extends('layouts.landing')

@section('title', 'FAQ')

@section('content')
    @php
        $faqItems = isset($faqs) && $faqs->isNotEmpty()
            ? $faqs
            : collect([
                [
                    'question' => 'Bagaimana cara saya memberikan donasi?',
                    'answer' => 'Anda dapat memberikan donasi melalui formulir donasi online yang tersedia di situs ini.',
                ],
                [
                    'question' => 'Apakah saya bisa menjadi relawan meskipun tidak punya pengalaman?',
                    'answer' => 'Tentu saja! Kami menyambut relawan dari berbagai latar belakang dan akan memberikan panduan yang dibutuhkan.',
                ],
                [
                    'question' => 'Apakah donasi saya bisa dikurangkan dari pajak?',
                    'answer' => 'Ya, semua donasi dapat dikurangkan dari pajak dan kami menyediakan bukti donasi bila diperlukan.',
                ],
                [
                    'question' => 'Bagaimana cara saya menghubungi organisasi ini?',
                    'answer' => 'Anda dapat menghubungi kami melalui halaman Kontak atau melalui email resmi organisasi.',
                ],
            ]);
    @endphp

    <main class="p-8">
        <section class="bg-gradient-to-tr from-white to-gray-100 min-h-screen px-4 sm:px-8 pt-32">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-12 text-center drop-shadow-sm">Pertanyaan yang Sering Diajukan</h1>

                <div class="space-y-4">
                    @foreach($faqItems as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <button
                                type="button"
                                data-faq-index="{{ $loop->index }}"
                                class="faq-toggle w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                                aria-expanded="false"
                            >
                                <span class="text-lg font-semibold text-gray-800">{{ $item['question'] ?? $item->question }}</span>
                                <svg class="faq-icon w-6 h-6 text-gray-600 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="faq-panel-{{ $loop->index }}" class="faq-panel px-6 pb-6 text-gray-700 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                                <p>{{ $item['answer'] ?? $item->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <script>
        document.querySelectorAll('.faq-toggle').forEach((button) => {
            button.addEventListener('click', function () {
                const index = this.getAttribute('data-faq-index');
                const panel = document.getElementById(`faq-panel-${index}`);
                const icon = this.querySelector('.faq-icon');
                const isOpen = this.getAttribute('aria-expanded') === 'true';

                this.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
                panel.style.maxHeight = isOpen ? '0px' : `${panel.scrollHeight}px`;
                icon.classList.toggle('rotate-180', !isOpen);
            });
        });
    </script>

@endsection

