@extends('layouts.landing')

@section('title', 'Bersama Ciptakan Perubahan')

@section('content')
<!-- Hero Section -->
<section class="relative text-white py-32 overflow-hidden" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1920&q=80') center/cover no-repeat;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Bersama, Ciptakan Perubahan bersama Komunitas Ruang Berbagi
            </h1>
            <p class="text-lg md:text-xl mb-10 text-white max-w-3xl">
                Bergabunglah bersama kami untuk memberi dampak nyata bagi yang membutuhkan dan membangun masa depan yang lebih baik.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('get-involved') }}" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg text-center">
                    Ayo Mulai Bergerak
                </a>
                <a href="{{ route('get-involved') }}" class="inline-block bg-transparent border-2 border-white text-white px-10 py-4 rounded-lg font-semibold hover:bg-white/10 transition shadow-lg text-center">
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Galeri Momen Kami</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Temukan cerita di balik misi kami. Saksikan video penuh makna dan lihat gambar-gambar yang menggambarkan perubahan nyata.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- Video/Image Left -->
            <div class="relative">
                <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl overflow-hidden aspect-video shadow-xl">
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-600 p-8">
                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-center font-medium">Misi Kami dalam Gerakan</p>
                    </div>
                </div>
            </div>

            <!-- Content Right -->
            <div class="flex flex-col justify-center">
                <div class="bg-gray-50 rounded-2xl overflow-hidden aspect-video shadow-lg mb-6">
                    <div class="w-full h-full flex items-center justify-center text-gray-400 p-8">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p>Image</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Cerita Dampak Kami</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Perjalanan visual kami menunjukkan bagaimana tindakan kecil dapat menciptakan perubahan besar. Momen-momen ini mengingatkan kita pentingnya komunitas.
                    </p>
                    <a href="{{ route('gallery') }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition">
                        Lihat Galeri
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <p class="text-gray-500 text-sm">Memuat gambar...</p>
        </div>
    </div>
</section>

<!-- Gallery Slider Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Galeri Slider</h2>
        </div>
        <div class="relative bg-gray-200 rounded-2xl overflow-hidden" style="height: 500px;">
            <div class="w-full h-full flex items-center justify-center text-gray-400">
                <div class="text-center">
                    <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-lg">Memuat gambar...</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-relaxed">
                Melalui program-program yang bersinergi,<br>
                Komunitas Ruang Berbagi berusaha untuk menciptakan Indonesia yang bebas dari kelaparan.
            </h2>
        </div>

        <div class="text-center">
            <a href="{{ route('programs') }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition text-lg">
                Other Programs
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="text-gray-500">Loading partners...</div>
        </div>
    </div>
</section>

<!-- CTA Section - Before Footer -->
<section class="bg-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-sm text-gray-500">
            TETAP TERHUBUNG
        </div>
    </div>
</section>

@endsection
