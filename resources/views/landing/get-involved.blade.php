@extends('layouts.landing')

@section('title', 'Bergabung Bersama Kami')

@section('content')
    @php
        $defaultTypes = collect([
            [
                'title' => 'Menjadi Relawan',
                'description' => 'Sumbangkan waktu dan keterampilan Anda untuk membuat perbedaan nyata dalam program kami.',
                'button_text' => 'Daftar Relawan',
            ],
            [
                'title' => 'Donasi',
                'description' => 'Dukung kami secara finansial agar kami dapat terus menjalankan program-program yang berdampak.',
                'button_text' => 'Mulai Donasi',
            ],
            [
                'title' => 'Sebarkan Pesan',
                'description' => 'Bagikan misi kami kepada teman dan keluarga Anda untuk meningkatkan kesadaran.',
                'button_text' => 'Bagikan Sekarang',
            ],
        ]);

        $cards = isset($involvementTypes) && collect($involvementTypes)->isNotEmpty()
            ? collect($involvementTypes)->map(static function ($item) {
                return [
                    'title' => $item->title,
                    'description' => $item->description,
                    'button_text' => $item->button_text,
                    'icon' => $item->icon,
                ];
            })
            : $defaultTypes;

        $themes = ['bg-blue-600', 'bg-green-600', 'bg-purple-600'];
    @endphp

    <main class="p-8">
        <section class="bg-gradient-to-r from-purple-50 to-blue-50 min-h-screen flex flex-col justify-center p-8">
            <div class="max-w-5xl mx-auto text-center">
                <h1 class="text-4xl font-extrabold text-purple-900 mb-10 drop-shadow-sm">Cara Terlibat</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                    @foreach($cards as $card)
                        @php
                            $theme = $themes[$loop->index % count($themes)];
                            $title = $card['title'] ?? 'Terlibat';
                            $description = $card['description'] ?? 'Dukung gerakan sosial kami bersama komunitas.';
                        @endphp

                        <div class="flex flex-col items-center p-6 rounded-xl shadow-lg text-white cursor-pointer transform hover:scale-105 transition-transform duration-300 {{ $theme }}">
                            <div class="mb-4 w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-xl font-bold">
                                {{ strtoupper(substr($title, 0, 1)) }}
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $title }}</h3>
                            <p class="text-sm">{{ $description }}</p>
                        </div>
                    @endforeach
                </div>

                @if(isset($involvementBenefits) && collect($involvementBenefits)->isNotEmpty())
                    <div class="mt-12 bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-left">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Manfaat Bergabung</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($involvementBenefits as $benefit)
                                <div class="rounded-xl border border-slate-200 p-4 bg-slate-50">
                                    <h3 class="font-semibold text-slate-800">{{ $benefit->title }}</h3>
                                    <p class="text-sm text-slate-600 mt-1">{{ $benefit->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

