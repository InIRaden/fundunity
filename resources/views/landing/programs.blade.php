@extends('layouts.landing')

@section('title', 'Program Kami')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Program Kami</h1>
        <p class="text-xl text-white/90">Aksi nyata untuk perubahan yang berkelanjutan</p>
    </div>
</section>

<!-- Programs Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Program 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="aspect-video bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Distribusi Pangan</h3>
                    <p class="text-gray-600 mb-4">
                        Menyediakan paket makanan bergizi untuk keluarga kurang mampu secara rutin setiap bulan.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        1000+ Keluarga Terbantu
                    </div>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>

            <!-- Program 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="aspect-video bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Pendidikan Gizi</h3>
                    <p class="text-gray-600 mb-4">
                        Workshop dan pelatihan tentang pentingnya nutrisi dan pola makan sehat untuk keluarga.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        500+ Peserta Teredukasi
                    </div>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>

            <!-- Program 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="aspect-video bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Pelatihan Keterampilan</h3>
                    <p class="text-gray-600 mb-4">
                        Program pelatihan keterampilan untuk meningkatkan kemandirian ekonomi masyarakat.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        200+ Peserta Terlatih
                    </div>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>

            <!-- Program 4 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="aspect-video bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Dapur Umum</h3>
                    <p class="text-gray-600 mb-4">
                        Menyediakan makanan hangat gratis untuk masyarakat kurang mampu di berbagai lokasi.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        300+ Porsi/Hari
                    </div>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>

            <!-- Program 5 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="aspect-video bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Pemberdayaan Perempuan</h3>
                    <p class="text-gray-600 mb-4">
                        Program khusus memberdayakan perempuan melalui pelatihan dan bantuan usaha mikro.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        150+ Perempuan Terberdayakan
                    </div>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>

            <!-- Program 6 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="aspect-video bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Renovasi Rumah</h3>
                    <p class="text-gray-600 mb-4">
                        Membantu merenovasi rumah tidak layak huni untuk menciptakan lingkungan yang lebih baik.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        50+ Rumah Direnovasi
                    </div>
                    <a href="#" class="text-green-600 font-semibold hover:text-green-700">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Ingin Mendukung Program Kami?</h2>
        <p class="text-gray-600 text-lg mb-8">
            Setiap kontribusi Anda akan membawa perubahan nyata bagi mereka yang membutuhkan
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-green-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-700 transition">
                Donasi Sekarang
            </a>
            <a href="{{ route('get-involved') }}" class="bg-white border-2 border-green-600 text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-green-50 transition">
                Jadi Relawan
            </a>
        </div>
    </div>
</section>

@endsection
