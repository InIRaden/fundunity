@php
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
@endphp

<div class="relative">
  <!-- Sidebar -->
  <div id="adminSidebar" class="fixed top-0 left-0 bottom-0 flex flex-col transition-all duration-300 ease-in-out bg-emerald-600 text-white rounded-r-3xl w-56 z-40">
    <!-- Logo Area -->
    <div id="sidebarLogo" class="flex items-center shrink-0 mt-4 mb-4 px-5 gap-3 transition-all duration-300 sidebar-logo-open">
      <x-logo class="h-8 w-auto min-w-[32px] transition-all duration-300" containerClass="bg-white/20 text-white rounded-lg" iconClass="text-lg" />
      <span class="text-sm font-bold text-white tracking-tight opacity-90 whitespace-nowrap sidebar-text-show">{{ $siteSettings['site_short_name'] ?? 'FundUnity' }}</span>
    </div>

    <!-- Nav Items -->
    <nav class="flex-1 space-y-0.5 px-3 mt-1 overflow-y-auto overflow-x-hidden relative hide-scrollbar">
      @foreach($menuItems as $item)
        <a href="{{ route($item['route']) }}" class="sidebar-item relative group flex items-center gap-3 py-2 transition-all duration-150 cursor-pointer {{ request()->routeIs($item['route']) ? 'bg-slate-50 text-emerald-600 rounded-l-full rounded-r-none -mr-3 px-4' : 'text-slate-300 hover:bg-emerald-700 hover:text-white rounded-2xl px-4' }}">
          @if(request()->routeIs($item['route']))
            <!-- Top Inverted Curve -->
            <div class="absolute right-0 -top-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at top left, transparent 20px, #f8fafc 0);"></div>
            <!-- Bottom Inverted Curve -->
            <div class="absolute right-0 -bottom-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at bottom left, transparent 20px, #f8fafc 0);"></div>
          @endif
          <i class="{{ $item['icon'] }} shrink-0 text-[19px] leading-none"></i>
          <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap sidebar-text-show {{ request()->routeIs($item['route']) ? 'text-emerald-600' : '' }}">{{ $item['label'] }}</span>
        </a>
      @endforeach
    </nav>

    <!-- Logout -->
    <div class="px-3 pb-4 pt-2 mt-auto">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
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
