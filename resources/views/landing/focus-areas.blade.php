@extends('layouts.landing')

@section('title', 'Fokus Utama')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Fokus Utama Kami</h1>
        <p class="text-xl text-white/90">Area prioritas dalam menciptakan perubahan</p>
    </div>
</section>

<!-- Focus Areas -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Focus Area 1 -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="inline-block bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                        Fokus #1
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Penanggulangan Kelaparan</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Kami berkomitmen untuk mengatasi masalah kelaparan di Indonesia melalui distribusi pangan yang
                        berkelanjutan dan terstruktur. Program ini mencakup penyediaan makanan bergizi, edukasi gizi,
                        dan pemberdayaan masyarakat untuk mencapai ketahanan pangan.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Distribusi paket pangan rutin ke 1000+ keluarga</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Dapur umum di berbagai lokasi strategis</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Program gizi untuk ibu dan anak</span>
                        </li>
                    </ul>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="aspect-square bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Focus Area 2 -->
        <div class="mb-20 bg-gray-50 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="aspect-square bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            Fokus #2
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">Pendidikan & Literasi</h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Pendidikan adalah kunci untuk memutus rantai kemiskinan. Kami menyediakan akses pendidikan,
                            pelatihan keterampilan, dan program literasi untuk memberdayakan masyarakat agar dapat
                            mandiri secara ekonomi.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-600">Workshop dan pelatihan keterampilan gratis</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-600">Program beasiswa untuk anak kurang mampu</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-600">Perpustakaan komunitas dan taman baca</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Focus Area 3 -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="inline-block bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                        Fokus #3
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Pemberdayaan Ekonomi</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Kami membantu masyarakat untuk mandiri secara ekonomi melalui pelatihan kewirausahaan,
                        bantuan modal usaha mikro, dan pendampingan bisnis. Tujuannya adalah menciptakan
                        kemandirian ekonomi yang berkelanjutan.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Pelatihan kewirausahaan dan manajemen usaha</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Bantuan modal untuk usaha mikro</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Pendampingan dan mentoring berkelanjutan</span>
                        </li>
                    </ul>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="aspect-square bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Focus Area 4 -->
        <div class="bg-gray-50 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="aspect-square bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="inline-block bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            Fokus #4
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">Lingkungan Hidup Layak</h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Setiap orang berhak hidup dalam lingkungan yang layak dan sehat. Kami membantu renovasi
                            rumah tidak layak huni, perbaikan sanitasi, dan peningkatan kualitas lingkungan tempat tinggal.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-orange-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-600">Renovasi rumah tidak layak huni</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-orange-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-600">Perbaikan fasilitas sanitasi</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-orange-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-600">Program kebersihan lingkungan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impact Stats -->
<section class="py-16 bg-green-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Dampak yang Telah Kami Ciptakan</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">1,000+</div>
                <div class="text-white/90">Keluarga Terbantu</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">500+</div>
                <div class="text-white/90">Peserta Pelatihan</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">50+</div>
                <div class="text-white/90">Rumah Direnovasi</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">20+</div>
                <div class="text-white/90">Program Aktif</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Mari Berkontribusi untuk Perubahan</h2>
        <p class="text-gray-600 text-lg mb-8">
            Setiap kontribusi Anda sangat berarti dalam mewujudkan Indonesia yang lebih baik
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-green-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-700 transition">
                Donasi Sekarang
            </a>
            <a href="{{ route('get-involved') }}" class="bg-white border-2 border-green-600 text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-green-50 transition">
                Bergabung sebagai Relawan
            </a>
        </div>
    </div>
</section>

@endsection
