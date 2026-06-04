<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?> - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">

    <!-- Custom Styles -->
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body data-page="<?php echo $__env->yieldContent('body-data',''); ?>" class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen bg-gray-50">
        <?php echo $__env->make('layouts.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
            <?php echo $__env->make('layouts.admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <?php if(isset($siteSettings['maintenance_mode']) && $siteSettings['maintenance_mode'] === '1'): ?>
            <div class="bg-rose-500 text-white px-4 py-3 text-center text-sm font-bold flex items-center justify-center gap-2 shadow-sm relative z-20">
                <i class="ph ph-warning-circle text-lg animate-pulse"></i>
                Website Publik sedang dalam Mode Pemeliharaan (Maintenance). Pengunjung tidak dapat mengakses halaman utama.
            </div>
            <?php endif; ?>

            <main class="p-8">
                <div class="w-full">
                    <?php echo $__env->yieldContent('admin-content'); ?>
                </div>
            </main>
        </div>
    </div>

    <?php echo $__env->make('components.admin-modals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
<?php /**PATH D:\coding\fundunity\resources\views/layouts/admin/app.blade.php ENDPATH**/ ?>