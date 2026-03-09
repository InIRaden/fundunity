@extends('layouts.landing')

@section('title', 'Bergabung Bersama Kami')

@section('content')
    <main class="p-8">
        <section class="bg-gradient-to-r from-purple-50 to-blue-50 min-h-screen flex flex-col justify-center p-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl font-extrabold text-purple-900 mb-10 drop-shadow-sm">Cara Terlibat</h1>
                <div class="flex flex-col sm:flex-row justify-center gap-8">
                    <div
                        class="flex flex-col items-center p-6 rounded-xl shadow-lg text-white max-w-xs cursor-pointer transform hover:scale-105 transition-transform duration-300 bg-blue-600">
                        <div class="mb-4"><svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 14v7"></path>
                                <path d="M12 14L3 9"></path>
                                <path d="M12 14l9-5"></path>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-2">Menjadi Relawan</h3>
                        <p class="text-sm">Sumbangkan waktu dan keterampilan Anda untuk membuat perbedaan nyata dalam
                            program kami.</p>
                    </div>
                    <div
                        class="flex flex-col items-center p-6 rounded-xl shadow-lg text-white max-w-xs cursor-pointer transform hover:scale-105 transition-transform duration-300 bg-green-600">
                        <div class="mb-4"><svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 8v8"></path>
                                <path d="M8 12h8"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-2">Donasi</h3>
                        <p class="text-sm">Dukung kami secara finansial agar kami dapat terus menjalankan program-program
                            yang berdampak.</p>
                    </div>
                    <div
                        class="flex flex-col items-center p-6 rounded-xl shadow-lg text-white max-w-xs cursor-pointer transform hover:scale-105 transition-transform duration-300 bg-purple-600">
                        <div class="mb-4"><svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M22 12h-4l-3 9-4-18-3 9H2"></path>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-2">Sebarkan Pesan</h3>
                        <p class="text-sm">Bagikan misi kami kepada teman dan keluarga Anda untuk meningkatkan kesadaran.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

