<?php
  // Menu items for admin sidebar
  $menuItems = [
    ['route' => 'admin.dashboard', 'icon' => 'ph ph-house', 'label' => 'Dashboard', 'key' => 'admin_menu_dashboard_enabled'],
    ['route' => 'admin.campaign', 'icon' => 'ph ph-megaphone', 'label' => 'Campaign', 'key' => 'admin_menu_campaign_enabled'],
    ['route' => 'admin.keuangantransparansi', 'icon' => 'ph ph-chart-line-up', 'label' => 'Keuangan', 'key' => 'admin_menu_keuangantransparansi_enabled'],
    ['route' => 'admin.databasestakeholder', 'icon' => 'ph ph-users', 'label' => 'Relasi & Bantuan', 'key' => 'admin_menu_databasestakeholder_enabled'],
    ['route' => 'admin.messages', 'icon' => 'ph ph-envelope-open', 'label' => 'Kotak Masuk', 'key' => 'admin_menu_messages_enabled'],
    ['route' => 'admin.gallery', 'icon' => 'ph ph-images-square', 'label' => 'Galeri Aktivitas', 'key' => 'admin_menu_gallery_enabled'],
    ['route' => 'admin.aboutus', 'icon' => 'ph ph-quotes', 'label' => 'Visi & Misi', 'key' => 'admin_menu_aboutus_enabled'],
    ['route' => 'admin.members', 'icon' => 'ph ph-users-three', 'label' => 'Struktur Organisasi', 'key' => 'admin_menu_members_enabled'],
    ['route' => 'admin.focusareas', 'icon' => 'ph ph-crosshair', 'label' => 'Fokus Area', 'key' => 'admin_menu_focusareas_enabled'],
    ['route' => 'admin.imageslider', 'icon' => 'ph ph-slideshow', 'label' => 'Banner Slider', 'key' => 'admin_menu_imageslider_enabled'],
    ['route' => 'admin.partners', 'icon' => 'ph ph-handshake', 'label' => 'Mitra Kami', 'key' => 'admin_menu_partners_enabled'],
    ['route' => 'admin.faqs', 'icon' => 'ph ph-chats-circle', 'label' => 'Tanya Jawab', 'key' => 'admin_menu_faqs_enabled'],
    ['route' => 'admin.legal', 'icon' => 'ph ph-book-open', 'label' => 'Kebijakan & Privasi', 'key' => 'admin_menu_legal_enabled'],
    ['route' => 'admin.settings', 'icon' => 'ph ph-gear-six', 'label' => 'Akun & Sistem', 'key' => 'admin_menu_settings_enabled'],
  ];
?>

<div class="relative">
  <!-- Sidebar -->
  <div id="adminSidebar" class="fixed top-0 left-0 bottom-0 flex flex-col transition-all duration-300 ease-in-out bg-emerald-600 text-white rounded-r-3xl w-56 z-40">
    <!-- Logo Area -->
    <div id="sidebarLogo" class="flex items-center shrink-0 mt-4 mb-4 px-5 gap-3 transition-all duration-300 sidebar-logo-open">
      <?php if (isset($component)) { $__componentOriginal987d96ec78ed1cf75b349e2e5981978f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logo','data' => ['class' => 'h-8 w-auto min-w-[32px] transition-all duration-300','containerClass' => 'bg-white/20 text-white rounded-lg','iconClass' => 'text-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-8 w-auto min-w-[32px] transition-all duration-300','containerClass' => 'bg-white/20 text-white rounded-lg','iconClass' => 'text-lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $attributes = $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $component = $__componentOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
      <span class="text-sm font-bold text-white tracking-tight opacity-90 whitespace-nowrap sidebar-text-show"><?php echo e($siteSettings['site_short_name'] ?? 'FundUnity'); ?></span>
    </div>

    <nav class="flex-1 space-y-0.5 px-3 mt-1 overflow-y-auto overflow-x-hidden relative hide-scrollbar">
      <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $enabled = (string)($siteSettings[$item['key']] ?? '1') === '1';
        ?>

        <?php if($enabled): ?>
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
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


      
      <?php if(Auth::user()?->isSuperAdmin() && (string)($siteSettings['admin_menu_management_enabled'] ?? '1') === '1'): ?>
        <a href="<?php echo e(route('admin.management')); ?>" class="sidebar-item relative group flex items-center gap-3 py-2 transition-all duration-150 cursor-pointer <?php echo e(request()->routeIs('admin.management') ? 'bg-slate-50 text-emerald-600 rounded-l-full rounded-r-none -mr-3 px-4' : 'text-amber-200 hover:bg-emerald-700 hover:text-white rounded-2xl px-4'); ?>">
          <?php if(request()->routeIs('admin.management')): ?>
            <div class="absolute right-0 -top-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at top left, transparent 20px, #f8fafc 0);"></div>
            <div class="absolute right-0 -bottom-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at bottom left, transparent 20px, #f8fafc 0);"></div>
          <?php endif; ?>
          <i class="ph ph-crown shrink-0 text-[19px] leading-none"></i>
          <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap sidebar-text-show <?php echo e(request()->routeIs('admin.management') ? 'text-emerald-600' : ''); ?>">Manajemen Admin</span>
        </a>
      <?php endif; ?>
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
    <button id="sidebarToggle" onclick="toggleSidebar()" class="absolute -right-3 top-8 w-6 h-6 bg-white text-slate-600 hover:text-emerald-600 rounded-full flex items-center justify-center transition-all z-50 shadow-sm border border-slate-200">
      <i id="toggleIcon" class="ph ph-caret-right text-[13px] leading-none"></i>
    </button>
  </div>

  <style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Sidebar collapsed state (Desktop) */
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
      margin-right: 0 !important;
      border-radius: 12px !important;
    }
    #adminSidebar.sidebar-collapsed .sidebar-item .absolute {
      display: none !important;
    }
    #adminSidebar.sidebar-collapsed .sidebar-text-show {
      display: none;
    }
  </style>
</div>
<?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/layouts/admin/sidebar.blade.php ENDPATH**/ ?>