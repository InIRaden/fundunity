<?php
  // Menu items for admin sidebar
  $menuItems = [
    ['route' => 'admin.dashboard', 'icon' => 'ph ph-house', 'label' => 'Dashboard'],
    ['route' => 'admin.campaign', 'icon' => 'ph ph-megaphone', 'label' => 'Campaign'],
    ['route' => 'admin.keuangantransparansi', 'icon' => 'ph ph-chart-line-up', 'label' => 'Keuangan'],
    ['route' => 'admin.databasestakeholder', 'icon' => 'ph ph-users', 'label' => 'Relasi & Bantuan'],
    ['route' => 'admin.messages', 'icon' => 'ph ph-envelope-open', 'label' => 'Kotak Masuk'],
    ['route' => 'admin.gallery', 'icon' => 'ph ph-images-square', 'label' => 'Galeri Aktivitas'],
    ['route' => 'admin.aboutus', 'icon' => 'ph ph-quotes', 'label' => 'Visi & Misi'],
    ['route' => 'admin.members', 'icon' => 'ph ph-users-three', 'label' => 'Struktur Organisasi'],
    ['route' => 'admin.focusareas', 'icon' => 'ph ph-crosshair', 'label' => 'Fokus Area'],
    ['route' => 'admin.imageslider', 'icon' => 'ph ph-slideshow', 'label' => 'Banner Slider'],
    ['route' => 'admin.partners', 'icon' => 'ph ph-handshake', 'label' => 'Mitra Kami'],
    ['route' => 'admin.faqs', 'icon' => 'ph ph-chats-circle', 'label' => 'Tanya Jawab'],
    ['route' => 'admin.legal', 'icon' => 'ph ph-book-open', 'label' => 'Kebijakan & Privasi'],
    ['route' => 'admin.settings', 'icon' => 'ph ph-gear-six', 'label' => 'Akun & Sistem'],
  ];
?>

<div class="relative">
  <!-- Sidebar -->
  <div id="adminSidebar" class="fixed top-0 left-0 bottom-0 flex flex-col transition-all duration-300 ease-in-out bg-emerald-600 text-white rounded-r-3xl w-56 lg:w-56 -left-56 lg:left-0 lg:translate-x-0 translate-x-0" style="z-index: 40;">
    <!-- Logo Area -->
    <div id="sidebarLogo" class="flex items-center shrink-0 mt-4 mb-4 px-5 gap-3 transition-all duration-300 sidebar-logo-open">
      <img src="<?php echo e($siteSettings['site_logo'] ?? asset('images/Logo.png')); ?>" alt="FundUnity" class="object-contain transition-all duration-300 h-8 w-auto" />
      <span class="text-sm font-bold text-white tracking-tight opacity-90 whitespace-nowrap sidebar-text-show">FundUnity</span>
    </div>

    <!-- Nav Items -->
    <nav class="flex-1 space-y-0.5 px-3 mt-1 overflow-y-auto overflow-x-hidden relative hide-scrollbar">
      <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route($item['route'])); ?>" class="sidebar-item relative group flex items-center gap-3 py-2 transition-all duration-150 cursor-pointer <?php echo e(request()->routeIs($item['route']) ? 'bg-slate-50 text-emerald-600 rounded-l-full rounded-r-none -mr-3 px-4' : 'text-slate-300 hover:bg-emerald-700 hover:text-white rounded-2xl px-4'); ?>">
          <?php if(request()->routeIs($item['route'])): ?>
            <!-- Top Inverted Curve -->
            <div class="absolute right-0 -top-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at top left, transparent 20px, #f8fafc 0);"></div>
            <!-- Bottom Inverted Curve -->
            <div class="absolute right-0 -bottom-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at bottom left, transparent 20px, #f8fafc 0);"></div>
          <?php endif; ?>
          <i class="<?php echo e($item['icon']); ?> shrink-0 text-[19px] leading-none"></i>
          <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap sidebar-text-show <?php echo e(request()->routeIs($item['route']) ? 'text-emerald-600' : ''); ?>"><?php echo e($item['label']); ?></span>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <!-- Logout -->
    <div class="px-3 pb-4 pt-2 mt-auto">
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="sidebar-item relative group w-full flex items-center gap-3 py-2.5 rounded-xl text-slate-200 hover:bg-rose-600/10 hover:text-rose-400 transition-all px-4">
          <i class="ph ph-door-open shrink-0 text-[19px] leading-none"></i>
          <span class="text-[13px] font-semibold tracking-wide sidebar-text-show">Keluar</span>
        </button>
      </form>
    </div>

    <!-- Toggle Button -->
    <button id="sidebarToggle" onclick="toggleSidebar()" class="absolute -right-3 top-8 w-6 h-6 bg-white text-slate-600 hover:text-emerald-600 rounded-full flex items-center justify-center transition-all lg:flex hidden">
      <i id="toggleIcon" class="ph ph-caret-left text-[13px] leading-none"></i>
    </button>
  </div>

  <!-- Mobile Menu Toggle (visible only on mobile) -->
  <button id="sidebarMobileToggle" onclick="toggleMobileSidebar()" class="fixed bottom-6 right-6 w-12 h-12 bg-emerald-600 text-white rounded-full flex items-center justify-center lg:hidden z-50 shadow-lg">
    <i class="ph ph-list text-[20px]"></i>
  </button>

  <!-- Mobile Sidebar Backdrop -->
  <div id="sidebarBackdrop" onclick="closeMobileSidebar()" class="fixed inset-0 bg-black/50 lg:hidden hidden z-30"></div>

  <style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Sidebar collapsed state */
    #adminSidebar.sidebar-collapsed {
      width: 72px;
    }

    #adminSidebar.sidebar-collapsed #sidebarLogo {
      padding: 0;
      justify-content: center;
    }

    #adminSidebar.sidebar-collapsed .sidebar-item {
      justify-content: center !important;
      padding-left: 0 !important;
      padding-right: 0 !important;
    }

    #adminSidebar.sidebar-collapsed .sidebar-text-show {
      display: none;
    }
  </style>
</div>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/layouts/admin/sidebar.blade.php ENDPATH**/ ?>