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
        <?php echo $__env->make('layouts.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div style="margin-left: <?php echo e($sidebarWidth ?? '256px'); ?>; width: calc(100% - <?php echo e($sidebarWidth ?? '256px'); ?>); transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out; min-height: 100vh;">
            <?php echo $__env->make('layouts.admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <main class="p-8">
                <?php echo $__env->yieldContent('admin-content'); ?>
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.querySelector('.fixed.top-0.left-0');
            const mainContent = document.querySelector('div[style*="margin-left"]');
            const isOpen = sidebar.classList.contains('w-56');

            if (isOpen) {
                sidebar.classList.remove('w-56');
                sidebar.classList.add('w-[72px]');
                mainContent.style.marginLeft = '72px';
                mainContent.style.width = 'calc(100% - 72px)';
            } else {
                sidebar.classList.remove('w-[72px]');
                sidebar.classList.add('w-56');
                mainContent.style.marginLeft = '256px';
                mainContent.style.width = 'calc(100% - 256px)';
            }
        }
    </script>
</body>
</html>
<?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\layouts\admin\app.blade.php ENDPATH**/ ?>