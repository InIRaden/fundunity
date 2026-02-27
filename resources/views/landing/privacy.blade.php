@extends('layouts.landing')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="container mx-auto px-4 py-20 max-w-4xl">
    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Kebijakan Privasi</h1>

    <div class="prose prose-lg max-w-none">
        <p class="text-gray-600 mb-6">
            Terakhir diperbarui: {{ date('d F Y') }}
        </p>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">1. Informasi yang Kami Kumpulkan</h2>
            <p class="text-gray-700 leading-relaxed">
                Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk nama, alamat email,
                dan informasi lain yang Anda pilih untuk dibagikan.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">2. Penggunaan Informasi</h2>
            <p class="text-gray-700 leading-relaxed">
                Kami menggunakan informasi yang kami kumpulkan untuk menyediakan, memelihara, dan meningkatkan layanan kami,
                serta untuk berkomunikasi dengan Anda tentang program dan kegiatan kami.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">3. Keamanan Informasi</h2>
            <p class="text-gray-700 leading-relaxed">
                Kami mengambil langkah-langkah yang wajar untuk melindungi informasi pribadi Anda dari kehilangan,
                penyalahgunaan, dan akses yang tidak sah.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">4. Hubungi Kami</h2>
            <p class="text-gray-700 leading-relaxed">
                Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami di
                <a href="mailto:komunitasruangberbagi@gmail.com" class="text-blue-600 hover:underline">
                    komunitasruangberbagi@gmail.com
                </a>
            </p>
        </section>
    </div>
</div>
@endsection
