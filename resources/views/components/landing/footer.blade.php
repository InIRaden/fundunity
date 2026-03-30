<footer class="relative overflow-hidden bg-[#0f172a] text-white">
    <div class="relative py-16 border-b border-gray-700 bg-gradient-to-br from-[#1e293b] to-[#334155]">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center transition-all duration-1000 opacity-100 translate-y-0">
                <div class="inline-flex items-center gap-3 mb-6 px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm">
                    <x-icons.paper-plane class="text-white w-8 h-8" />
                    <span class="text-sm font-semibold text-white tracking-wider uppercase">Tetap Terhubung</span>
                </div>
                <h2 class="text-4xl font-black mb-4">{{ $siteSettings['newsletter_title'] ?? 'Bergabunglah Bersama Kami' }}</h2>
                <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
                    {{ $siteSettings['newsletter_description'] ?? 'Dapatkan pembaruan terbaru seputar program, kisah inspiratif, dan kesempatan berkontribusi.' }}
                </p>
                <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex flex-col sm:flex-row items-center gap-4 max-w-xl mx-auto">
                    @csrf
                    <input
                        type="email"
                        name="email"
                        placeholder="{{ $siteSettings['newsletter_placeholder'] ?? 'Masukkan email Anda' }}"
                        class="w-full px-6 py-4 rounded-2xl bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        value="{{ old('email') }}"
                    >
                    <button
                        type="submit"
                        class="px-6 py-4 rounded-2xl font-bold text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 bg-gradient-to-r from-blue-600 to-blue-400"
                    >
                        {{ $siteSettings['newsletter_cta_text'] ?? 'Berlangganan' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="py-16 container mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10">
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-green-400 bg-clip-text text-transparent">
                {{ $siteSettings['site_name'] ?? 'Komunitas Ruang Berbagi' }}
            </h3>
            <p class="text-gray-400">
                {{ $siteSettings['footer_tagline'] ?? 'Membantu individu dan organisasi mendukung berbagai aksi nyata demi dunia yang lebih baik.' }}
            </p>
            <div class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                <x-icons.phone class="flex-shrink-0" />
                <span>{{ $siteSettings['phone'] ?? '0821 - 1677 - 1146' }}</span>
            </div>
            <div class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                <x-icons.envelope class="flex-shrink-0" />
                <span>{{ $siteSettings['email'] ?? 'komunitasruangberbagi@gmail.com' }}</span>
            </div>
            <div class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                <x-icons.location-dot class="flex-shrink-0" />
                <span>{{ $siteSettings['address'] ?? 'Bandung, Jawa Barat, Indonesia' }}</span>
            </div>
        </div>
        <div>
            <h4 class="flex items-center gap-2 text-lg font-semibold mb-4">
                <x-icons.users />
                Siapa Kami
            </h4>
            <ul class="space-y-3 text-gray-400">
                <li><a href="{{ $siteSettings['nav_about_url'] ?? route('about') }}" class="hover:text-white transition">{{ $siteSettings['nav_about_label'] ?? 'Tentang KRB' }}</a></li>
                <li><a href="{{ $siteSettings['nav_partners_url'] ?? route('partners') }}" class="hover:text-white transition">{{ $siteSettings['nav_partners_label'] ?? 'Mitra' }}</a></li>
                <li><a href="{{ $siteSettings['nav_contact_url'] ?? route('contact') }}" class="hover:text-white transition">{{ $siteSettings['nav_contact_label'] ?? 'Hubungi Kami' }}</a></li>
            </ul>
        </div>
        <div>
            <h4 class="flex items-center gap-2 text-lg font-semibold mb-4">
                <x-icons.handshake />
                Bergerak Bersama
            </h4>
            <ul class="space-y-3 text-gray-400">
                <li><a href="{{ $siteSettings['nav_faq_url'] ?? route('faq') }}" class="hover:text-white transition">{{ $siteSettings['nav_faq_label'] ?? 'FAQ' }}</a></li>
                <li><a href="{{ $siteSettings['nav_get_involved_url'] ?? route('get-involved') }}" class="hover:text-white transition">{{ $siteSettings['nav_get_involved_label'] ?? 'Gabung Bersama Kami' }}</a></li>
            </ul>
        </div>
        <div>
            <h4 class="flex items-center gap-2 text-lg font-semibold mb-4">
                <x-icons.bullseye />
                Apa yang Kami Lakukan
            </h4>
            <ul class="space-y-3 text-gray-400">
                <li><a href="{{ $siteSettings['nav_programs_url'] ?? route('programs') }}" class="hover:text-white transition">{{ $siteSettings['nav_programs_label'] ?? 'Program' }}</a></li>
                <li><a href="{{ $siteSettings['nav_focus_areas_url'] ?? route('focus-areas') }}" class="hover:text-white transition">{{ $siteSettings['nav_focus_areas_label'] ?? 'Fokus Utama' }}</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-700 pt-10 pb-6 text-center">
        <h4 class="text-xl font-semibold mb-6">Ikuti Kami</h4>
        <div class="flex justify-center gap-5 mb-8">
            <a
                href="{{ $siteSettings['instagram_url'] ?? 'https://instagram.com/komunitasruangberbagi' }}"
                target="_blank"
                rel="noopener noreferrer"
                class="text-white w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition"
                aria-label="Instagram"
            >
                <x-icons.instagram />
            </a>
            <a
                href="{{ $siteSettings['whatsapp_url'] ?? 'https://whatsapp.com/channel/0029VazY3qSFXUuUlnV5VQ0q' }}"
                target="_blank"
                rel="noopener noreferrer"
                class="text-white w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition"
                aria-label="WhatsApp"
            >
                <x-icons.whatsapp />
            </a>
        </div>
        <p class="text-sm text-gray-500 mb-2">© {{ date('Y') }} {{ $siteSettings['footer_copyright'] ?? 'Komunitas Ruang Berbagi. Semua hak dilindungi.' }}</p>
        <div class="flex justify-center gap-4 text-sm text-gray-500">
            <a href="{{ route('privacy') }}" class="hover:text-white transition">Kebijakan Privasi</a>
            <span>|</span>
            <a href="{{ route('terms') }}" class="hover:text-white transition">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>
