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
            <h1 class="text-3xl md:text-5xl font-black text-white mb-6">Kebijakan <span class="text-emerald-400">Privasi</span></h1>
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

            <div class="prose prose-slate prose-lg max-w-none">
                <section class="mb-12">
                    <div class="flex items-start gap-5 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0 border border-emerald-100">
                            <span class="font-bold text-emerald-600">01</span>
                        </div>
                        <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 pt-1">Informasi yang Kami Kumpulkan</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed pl-15">
                        Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk nama, alamat email,
                        dan informasi lain yang Anda pilih untuk dibagikan saat melakukan donasi atau pendaftaran relawan.
                    </p>
                </section>

                <section class="mb-12">
                    <div class="flex items-start gap-5 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0 border border-emerald-100">
                            <span class="font-bold text-emerald-600">02</span>
                        </div>
                        <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 pt-1">Penggunaan Informasi</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed pl-15">
                        Kami menggunakan informasi yang kami kumpulkan untuk menyediakan, memelihara, dan meningkatkan layanan kami,
                        memproses transaksi donasi Anda, serta untuk berkomunikasi dengan Anda tentang laporan penyaluran dana.
                    </p>
                </section>

                <section class="mb-12">
                    <div class="flex items-start gap-5 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0 border border-emerald-100">
                            <span class="font-bold text-emerald-600">03</span>
                        </div>
                        <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 pt-1">Keamanan Informasi</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed pl-15">
                        Kami mengambil langkah-langkah teknis dan organisasional yang wajar untuk melindungi informasi pribadi Anda dari akses yang tidak sah, pencurian, atau penyalahgunaan.
                    </p>
                </section>

                <section class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100">
                    <div class="flex items-start gap-5 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shrink-0 border border-emerald-100 shadow-sm">
                            <i class="ph ph-envelope-simple text-emerald-600 text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-emerald-900 pt-1">Butuh Bantuan?</h2>
                    </div>
                    <p class="text-emerald-800/70 text-sm leading-relaxed mb-4 pl-15">
                        Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau ingin mengajukan keberatan terkait penggunaan data Anda, silakan hubungi tim kami.
                    </p>
                    <div class="pl-15">
                        <a href="mailto:komunitasruangberbagi@gmail.com" class="inline-flex items-center gap-2 font-bold text-emerald-700 hover:text-emerald-600 transition-colors">
                            komunitasruangberbagi@gmail.com
                            <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
