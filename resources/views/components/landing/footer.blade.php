@php
    $logoUrl = filled($siteSettings['site_logo'] ?? null) ? $siteSettings['site_logo'] : asset('images/Logo.png');
    $brandName = $siteSettings['site_short_name'] ?? 'FundUnity';
@endphp

<footer class="border-t border-slate-800 bg-slate-900 py-16 text-slate-400">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-16 grid grid-cols-1 gap-12 md:grid-cols-12 lg:gap-8">
            <div class="md:col-span-4">
                <div class="mb-6 flex items-center gap-3">
                    <img src="{{ $logoUrl }}" alt="{{ $siteSettings['site_name'] ?? $brandName }}" class="h-10 w-10 rounded-xl bg-white object-cover shadow-sm">
                    <span class="font-display text-2xl font-extrabold text-white">{{ $brandName }}<span class="text-emerald-500">.</span></span>
                </div>
                <p class="mb-6 leading-relaxed">
                    {{ $siteSettings['footer_tagline'] ?? 'Platform konektivitas, galang dana, dan transparansi organisasi terpercaya.' }}
                </p>
                <div class="flex space-x-4">
                    <a href="{{ $siteSettings['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-800 text-emerald-400 transition-all hover:bg-emerald-500 hover:text-white">
                        <i class="ph ph-instagram-logo text-xl"></i>
                    </a>
                    <a href="{{ $siteSettings['whatsapp_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-800 text-emerald-400 transition-all hover:bg-emerald-500 hover:text-white">
                        <i class="ph ph-whatsapp-logo text-xl"></i>
                    </a>
                </div>
            </div>

            <div class="md:col-span-2">
                <h4 class="mb-6 text-sm font-bold uppercase tracking-[0.2em] text-white">Organisasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}" class="transition-colors hover:text-emerald-400">Tentang Kami</a></li>
                    <li><a href="{{ route('home') }}#tentang" class="transition-colors hover:text-emerald-400">Visi & Misi</a></li>
                    <li><a href="{{ route('faq') }}" class="transition-colors hover:text-emerald-400">FAQ</a></li>
                    <li><a href="{{ route('get-involved') }}" class="transition-colors hover:text-emerald-400">Karir & Relawan</a></li>
                </ul>
            </div>

            <div class="md:col-span-3">
                <h4 class="mb-6 text-sm font-bold uppercase tracking-[0.2em] text-white">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="ph ph-map-pin text-xl text-emerald-500"></i>
                        <span>{{ $siteSettings['address'] ?? 'Sekretariat Utama FundUnity' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="ph ph-phone text-xl text-emerald-500"></i>
                        <span>{{ $siteSettings['phone'] ?? '+62 811 2233 4455' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="ph ph-envelope-simple text-xl text-emerald-500"></i>
                        <span>{{ $siteSettings['email'] ?? 'halo@fundunity.id' }}</span>
                    </li>
                </ul>
            </div>

            <div class="md:col-span-3">
                <h4 class="mb-6 text-sm font-bold uppercase tracking-[0.2em] text-white">Newsletter</h4>
                <p class="mb-4 text-sm">Dapatkan laporan bulanan dan kabar baik penyaluran dana langsung ke email Anda.</p>

                @if(session('newsletter_success'))
                    <div class="mb-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm font-bold text-emerald-400">
                        {{ session('newsletter_success') }}
                    </div>
                @endif

                @if(session('newsletter_error'))
                    <div class="mb-4 rounded-xl border border-rose-500/20 bg-rose-500/10 p-4 text-sm font-bold text-rose-300">
                        {{ session('newsletter_error') }}
                    </div>
                @endif

                <form id="newsletterForm" method="POST" action="{{ route('newsletter.subscribe') }}" class="relative">
                    @csrf
                    <input
                        id="newsletterEmailInput"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="{{ $siteSettings['newsletter_placeholder'] ?? 'Alamat email Anda...' }}"
                        class="w-full rounded-xl border border-slate-700 bg-slate-800 py-3 pl-4 pr-12 text-white outline-none transition-colors focus:border-emerald-500"
                        required
                    >
                    <button id="newsletterSubmitButton" type="submit" class="absolute right-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-lg bg-emerald-500 text-white transition-colors hover:bg-emerald-400">
                        <i id="newsletterSubmitIcon" class="ph ph-paper-plane-tilt text-lg"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-4 border-t border-slate-800 pt-8 text-sm md:flex-row">
            <p>&copy; {{ date('Y') }} {{ $siteSettings['footer_copyright'] ?? ($siteSettings['site_name'] ?? 'FundUnity') }}</p>
            <div class="flex space-x-6">
                <a href="{{ route('terms') }}" class="transition-colors hover:text-emerald-400">Syarat & Ketentuan</a>
                <a href="{{ route('privacy') }}" class="transition-colors hover:text-emerald-400">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterEmailInput = document.getElementById('newsletterEmailInput');
        const newsletterSubmitButton = document.getElementById('newsletterSubmitButton');
        const newsletterSubmitIcon = document.getElementById('newsletterSubmitIcon');

        newsletterForm?.addEventListener('submit', function () {
            if (!newsletterEmailInput?.value?.trim() || !newsletterSubmitButton || !newsletterSubmitIcon) {
                return;
            }

            newsletterSubmitButton.disabled = true;
            newsletterSubmitButton.classList.add('cursor-not-allowed', 'opacity-70');
            newsletterSubmitButton.classList.remove('hover:bg-emerald-400');
            newsletterSubmitIcon.classList.remove('ph-paper-plane-tilt');
            newsletterSubmitIcon.classList.add('ph-spinner', 'animate-spin');
        });
    });
</script>
@endpush
