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
    ['route' => 'admin.settings', 'icon' => 'ph ph-gear-six', 'label' => 'Akun & Sistem'],
  ];
@endphp

<div class="relative">
  <!-- Sidebar -->
  <div class="fixed top-0 left-0 bottom-0 flex flex-col transition-all duration-300 ease-in-out bg-emerald-600 text-white rounded-r-3xl {{ $isSidebarOpen ?? true ? 'w-56' : 'w-[72px]' }}" style="z-index: 40;">
    <!-- Logo Area -->
    <div class="flex items-center shrink-0 mt-6 mb-8 {{ $isSidebarOpen ?? true ? 'px-5 gap-3' : 'justify-center' }}">
      <img src="{{ asset('images/Logo.png') }}" alt="FundUnity" class="object-contain transition-all duration-300 {{ $isSidebarOpen ?? true ? 'h-9 w-auto' : 'h-9 w-9 rounded-xl' }}" />
      @if($isSidebarOpen ?? true)
        <span class="text-sm font-bold text-white tracking-tight opacity-90 whitespace-nowrap">FundUnity</span>
      @endif
    </div>

    <!-- Nav Items -->
    <nav class="flex-1 space-y-1 px-3 mt-2 overflow-y-auto overflow-x-hidden relative hide-scrollbar">
      @foreach($menuItems as $item)
        <a href="{{ route($item['route']) }}" class="relative group flex items-center gap-3 py-2.5 transition-all duration-150 cursor-pointer {{ request()->routeIs($item['route']) ? 'bg-slate-50 text-emerald-600 rounded-l-full rounded-r-none -mr-3 ' . (($isSidebarOpen ?? true) ? 'pl-4 pr-7' : 'justify-center pl-0 pr-3') : 'text-slate-300 hover:bg-emerald-700 hover:text-white rounded-2xl ' . (($isSidebarOpen ?? true) ? 'px-4' : 'justify-center px-0') }}">
          @if(request()->routeIs($item['route']))
            <!-- Top Inverted Curve -->
            <div class="absolute right-0 -top-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at top left, transparent 20px, #f8fafc 0);"></div>
            <!-- Bottom Inverted Curve -->
            <div class="absolute right-0 -bottom-5 w-5 h-5 bg-transparent pointer-events-none" style="background: radial-gradient(circle at bottom left, transparent 20px, #f8fafc 0);"></div>
          @endif
          <!-- Icon Placeholder: Replace with actual icon or SVG -->
          <i class="{{ $item['icon'] }} shrink-0 text-[19px] leading-none"></i>
          @if($isSidebarOpen ?? true)
            <span class="text-[13px] font-semibold tracking-wide whitespace-nowrap {{ request()->routeIs($item['route']) ? 'text-emerald-600' : '' }}">{{ $item['label'] }}</span>
          @endif
        </a>
      @endforeach
    </nav>

    <!-- Logout -->
    <div class="px-3 pb-6 pt-3 mt-auto">
      <a href="{{ route('logout.confirm') }}" class="relative group w-full flex items-center gap-3 py-2.5 rounded-xl text-slate-200 hover:bg-rose-600/10 hover:text-rose-400 transition-all {{ $isSidebarOpen ?? true ? 'px-4' : 'justify-center px-0' }}">
        <!-- Icon Placeholder -->
        <i class="ph ph-door-open shrink-0 text-[19px] leading-none"></i>
        @if($isSidebarOpen ?? true)
          <span class="text-[13px] font-semibold tracking-wide">Keluar</span>
        @endif
      </a>
    </div>

    <!-- Toggle Button -->
    <button onclick="toggleSidebar()" class="absolute -right-3 top-8 w-6 h-6 bg-white text-slate-600 hover:text-emerald-600 rounded-full flex items-center justify-center transition-all">
      @if($isSidebarOpen ?? true)
        <i class="ph ph-caret-left text-[13px] leading-none"></i>
      @else
        <i class="ph ph-caret-right text-[13px] leading-none"></i>
      @endif
    </button>
  </div>

  <style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</div>
