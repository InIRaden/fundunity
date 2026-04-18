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
            @forelse($programs as $program)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if($program->image)
                        <img src="{{ $program->image }}" alt="{{ $program->title }}" class="aspect-video w-full object-cover">
                    @else
                        <div class="aspect-video bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $program->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $program->short_description }}</p>

                        @if($program->category || $program->location)
                            <div class="flex items-center text-sm text-gray-500 mb-4 gap-2 flex-wrap">
                                @if($program->category)
                                    <span class="px-2 py-1 bg-gray-100 rounded">{{ $program->category }}</span>
                                @endif
                                @if($program->location)
                                    <span>{{ $program->location }}</span>
                                @endif
                            </div>
                        @endif

                        @if($program->full_description)
                            <p class="text-sm text-gray-500">{{ $program->full_description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-gray-50 border border-dashed border-gray-300 rounded-lg p-8 text-center text-gray-600">
                    Belum ada program aktif. Silakan isi data dulu dari admin.
                </div>
            @endforelse
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
            <a href="{{ route('donation.form') }}" class="bg-green-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-700 transition">
                Donasi Sekarang
            </a>
            <a href="{{ route('get-involved') }}" class="bg-white border-2 border-green-600 text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-green-50 transition">
                Jadi Relawan
            </a>
        </div>
    </div>
</section>

@endsection
