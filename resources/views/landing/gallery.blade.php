@extends('layouts.landing')

@section('title', 'Galeri')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Momen Kami</h1>
        <p class="text-xl text-white/90">Dokumentasi perjalanan kami dalam membuat perubahan</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="px-6 py-2 bg-green-600 text-white rounded-full font-semibold">Semua</button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 transition">Program</button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 transition">Kegiatan</button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 transition">Komunitas</button>
        </div>

        <!-- Photo Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-16">
            @for($i = 1; $i <= 12; $i++)
            <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden group cursor-pointer">
                <div class="w-full h-full flex items-center justify-center text-gray-500 group-hover:bg-gray-300 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            @endfor
        </div>

        <!-- Video Gallery -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-center mb-8">Video Dokumentasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @for($i = 1; $i <= 3; $i++)
                <div class="bg-gray-200 rounded-lg overflow-hidden aspect-video group cursor-pointer">
                    <div class="w-full h-full flex items-center justify-center text-gray-500 group-hover:bg-gray-300 transition">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>

<!-- Stories Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Cerita Dampak Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @for($i = 1; $i <= 4; $i++)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="aspect-video bg-gray-200 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Kisah Perubahan {{ $i }}</h3>
                    <p class="text-gray-600 mb-4">
                        Perjalanan visual kami menunjukkan bagaimana tindakan kecil dapat menciptakan perubahan besar.
                        Momen-momen ini mengingatkan kita pentingnya komunitas.
                    </p>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

@endsection
