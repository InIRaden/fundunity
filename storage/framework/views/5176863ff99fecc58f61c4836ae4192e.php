<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(!empty($siteSettings['site_name']) ? $siteSettings['site_name'] : 'FundUnity'); ?> - Admin Panel</title>

    <?php if(!empty($siteSettings['site_logo'])): ?>
        <link rel="icon" href="<?php echo e($siteSettings['site_logo']); ?>" type="image/png">
    <?php else: ?>
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
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
            background: #10b981; /* emerald-500 */
            z-index: 999999;
            transition: width 0.3s ease, opacity 0.3s ease;
            width: 0%;
            opacity: 0;
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
<?php
    $adminThemePreset = (string)($siteSettings['admin_theme_preset'] ?? 'emerald');
    $theme = match($adminThemePreset) {
        'indigo' => ['primary' => 'indigo', 'ring' => 'indigo-500', 'sidebar' => 'indigo-600', 'sidebarHover' => 'indigo-700'],
        'slate'  => ['primary' => 'slate',  'ring' => 'slate-500',  'sidebar' => 'slate-700',  'sidebarHover' => 'slate-800'],
        'rose'   => ['primary' => 'rose',   'ring' => 'rose-500',   'sidebar' => 'rose-600',   'sidebarHover' => 'rose-700'],
        default  => ['primary' => 'emerald', 'ring' => 'emerald-500', 'sidebar' => 'emerald-600', 'sidebarHover' => 'emerald-700'],
    };
?>

<body data-page="<?php echo $__env->yieldContent('body-data',''); ?>" class="font-sans antialiased bg-gray-50">
    <!-- Top Progress Bar -->
    <div id="nprogress-bar"></div>

<script>
  // pass theme to CSS vars
  (function(){
    document.documentElement.style.setProperty('--admin-primary-600', '<?php echo e($theme['sidebar']); ?>');
  })();
</script>

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
    </script>
</body>
</html>
<?php /**PATH D:\coding\fundunity\resources\views/layouts/admin/app.blade.php ENDPATH**/ ?>