@extends('layouts.landing')

@section('title', 'Fokus Utama')

@section('content')
    <main class="p-8">
        <section class="bg-gradient-to-br from-white to-blue-50 min-h-screen flex flex-col justify-center p-8 pt-28">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-4xl font-extrabold text-center text-blue-900 mb-12 drop-shadow-md">Fokus Utama Kami</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-transform hover:scale-105 hover:shadow-2xl duration-300 cursor-default">
                        <div class="mb-6"><svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 20l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 12v8"></path>
                                <path d="M12 12L3 7"></path>
                                <path d="M12 12l9-5"></path>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-3 text-blue-800">Pendidikan</h3>
                        <p class="text-gray-600 leading-relaxed">Memberikan pendidikan berkualitas untuk anak-anak kurang
                            mampu agar mereka dapat mengembangkan potensinya.</p>
                    </div>
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-transform hover:scale-105 hover:shadow-2xl duration-300 cursor-default">
                        <div class="mb-6"><svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 8v8"></path>
                                <path d="M8 12h8"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-3 text-blue-800">Kesehatan</h3>
                        <p class="text-gray-600 leading-relaxed">Menyelenggarakan kampanye kesadaran kesehatan dan
                            memberikan akses layanan kesehatan dasar.</p>
                    </div>
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-transform hover:scale-105 hover:shadow-2xl duration-300 cursor-default">
                        <div class="mb-6"><svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 2l4 7-4 7-4-7 4-7z"></path>
                                <circle cx="12" cy="14" r="4"></circle>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-3 text-blue-800">Lingkungan</h3>
                        <p class="text-gray-600 leading-relaxed">Mendorong inisiatif untuk perlindungan lingkungan dan
                            keberlanjutan.</p>
                    </div>
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-transform hover:scale-105 hover:shadow-2xl duration-300 cursor-default">
                        <div class="mb-6"><svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M5 21v-2a4 4 0 0 1 8 0v2"></path>
                                <path d="M17 21v-2a4 4 0 0 0-8 0v2"></path>
                            </svg></div>
                        <h3 class="text-xl font-semibold mb-3 text-blue-800">Komunitas</h3>
                        <p class="text-gray-600 leading-relaxed">Memberdayakan masyarakat melalui pengembangan keterampilan
                            dan kolaborasi.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
