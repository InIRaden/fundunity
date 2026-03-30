@extends('layouts.landing')

@section('title', 'Galeri')

@section('content')
    <main class="p-8 pt-28 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center">Galeri Kegiatan</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($galleryItems as $item)
                    <article class="bg-white border rounded-lg overflow-hidden shadow-sm">
                        @if($item->type === 'video')
                            <iframe src="{{ $item->url }}" class="w-full aspect-video" allowfullscreen loading="lazy"></iframe>
                        @else
                            <img src="{{ $item->url }}" alt="{{ $item->title }}" class="w-full aspect-video object-cover">
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-1">{{ $item->title }}</h3>
                            @if($item->category)
                                <p class="text-xs text-gray-500 mb-2">{{ $item->category }}</p>
                            @endif
                            @if($item->caption)
                                <p class="text-sm text-gray-700">{{ $item->caption }}</p>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white border border-dashed rounded-lg p-8 text-center text-gray-600">
                        Belum ada item galeri aktif. Tambahkan dari admin.
                    </div>
                @endforelse
            </div>
        </div>
    </main>

@endsection
