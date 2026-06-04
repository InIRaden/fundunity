@php
    $isLandingHome = request()->routeIs('home')
        || request()->routeIs('landing.home')
        || request()->is('landing')
        || request()->is('landing/');
    $logoUrl = filled($siteSettings['site_logo'] ?? null) ? $siteSettings['site_logo'] : null;
    $hasLogo = filled($logoUrl);
    $brandName = $siteSettings['site_short_name'] ?? 'Nama Singkat';
    $brandSuffix = $siteSettings['site_name_suffix'] ?? 'Nama PT Anda';
    $landingHomeUrl = route('landing.home');

    $navMenus = [
        [
            'title' => 'Siapa Kami',
            'links' => [
                ['label' => 'Tentang Kami', 'url' => route('landing.about')],
                ['label' => 'Struktur Pengurus', 'url' => route('team')],
            ],
        ],
        [
            'title' => 'Program Kami',
            'links' => [
                ['label' => 'Pilar Fokus Program', 'url' => route('landing.focus-areas')],
                ['label' => 'Program Galang Dana', 'url' => route('landing.programs')],
                ['label' => 'Galeri Dokumentasi', 'url' => route('landing.gallery')],
            ],
        ],
        [
            'title' => 'Ikut Terlibat',
            'links' => [
                ['label' => 'FAQ (Tanya Jawab)', 'url' => route('landing.faq')],
                ['label' => 'Pendaftaran Relawan', 'url' => route('landing.get-involved')],
            ],
        ],
    ];
@endphp

<header
    id="landingHeader"
    data-home="{{ $isLandingHome ? 'true' : 'false' }}"
    class="fixed w-full top-0 z-[100] transition-all duration-300 {{ $isLandingHome ? 'bg-transparent py-5' : 'bg-white/90 backdrop-blur-md py-3 shadow-lg border-b border-emerald-100' }}"
