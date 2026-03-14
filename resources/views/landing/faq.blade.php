@extends('layouts.landing')

@section('title', 'FAQ')

@section('content')
    <main class="p-8">
        <section class="bg-gradient-to-tr from-white to-gray-100 min-h-screen px-4 sm:px-8 pt-32">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-12 text-center drop-shadow-sm">Pertanyaan yang Sering
                    Diajukan</h1>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"><button
                            class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            aria-expanded="false"><span class="text-lg font-semibold text-gray-800">Bagaimana cara saya
                                memberikan donasi?</span><svg
                                class="w-6 h-6 text-gray-600 transform transition-transform duration-300 " fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg></button>
                        <div
                            class="px-6 pb-6 text-gray-700 transition-max-height duration-500 ease-in-out overflow-hidden max-h-0">
                            <p>Anda dapat memberikan donasi melalui formulir donasi online yang tersedia di situs ini.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"><button
                            class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            aria-expanded="false"><span class="text-lg font-semibold text-gray-800">Apakah saya bisa menjadi
                                relawan meskipun tidak punya pengalaman?</span><svg
                                class="w-6 h-6 text-gray-600 transform transition-transform duration-300 " fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg></button>
                        <div
                            class="px-6 pb-6 text-gray-700 transition-max-height duration-500 ease-in-out overflow-hidden max-h-0">
                            <p>Tentu saja! Kami menyambut relawan dari berbagai latar belakang dan akan memberikan panduan
                                yang dibutuhkan.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"><button
                            class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            aria-expanded="false"><span class="text-lg font-semibold text-gray-800">Apakah donasi saya bisa
                                dikurangkan dari pajak?</span><svg
                                class="w-6 h-6 text-gray-600 transform transition-transform duration-300 " fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg></button>
                        <div
                            class="px-6 pb-6 text-gray-700 transition-max-height duration-500 ease-in-out overflow-hidden max-h-0">
                            <p>Ya, semua donasi dapat dikurangkan dari pajak dan kami menyediakan bukti donasi bila
                                diperlukan.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"><button
                            class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            aria-expanded="false"><span class="text-lg font-semibold text-gray-800">Bagaimana cara saya
                                menghubungi organisasi ini?</span><svg
                                class="w-6 h-6 text-gray-600 transform transition-transform duration-300 " fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg></button>
                        <div
                            class="px-6 pb-6 text-gray-700 transition-max-height duration-500 ease-in-out overflow-hidden max-h-0">
                            <p>Anda dapat menghubungi kami melalui halaman Kontak atau melalui email di info@example.org.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

