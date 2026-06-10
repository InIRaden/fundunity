<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($siteSettings['site_name']) ? $siteSettings['site_name'] : 'FundUnity' }} - Admin Panel</title>

    @if(!empty($siteSettings['site_logo']))
        <link rel="icon" href="{{ $siteSettings['site_logo'] }}" type="image/png">
    @else
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    @endif

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#022c22">
    @if(!empty($siteSettings['site_logo']))
        <link rel="apple-touch-icon" href="{{ $siteSettings['site_logo'] }}">
    @else
        <link rel="apple-touch-icon" href="/images/Logo.png">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">

    <!-- Custom Styles -->
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Top Progress Bar for Navigation */
        #nprogress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: rgb(var(--color-admin-500));
            z-index: 999999;
            transition: width 0.3s ease, opacity 0.3s ease;
            width: 0%;
            opacity: 0;
        }

        /* Override Checkbox styles from Tailwind Forms (default is blue) */
        [type='checkbox'] {
            color: rgb(var(--color-admin-600)) !important;
        }
        [type='checkbox']:focus {
            --tw-ring-color: rgb(var(--color-admin-500) / 0.2) !important;
        }
    </style>

    @php
        $adminThemePreset = (string)($siteSettings['admin_theme_preset'] ?? 'emerald');
        $themeRgbs = [
            'emerald' => [
                '50' => '236 253 245', '100' => '209 250 229', '200' => '167 243 208', '300' => '110 231 183', '400' => '52 211 153',
                '500' => '16 185 129', '600' => '5 150 105', '700' => '4 120 87', '800' => '6 95 70', '900' => '6 78 59', '950' => '2 44 34'
            ],
            'indigo' => [
                '50' => '238 242 255', '100' => '224 231 255', '200' => '199 210 254', '300' => '165 180 252', '400' => '129 140 248',
                '500' => '99 102 241', '600' => '79 70 229', '700' => '67 56 202', '800' => '55 48 163', '900' => '49 46 129', '950' => '30 27 75'
            ],
            'slate' => [
                '50' => '248 250 252', '100' => '241 245 249', '200' => '226 232 240', '300' => '203 213 225', '400' => '148 163 184',
                '500' => '100 116 139', '600' => '71 85 105', '700' => '51 65 85', '800' => '30 41 59', '900' => '15 23 42', '950' => '2 6 23'
            ],
            'rose' => [
                '50' => '255 241 242', '100' => '255 228 230', '200' => '254 205 211', '300' => '253 164 175', '400' => '251 113 133',
                '500' => '244 63 94', '600' => '225 29 72', '700' => '190 18 60', '800' => '159 18 57', '900' => '136 19 55', '950' => '76 5 25'
            ]
        ];
        $activeTheme = $themeRgbs[$adminThemePreset] ?? $themeRgbs['emerald'];
    @endphp

    <style>
        :root {
            @foreach($activeTheme as $shade => $rgb)
            --color-admin-{{ $shade }}: {{ $rgb }};
            @endforeach
        }
    </style>

    <script>
        window.emptyTableRow = function(colspan, message = 'Tidak ada data ditemukan.') {
            return `<tr><td colspan="${colspan}" class="py-20 text-center text-slate-400"><div class="flex flex-col items-center justify-center gap-3"><i class="ph ph-info text-[32px] text-slate-300"></i><p>${message}</p></div></td></tr>`;
        };

        window.emptyGridItem = function(message = 'Tidak ada data ditemukan.') {
            return `<div class="col-span-full py-20 text-center text-slate-400"><div class="flex flex-col items-center justify-center gap-3"><i class="ph ph-info text-[32px] text-slate-300"></i><p>${message}</p></div></div>`;
        };
    </script>
</head>
@php
    $adminThemePreset = (string)($siteSettings['admin_theme_preset'] ?? 'emerald');
    $theme = match($adminThemePreset) {
        'indigo' => ['primary' => 'indigo', 'ring' => 'indigo-500', 'sidebar' => 'indigo-600', 'sidebarHover' => 'indigo-700'],
        'slate'  => ['primary' => 'slate',  'ring' => 'slate-500',  'sidebar' => 'slate-700',  'sidebarHover' => 'slate-800'],
        'rose'   => ['primary' => 'rose',   'ring' => 'rose-500',   'sidebar' => 'rose-600',   'sidebarHover' => 'rose-700'],
        default  => ['primary' => 'emerald', 'ring' => 'admin-500', 'sidebar' => 'admin-600', 'sidebarHover' => 'admin-700'],
    };
