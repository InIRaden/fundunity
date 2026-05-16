@extends('layouts.landing')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="min-h-screen bg-slate-50 pb-20">
    <!-- Header Section -->
    <div class="bg-[#022c22] pt-32 pb-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-orange-400 font-bold text-xs tracking-[0.2em] uppercase mb-4 block">Informasi Hukum</span>
            <h1 class="text-3xl md:text-5xl font-black text-white mb-6">Kebijakan Privasi</span></h1>
            <p class="text-emerald-50/60 text-base md:text-lg">
                Komitmen kami dalam melindungi data pribadi dan menjaga kepercayaan Anda.
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-4xl mx-auto px-6 -mt-12 relative z-20">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 p-8 md:p-12 border border-slate-100">
            <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-100">
                <div class="text-sm font-bold text-slate-400 italic">
                    Terakhir diperbarui: {{ date('d F Y') }}
                </div>
                <div class="flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                    <div class="w-2 h-2 rounded-full bg-emerald-300"></div>
                    <div class="w-2 h-2 rounded-full bg-emerald-100"></div>
                </div>
            </div>

            <div class="max-w-none mb-12">
                @php
                    // Clean content: normalize newlines and trim each line to prevent unintended tabs
                    $cleanContent = collect(explode("\n", $content ?? ''))
                        ->map(fn($line) => trim($line))
                        ->implode("\n");

                    // Split into blocks by double newlines
                    $blocks = preg_split('/\n\s*\n/', $cleanContent);
                    $itemIndex = 1;
                @endphp

                @foreach($blocks as $block)
                    @php
                        $lines = explode("\n", trim($block));
                        $titleLine = $lines[0];
                        $bodyLines = array_slice($lines, 1);

                        // Check if title starts with number like "1. "
                        if (preg_match('/^\d+\.\s*(.*)/', $titleLine, $matches)) {
                            $title = $matches[1];
                            $number = str_pad($itemIndex++, 2, '0', STR_PAD_LEFT);
                        } else {
                            $title = $titleLine;
                            $number = null;
                        }
                    @endphp

                    <section class="mb-12 last:mb-0">
                        @if($number)
                            <div class="flex items-start gap-5 mb-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0 border border-emerald-100 shadow-sm">
                                    <span class="font-bold text-emerald-600">{{ $number }}</span>
                                </div>
                                <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 pt-1">{{ $title }}</h2>
                            </div>
                            <div class="text-slate-600 leading-relaxed md:pl-[60px] whitespace-pre-wrap font-medium">
                                {{ implode("\n", $bodyLines) }}
                            </div>
                        @else
                            <div class="text-slate-700 leading-relaxed whitespace-pre-wrap font-medium prose prose-slate max-w-none">
                                {!! nl2br(e($block)) !!}
                            </div>
                        @endif
                    </section>
                @endforeach
            </div>

            <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 mt-12">
                <div class="flex items-start gap-5 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shrink-0 border border-emerald-100 shadow-sm">
                        <i class="ph ph-chat-centered-text text-emerald-600 text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-emerald-900 pt-1">Pertanyaan Privasi?</h2>
                </div>
                <p class="text-emerald-800/70 text-sm leading-relaxed mb-4 md:pl-[60px]">
                    Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau ingin mengajukan keberatan terkait penggunaan data Anda, silakan hubungi tim kami.
                </p>
                <div class="md:pl-[60px]">
                    <a href="mailto:komunitasruangberbagi@gmail.com" class="inline-flex items-center gap-2 font-bold text-emerald-700 hover:text-emerald-600 transition-colors">
                        komunitasruangberbagi@gmail.com
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
