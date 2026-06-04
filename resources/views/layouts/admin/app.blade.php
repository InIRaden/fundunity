<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">

    <!-- Custom Styles -->
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body data-page="@yield('body-data','')" class="font-sans antialiased bg-gray-50">
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
    </script>
</body>
</html>
