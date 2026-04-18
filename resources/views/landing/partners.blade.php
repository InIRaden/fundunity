@extends('layouts.landing')

@section('title', 'Mitra Kami')

@section('content')
@php
    $partnerGroups = $partnerGroups ?? [
        'corporate' => collect(),
        'ngo' => collect(),
        'government' => collect(),
        'other' => collect(),
    ];

    $sections = [
        ['key' => 'corporate', 'title' => 'Partner Korporat', 'fallback' => 8],
        ['key' => 'ngo', 'title' => 'Partner LSM & Organisasi Sosial', 'fallback' => 4],
        ['key' => 'government', 'title' => 'Partner Pemerintah', 'fallback' => 4],
    ];
@endphp

<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Mitra Kami</h1>
        <p class="text-xl text-white/90">Bersama mewujudkan perubahan positif</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kami bangga berkolaborasi dengan berbagai organisasi, perusahaan, dan lembaga yang berbagi visi yang sama
                untuk menciptakan dampak positif bagi masyarakat.
            </p>
        </div>

        @foreach($sections as $section)
            @php
                $partnersInSection = collect($partnerGroups[$section['key']] ?? []);
            @endphp

            <div class="mb-16">
                <h2 class="text-2xl font-bold mb-8">{{ $section['title'] }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @forelse($partnersInSection as $partner)
                        <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center justify-center aspect-square hover:shadow-lg transition border border-slate-100">
                            @if(!empty($partner->logo))
                                <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" class="max-h-20 w-auto object-contain">
                            @else
                                <div class="text-center text-gray-400 text-sm font-semibold">Logo Mitra</div>
                            @endif

                            <p class="mt-4 text-sm font-semibold text-slate-700 text-center line-clamp-2">{{ $partner->name }}</p>

                            @if(!empty($partner->website_url))
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="mt-2 text-xs font-semibold text-green-700 hover:text-green-800">
                                    Kunjungi situs
                                </a>
                            @endif
                        </div>
                    @empty
                        @for($i = 1; $i <= $section['fallback']; $i++)
                            <div class="bg-gray-100 rounded-lg p-8 flex items-center justify-center aspect-square hover:shadow-lg transition">
                                <div class="text-center text-gray-400">
                                    <div class="text-sm font-semibold">Partner Logo {{ $i }}</div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Partnership Benefits -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Keuntungan Bermitra dengan Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg p-8 shadow-lg">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Dampak Sosial Nyata</h3>
                <p class="text-gray-600">
                    Kontribusi Anda langsung membantu ribuan keluarga dan menciptakan perubahan positif di masyarakat.
                </p>
            </div>

            <div class="bg-white rounded-lg p-8 shadow-lg">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Transparansi & Akuntabilitas</h3>
                <p class="text-gray-600">
                    Laporan rutin dan dokumentasi lengkap tentang penggunaan kontribusi dan dampak program.
                </p>
            </div>

            <div class="bg-white rounded-lg p-8 shadow-lg">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Jaringan Kolaborasi</h3>
                <p class="text-gray-600">
                    Terhubung dengan jaringan luas organisasi dan individu yang peduli pada isu sosial.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Tertarik Bermitra dengan Kami?</h2>
        <p class="text-gray-600 text-lg mb-8">
            Mari bersama-sama menciptakan dampak positif yang berkelanjutan untuk masyarakat
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-green-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-700 transition">
            Hubungi Kami untuk Kemitraan
        </a>
    </div>
</section>

@endsection
