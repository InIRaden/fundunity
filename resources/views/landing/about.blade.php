@extends('layouts.landing')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang Komunitas Ruang Berbagi</h1>
        <p class="text-xl text-white/90">Membangun masa depan yang lebih baik, bersama-sama</p>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi Kami</h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Menjadi komunitas terdepan dalam menciptakan Indonesia yang bebas dari kelaparan dan kemiskinan,
                    di mana setiap individu memiliki akses terhadap kebutuhan dasar dan kesempatan untuk berkembang.
                </p>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Misi Kami</h2>
                <ul class="space-y-3 text-gray-600 text-lg">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Menyediakan bantuan pangan berkualitas untuk yang membutuhkan
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Memberdayakan masyarakat melalui edukasi dan pelatihan
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Membangun jaringan kolaborasi untuk dampak yang berkelanjutan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Our Story -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-8">Cerita Kami</h2>
        <div class="prose prose-lg max-w-none text-gray-600">
            <p class="mb-4">
                Komunitas Ruang Berbagi lahir dari kepedulian sekelompok individu yang melihat kesenjangan sosial
                di sekitar mereka. Dimulai dengan aksi sederhana berbagi makanan kepada yang membutuhkan,
                kami terus berkembang menjadi organisasi yang fokus pada pemberdayaan masyarakat secara holistik.
            </p>
            <p class="mb-4">
                Sejak didirikan, kami telah melayani ribuan keluarga di berbagai daerah di Indonesia.
                Dengan dukungan dari mitra, relawan, dan donatur yang peduli, kami terus memperluas jangkauan
                dan dampak program-program kami.
            </p>
            <p>
                Kami percaya bahwa setiap orang memiliki potensi untuk berkontribusi dalam menciptakan perubahan.
                Melalui Komunitas Ruang Berbagi, kami mengajak seluruh lapisan masyarakat untuk bersama-sama
                membangun Indonesia yang lebih sejahtera dan adil.
            </p>
        </div>
    </div>
</section>

<!-- Values -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Nilai-Nilai Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Kepedulian</h3>
                <p class="text-gray-600">
                    Kami peduli pada sesama dan berkomitmen untuk memberikan bantuan dengan sepenuh hati.
                </p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Integritas</h3>
                <p class="text-gray-600">
                    Transparansi dan akuntabilitas dalam setiap tindakan adalah prioritas kami.
                </p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Kolaborasi</h3>
                <p class="text-gray-600">
                    Bersama-sama kita lebih kuat dalam menciptakan perubahan yang berkelanjutan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-4">Tim Kami</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
            Digerakkan oleh individu-individu yang berdedikasi untuk menciptakan dampak positif
        </p>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @for($i = 1; $i <= 4; $i++)
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-lg">Tim Member {{ $i }}</h3>
                    <p class="text-gray-600 text-sm">Position</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-green-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Gerakan Kami</h2>
        <p class="text-xl mb-8">Bersama kita bisa membuat perbedaan yang nyata</p>
        <a href="{{ route('get-involved') }}" class="inline-block bg-white text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition">
            Mulai Berkontribusi
        </a>
    </div>
</section>

@endsection
