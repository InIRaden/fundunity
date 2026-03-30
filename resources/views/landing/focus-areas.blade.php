@extends('layouts.landing')

@section('title', 'Fokus Utama')

@section('content')
    <section class="bg-gradient-to-br from-white to-blue-50 min-h-screen p-8 pt-28">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-center text-blue-900 mb-12">Fokus Utama Kami</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                @forelse($focusAreas as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        @if($item->image)
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="h-48 w-full object-cover">
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v8"/>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-blue-900">{{ $item->title }}</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $item->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 bg-white border border-dashed rounded-lg p-8 text-center text-gray-600">
                        Belum ada focus area aktif. Tambahkan dari admin.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