>
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <a href="{{ route('landing.home') }}" class="flex items-center gap-3">
            <x-logo class="w-10 h-10 rounded-xl shadow-sm bg-white" containerClass="bg-white/90 border border-slate-200 text-emerald-600" iconClass="text-xl" />
            <span id="landingHeaderBrand" class="font-black tracking-tight text-xl {{ $isLandingHome ? 'text-white' : 'text-slate-900' }}">
                {{ $brandName }}
            </span>
        </a>

        <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
            <a href="{{ route('landing.home') }}" data-nav-link data-nav-link-type="link" class="font-bold text-sm transition-colors {{ $isLandingHome ? 'text-white/80' : 'text-slate-600' }}">
                Beranda
            </a>

            @foreach($navMenus as $index => $menu)
                <div class="relative group">
                    <button type="button" data-nav-link data-nav-link-type="button" class="flex items-center gap-1.5 font-bold text-sm transition-colors {{ $isLandingHome ? 'text-white/80' : 'text-slate-600' }}">
                        {{ $menu['title'] }}
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="transition-transform duration-200 group-hover:rotate-180" height="12" width="12" xmlns="http://www.w3.org/2000/svg"><path d="M216.49,104.49l-80,80a12,12,0,0,1-17,0l-80-80a12,12,0,0,1,17-17L128,159l71.51-71.52a12,12,0,0,1,17,17Z"></path></svg>
                    </button>

                    <div class="absolute top-full left-1/2 -translate-x-1/2 pt-5 transition-all duration-200 w-56 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0">
                        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-2 overflow-hidden flex flex-col gap-1">
                            @foreach($menu['links'] as $link)
                                <a href="{{ $link['url'] }}" class="px-4 py-2.5 text-sm font-bold text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </nav>

        <div class="hidden lg:flex items-center gap-4">
            <a href="{{ route('landing.donate') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-6 py-2.5 rounded-full transition-colors shadow-lg shadow-emerald-500/20">
                Donasi Sekarang
            </a>
        </div>

        <button
            type="button"
            id="landingMenuToggle"
            class="lg:hidden p-2"
            aria-label="Toggle menu"
            aria-expanded="false"
        >
            <svg id="landingMenuIcon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="{{ $isLandingHome ? 'text-white' : 'text-slate-900' }}" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M228,128a12,12,0,0,1-12,12H40a12,12,0,0,1,0-24H216A12,12,0,0,1,228,128ZM40,76H216a12,12,0,0,0,0-24H40a12,12,0,0,0,0,24ZM216,180H40a12,12,0,0,0,0,24H216a12,12,0,0,0,0-24Z"></path></svg>
        </button>
    </div>

    <div id="landingMobileMenu" class="absolute top-full left-0 w-full bg-white border-b border-slate-100 shadow-2xl lg:hidden hidden max-h-[85vh] overflow-y-auto animate-fade-in">
        <div class="p-6 flex flex-col gap-6">
            <a href="{{ route('landing.home') }}" class="font-extrabold text-slate-900 text-lg">Beranda</a>

            @foreach($navMenus as $menu)
                <div class="flex flex-col gap-3">
                    <h4 class="font-bold text-slate-400 text-xs">{{ $menu['title'] }}</h4>
                    <div class="flex flex-col gap-3 pl-3 border-l-2 border-slate-100">
                        @foreach($menu['links'] as $link)
                            <a href="{{ $link['url'] }}" class="font-bold text-slate-700 hover:text-emerald-600">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex flex-col gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('landing.donate') }}" class="w-full py-3 text-center font-bold text-white bg-emerald-500 rounded-xl shadow-lg shadow-emerald-500/20">Donasi Sekarang</a>
            </div>
        </div>
    </div>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.getElementById('landingHeader');
        const brand = document.getElementById('landingHeaderBrand');
        const toggle = document.getElementById('landingMenuToggle');
        const icon = document.getElementById('landingMenuIcon');
        const mobileMenu = document.getElementById('landingMobileMenu');
        const isHome = header?.dataset.home === 'true';
        const menuIconPaths = {
            open: 'M228,128a12,12,0,0,1-12,12H40a12,12,0,0,1,0-24H216A12,12,0,0,1,228,128ZM40,76H216a12,12,0,0,0,0-24H40a12,12,0,0,0,0,24ZM216,180H40a12,12,0,0,0,0,24H216a12,12,0,0,0,0-24Z',
            close: 'M205.66,192.34,142.83,128l62.83-64.34a8,8,0,0,0-11.32-11.32L128,116.69,61.66,52.34A8,8,0,0,0,50.34,63.66L113.17,128,50.34,192.34a8,8,0,1,0,11.32,11.32L128,139.31l62.34,64.35a8,8,0,0,0,11.32-11.32Z',
        };

        function setMenuIcon(isOpen) {
            if (!icon) {
                return;
            }

            const path = isOpen ? menuIconPaths.close : menuIconPaths.open;
            icon.innerHTML = `<path d="${path}"></path>`;
        }

        function setHeaderState() {
            if (!header || !brand || !icon) {
                return;
            }

            const shouldBeSolid = !isHome || window.scrollY > 20 || !mobileMenu?.classList.contains('hidden');

            header.classList.toggle('bg-transparent', !shouldBeSolid);
            header.classList.toggle('py-5', !shouldBeSolid);
            header.classList.toggle('bg-white/90', shouldBeSolid);
            header.classList.toggle('py-3', shouldBeSolid);
            header.classList.toggle('shadow-lg', shouldBeSolid);
            header.classList.toggle('border-b', shouldBeSolid);
            header.classList.toggle('border-emerald-100', shouldBeSolid);
            header.classList.toggle('backdrop-blur-md', shouldBeSolid);

            brand.classList.toggle('text-white', !shouldBeSolid);
            brand.classList.toggle('text-slate-900', shouldBeSolid);

            icon.classList.toggle('text-white', !shouldBeSolid);
            icon.classList.toggle('text-slate-900', shouldBeSolid);

            // Update desktop nav link & button colors
            header.querySelectorAll('[data-nav-link]').forEach(function (el) {
                const isButton = el.dataset.navLinkType === 'button';

                // Toggle base color
                el.classList.toggle('text-white/80', !shouldBeSolid);
                el.classList.toggle('text-slate-600', shouldBeSolid);


            });
        }

        function closeMenu() {
            if (!mobileMenu || !toggle || !icon) {
                return;
            }

            mobileMenu.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            setMenuIcon(false);
            setHeaderState();
        }

        if (toggle && mobileMenu && icon) {
            toggle.addEventListener('click', function () {
                const isHidden = mobileMenu.classList.contains('hidden');

                mobileMenu.classList.toggle('hidden');
                toggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                setMenuIcon(isHidden);
                setHeaderState();
            });

            mobileMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeMenu);
            });
        }

        window.addEventListener('scroll', setHeaderState, { passive: true });
        setMenuIcon(false);
        setHeaderState();
    });
</script>
@endpush
