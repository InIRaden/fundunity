<nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-black bg-opacity-70 py-3 md:py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="https://via.placeholder.com/50x50/22c55e/ffffff?text=KRB" alt="Komunitas Ruang Berbagi" class="h-12 w-12 rounded-lg">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-white leading-tight">Komunitas</span>
                        <span class="text-sm font-bold text-white leading-tight">Ruang Berbagi</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <!-- Siapa Kami Dropdown -->
                <div class="relative group">
                    <button class="text-white hover:text-gray-300 transition flex items-center space-x-1">
                        <span>Siapa Kami</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-t-lg">Tentang KRB</a>
                        <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-b-lg">Hubungi Kami</a>
                    </div>
                </div>

                <!-- Apa Yang Kami Lakukan Dropdown -->
                <div class="relative group">
                    <button class="text-white hover:text-gray-300 transition flex items-center space-x-1">
                        <span>Apa Yang Kami Lakukan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('programs') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-t-lg">Program</a>
                        <a href="{{ route('focus-areas') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-b-lg">Fokus Area</a>
                        <a href="{{ route('focus-areas') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-b-lg">Galeri Lainnya</a>
                    </div>
                </div>

                <!-- Bersama Bergerak Dropdown -->
                <div class="relative group">
                    <button class="text-white hover:text-gray-300 transition flex items-center space-x-1">
                        <span>Bersama Bergerak</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('get-involved') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-b-lg">Terlibat</a>
                        <a href="{{ route('faq') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-t-lg">FAQ</a>
                    </div>
                </div>

                <!-- Donasi Button -->
                <a href="{{ route('get-involved') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium shadow-md">
                    Donasi Sekarang
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button" class="text-white hover:text-blue-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-black">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('about') }}" class="block px-3 py-2 text-white hover:bg-gray-800 rounded">Tentang KRB</a>
            <a href="{{ route('partners') }}" class="block px-3 py-2 text-white hover:bg-gray-800 rounded">Mitra</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-white hover:bg-gray-800 rounded">Hubungi Kami</a>
            <a href="{{ route('programs') }}" class="block px-3 py-2 text-white hover:bg-gray-800 rounded">Program</a>
            <a href="{{ route('focus-areas') }}" class="block px-3 py-2 text-white hover:bg-gray-800 rounded">Fokus Utama</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 text-white hover:bg-gray-800 rounded">FAQ</a>
            <a href="{{ route('get-involved') }}" class="block px-3 py-2 bg-blue-600 text-white rounded-lg">Donasi Sekarang</a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endpush
