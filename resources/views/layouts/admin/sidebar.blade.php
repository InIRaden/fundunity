@php
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
@endphp

<div class="relative">
  <!-- Sidebar -->
  <div id="adminSidebar" class="fixed top-0 left-0 bottom-0 flex flex-col transition-all duration-300 ease-in-out bg-admin-600 text-white rounded-r-3xl w-56 z-40">

    <!-- Logo Area -->
    <div id="sidebarLogo" class="flex items-center shrink-0 mt-4 mb-4 px-5 gap-3 transition-all duration-300 sidebar-logo-open">
      <x-logo class="h-8 w-auto min-w-[32px] transition-all duration-300" containerClass="bg-white/20 text-white rounded-lg" iconClass="text-lg" />
      <span class="text-sm font-bold text-white tracking-tight opacity-90 whitespace-nowrap sidebar-text-show">{{ $siteSettings['site_short_name'] ?? 'FundUnity' }}</span>
    </div>

    <nav class="flex-1 space-y-0.5 px-0 pt-2 pb-2 overflow-y-auto overflow-x-hidden relative hide-scrollbar">
      @foreach($menuItems as $item)
        @php
          $enabled = (string)($siteSettings[$item['key']] ?? '1') === '1';
          $isActive = request()->routeIs($item['route']);
        @endphp

        @if($enabled)
          <a href="{{ route($item['route']) }}" class="sidebar-item relative group flex items-center gap-3 py-2 transition-all duration-150 cursor-pointer {{ $isActive ? 'bg-gray-50 text-admin-600 shadow-sm active-sidebar-item' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            @php
              $iconClass = $isActive ? str_replace('ph ph-', 'ph-fill ph-', $item['icon']) : $item['icon'];
            @endphp
            <i class="{{ $iconClass }} shrink-0 text-[19px] leading-none transition-all"></i>
            <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap sidebar-text-show {{ $isActive ? 'text-admin-600 font-bold' : '' }}">{{ $item['label'] }}</span>
          </a>
        @endif
      @endforeach


      {{-- Menu Manajemen Admin - hanya tampil untuk Super Admin --}}
      @if(Auth::user()?->isSuperAdmin() && (string)($siteSettings['admin_menu_management_enabled'] ?? '1') === '1')
        @php
          $isManagementActive = request()->routeIs('admin.management');
        @endphp
        <a href="{{ route('admin.management') }}" class="sidebar-item relative group flex items-center gap-3 py-2 transition-all duration-150 cursor-pointer {{ $isManagementActive ? 'bg-gray-50 text-admin-600 shadow-sm active-sidebar-item' : 'text-amber-200 hover:bg-white/10 hover:text-white' }}">
          @php
            $iconClass = $isManagementActive ? 'ph-fill ph-crown' : 'ph ph-crown';
          @endphp
          <i class="{{ $iconClass }} shrink-0 text-[19px] leading-none transition-all"></i>
          <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap sidebar-text-show {{ $isManagementActive ? 'text-admin-600 font-bold' : '' }}">Manajemen Admin</span>
        </a>
      @endif
    </nav>

    <!-- Logout -->
    <div class="px-0 pb-4 pt-2 mt-auto border-t border-white/10 relative z-20">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-item logout-button relative group w-full flex items-center gap-3 py-2 text-slate-300 hover:bg-rose-500 hover:text-white transition-all">
          <i class="ph ph-door-open shrink-0 text-[19px] leading-none transition-all"></i>
          <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap sidebar-text-show">Keluar</span>
        </button>
      </form>
    </div>

    <!-- Toggle Button -->
    <button id="sidebarToggle" onclick="toggleSidebar()" class="absolute -right-3 top-6 w-6 h-6 bg-white text-slate-600 hover:text-admin-600 rounded-full flex items-center justify-center transition-all z-50 shadow-sm border border-slate-200">
      <i id="toggleIcon" class="ph ph-caret-right text-[13px] leading-none"></i>
    </button>
  </div>

  <style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Base styles for navigation sidebar items to ensure layout consistency */
    nav .sidebar-item {
      margin-left: 20px !important;
      margin-right: -20px !important;
      padding-left: 16px !important;
      border-top-left-radius: 9999px !important;
      border-bottom-left-radius: 9999px !important;
    }

    /* Style for logout button to align icon vertically with other items */
    .logout-button {
      padding-left: 36px !important;
      margin: 0 !important;
      border-radius: 0 !important;
      width: 100% !important;
    }

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
      margin-left: 0 !important;
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

<style>
  .active-sidebar-item::before {
    content: '';
    position: absolute;
    top: -32px;
    right: 20px;
    width: 32px;
    height: 32px;
    background-color: transparent;
    background-image: radial-gradient(circle at 0 0, transparent 32px, #f9fafb 32.5px);
    pointer-events: none;
  }
  .active-sidebar-item::after {
    content: '';
    position: absolute;
    bottom: -32px;
    right: 20px;
    width: 32px;
    height: 32px;
    background-color: transparent;
    background-image: radial-gradient(circle at 0 100%, transparent 32px, #f9fafb 32.5px);
    pointer-events: none;
  }
</style>
