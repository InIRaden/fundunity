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

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">

    <!-- Custom Styles -->
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen bg-gray-50">
        @include('layouts.admin.sidebar')

        <!-- Main Content -->
        <div id="mainContent" class="lg:ml-56 w-full lg:w-[calc(100%-224px)] transition-all duration-300 ease-in-out min-h-100vh">
            @include('layouts.admin.header')
            <main class="p-8">
                @yield('admin-content')
            </main>
        </div>
    </div>

    @include('components.admin-modals')

    <!-- JavaScript -->
    <script>
        // Sidebar toggle functionality (desktop collapse)
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleIcon = document.getElementById('toggleIcon');

            if (sidebar.classList.contains('sidebar-collapsed')) {
                sidebar.classList.remove('sidebar-collapsed');
                mainContent.classList.remove('lg:ml-[72px]', 'lg:w-[calc(100%-72px)]');
                mainContent.classList.add('lg:ml-56', 'lg:w-[calc(100%-224px)]');
                toggleIcon.classList.remove('ph-caret-right');
                toggleIcon.classList.add('ph-caret-left');
            } else {
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('lg:ml-56', 'lg:w-[calc(100%-224px)]');
                mainContent.classList.add('lg:ml-[72px]', 'lg:w-[calc(100%-72px)]');
                toggleIcon.classList.remove('ph-caret-left');
                toggleIcon.classList.add('ph-caret-right');
            }
        }

        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            backdrop.classList.add('hidden');
        }

        // Close mobile sidebar when clicking menu items
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeMobileSidebar();
                }
            });
        });
    </script>
</body>
</html>
