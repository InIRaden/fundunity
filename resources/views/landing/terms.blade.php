@extends('layouts.landing')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="container mx-auto px-4 py-20 max-w-4xl">
    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Syarat & Ketentuan</h1>

    <div class="prose prose-lg max-w-none">
        <p class="text-gray-600 mb-6">
            Terakhir diperbarui: {{ date('d F Y') }}
        </p>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">1. Penerimaan Ketentuan</h2>
            <p class="text-gray-700 leading-relaxed">
                Dengan mengakses dan menggunakan situs web ini, Anda menerima dan setuju untuk terikat oleh
                syarat dan ketentuan penggunaan ini.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">2. Penggunaan Layanan</h2>
            <p class="text-gray-700 leading-relaxed">
                Anda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah dan sesuai dengan
                semua hukum dan peraturan yang berlaku.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">3. Donasi</h2>
            <p class="text-gray-700 leading-relaxed">
                Semua donasi yang diberikan kepada Komunitas Ruang Berbagi bersifat sukarela dan tidak dapat dikembalikan,
                kecuali jika diwajibkan oleh hukum atau kebijakan kami.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">4. Perubahan Ketentuan</h2>
            <p class="text-gray-700 leading-relaxed">
                Kami berhak untuk mengubah syarat dan ketentuan ini kapan saja. Perubahan akan berlaku
                segera setelah dipublikasikan di situs web ini.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">5. Hubungi Kami</h2>
            <p class="text-gray-700 leading-relaxed">
                Jika Anda memiliki pertanyaan tentang Syarat & Ketentuan ini, silakan hubungi kami di
                <a href="mailto:komunitasruangberbagi@gmail.com" class="text-blue-600 hover:underline">
                    komunitasruangberbagi@gmail.com
                </a>
            </p>
        </section>
    </div>
</div>
@endsection