@endphp

<body data-page="@yield('body-data','')" class="font-sans antialiased bg-gray-50">
    <!-- Top Progress Bar -->
    <div id="nprogress-bar"></div>

<script>
  // pass theme to CSS vars
  (function(){
    document.documentElement.style.setProperty('--admin-primary-600', '{{ $theme['sidebar'] }}');
  })();
</script>

    <div class="min-h-screen bg-gray-50">
        @include('layouts.admin.sidebar')

        <!-- Main Content -->
        <div id="mainContent" class="transition-all duration-300 ease-in-out min-h-screen">
            <script>
                // Initialize sidebar state before paint to prevent flicker
                (function() {
                    const isDesktop = window.innerWidth >= 1024;
                    const savedState = localStorage.getItem('sidebarState');
                    let isCollapsed = false;

                    if (savedState) {
                        isCollapsed = savedState === 'collapsed';
                    } else {
                        isCollapsed = !isDesktop;
                    }

                    const sidebar = document.getElementById('adminSidebar');
                    const mainContent = document.getElementById('mainContent');
                    const toggleIcon = document.getElementById('toggleIcon');

                    // Disable transitions temporarily
                    sidebar.style.transition = 'none';
                    mainContent.style.transition = 'none';

                    if (isCollapsed) {
                        sidebar.classList.add('sidebar-collapsed');
                        mainContent.style.marginLeft = '72px';
                        mainContent.style.width = 'calc(100% - 72px)';
                        if(toggleIcon) {
                            toggleIcon.classList.remove('ph-caret-left');
                            toggleIcon.classList.add('ph-caret-right');
                        }
                    } else {
                        sidebar.classList.remove('sidebar-collapsed');
                        mainContent.style.marginLeft = '224px';
                        mainContent.style.width = 'calc(100% - 224px)';
                        if(toggleIcon) {
                            toggleIcon.classList.remove('ph-caret-right');
                            toggleIcon.classList.add('ph-caret-left');
                        }
                    }

                    // Re-enable transitions
                    setTimeout(() => {
                        sidebar.style.transition = '';
                        mainContent.style.transition = '';
                    }, 50);
                })();
            </script>
            @include('layouts.admin.header')

            @if(isset($siteSettings['maintenance_mode']) && $siteSettings['maintenance_mode'] === '1')
            <div class="bg-rose-500 text-white px-4 py-3 text-center text-sm font-bold flex items-center justify-center gap-2 shadow-sm relative z-20">
                <i class="ph ph-warning-circle text-lg animate-pulse"></i>
                Website Publik sedang dalam Mode Pemeliharaan (Maintenance). Pengunjung tidak dapat mengakses halaman utama.
            </div>
            @endif

            <main class="p-8">
                <div class="w-full">
                    @yield('admin-content')
                </div>
            </main>
        </div>
    </div>

    @include('components.admin-modals')

    <!-- JavaScript -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleIcon = document.getElementById('toggleIcon');

            if (sidebar.classList.contains('sidebar-collapsed')) {
                sidebar.classList.remove('sidebar-collapsed');
                mainContent.style.marginLeft = '224px';
                mainContent.style.width = 'calc(100% - 224px)';
                if(toggleIcon) {
                    toggleIcon.classList.remove('ph-caret-right');
                    toggleIcon.classList.add('ph-caret-left');
                }
                localStorage.setItem('sidebarState', 'expanded');
            } else {
                sidebar.classList.add('sidebar-collapsed');
                mainContent.style.marginLeft = '72px';
                mainContent.style.width = 'calc(100% - 72px)';
                if(toggleIcon) {
                    toggleIcon.classList.remove('ph-caret-left');
                    toggleIcon.classList.add('ph-caret-right');
                }
                localStorage.setItem('sidebarState', 'collapsed');
            }
        }
        // Top progress bar on link navigation
        document.addEventListener('DOMContentLoaded', () => {
            const pbar = document.getElementById('nprogress-bar');
            if (pbar) {
                document.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', (e) => {
                        const href = link.getAttribute('href');
                        const target = link.getAttribute('target');
                        // Only trigger if it's a real internal navigation link
                        if (href && !href.startsWith('#') && !href.startsWith('javascript') && target !== '_blank' && href !== window.location.href) {
                            pbar.style.opacity = '1';
                            pbar.style.width = '30%';
                            setTimeout(() => { pbar.style.width = '70%'; }, 150);
                        }
                    });
                });
            }
        });

        // PWA Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    })
                    .catch(err => {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }
    </script>
</body>
</html>
