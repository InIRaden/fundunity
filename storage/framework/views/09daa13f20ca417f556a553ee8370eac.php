<?php $__env->startSection('admin-content'); ?>
<?php
  $profile = $profile ?? [];
  $identity = $identity ?? [];
  $payment = $payment ?? [];
  $seo = $seo ?? [];
?>

<div class="max-w-6xl mx-auto space-y-6">
  <div id="settingToast" class="hidden items-center gap-3 px-5 py-3 bg-admin-50 border border-admin-200 text-admin-700 rounded-xl text-sm font-bold fixed top-24 right-8 z-[100] shadow-lg">
    <i class="ph ph-check-circle text-base"></i><span id="settingToastText"></span>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
    <div class="lg:col-span-1 space-y-1 bg-white rounded-2xl p-3 border border-slate-100 shadow-sm">
      <button data-tab="profil" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-user text-[18px]"></i>Informasi Profil</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="identitas" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-browser text-[18px]"></i>Identitas Website</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="pembayaran" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-qr-code text-[18px]"></i>QRIS Donasi</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="seo" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-flag text-[18px]"></i>SEO & Pemeliharaan</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="keamanan" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-shield-check text-[18px]"></i>Keamanan Akun</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="menu" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-list-checks text-[18px]"></i>Manajemen Menu</span><i class="ph ph-caret-right text-[15px]"></i></button>
    </div>

    <div class="lg:col-span-3">
      <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/30 border border-slate-100 p-8">
        <div id="profilPane" class="setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Informasi Profil Admin</h3>
            <p class="text-xs text-slate-400">Pengaturan data akun administrator dashboard.</p>
          </div>

          <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
            <div class="relative group cursor-pointer" id="profilePhotoTrigger">
              <input id="profilePhotoInput" type="file" accept="image/*" class="hidden">
              <div class="w-24 h-24 rounded-2xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden shadow-sm transition-transform group-hover:scale-105">
                <img id="profilePhotoPreview" class="<?php echo e(!empty($profile['photoUrl']) ? '' : 'hidden'); ?> w-full h-full object-cover" alt="Profile" <?php if(!empty($profile['photoUrl'])): ?> src="<?php echo e($profile['photoUrl']); ?>" <?php endif; ?>>
                <i id="profilePhotoIcon" class="ph ph-user text-[36px] text-admin-600 <?php echo e(!empty($profile['photoUrl']) ? 'hidden' : ''); ?>"></i>
              </div>
              <div class="absolute -bottom-2 -right-2 bg-admin-600 text-white p-3 rounded-full shadow-md transition-all group-hover:scale-110 w-10 h-10 flex items-center justify-center"><i class="ph ph-camera text-[14px]"></i></div>
            </div>
            <div class="text-center sm:text-left flex-1 space-y-3">
              <div>
                <label class="block text-xs font-bold text-slate-400 mb-1.5">Nama Pengguna</label>
                <input id="displayName" type="text" value="<?php echo e($profile['displayName'] ?? ''); ?>" class="w-full max-w-sm px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-admin-500/20">
              </div>
              <div>
                <p class="text-[11px] text-slate-400 font-bold mb-0.5">Email Saat Ini</p>
                <p id="currentEmail" class="text-sm font-bold text-slate-800"><?php echo e($profile['email'] ?? ''); ?></p>
              </div>
              <div class="max-w-sm">
                <label class="block text-xs font-bold text-slate-500 mb-2">Ganti Email (opsional)</label>
                <input id="newEmail" type="email" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20" placeholder="adminbaru@domain.com">
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <button id="saveProfileBtn" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Profil</button>
          </div>
        </div>

        <form id="identitasPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Identitas & Organisasi</h3>
            <p class="text-xs text-slate-400">Kelola nama resmi, logo, dan kontak utama organisasi.</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
              <label class="block text-xs font-bold text-slate-400 mb-1.5">Logo Utama</label>
              <div class="relative group cursor-pointer" id="logoTrigger">
                <input id="logoInput" type="file" accept="image/*" class="hidden">
                <div class="w-full aspect-video sm:aspect-square md:w-40 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center p-4 overflow-hidden shadow-sm">
                  <img id="logoPreview" class="<?php echo e(!empty($identity['logoUrl']) ? '' : 'hidden'); ?> w-full h-full object-contain" alt="Logo" <?php if(!empty($identity['logoUrl'])): ?> src="<?php echo e($identity['logoUrl']); ?>" <?php endif; ?>>
                  <i id="logoIcon" class="ph ph-image text-[40px] text-slate-300 <?php echo e(!empty($identity['logoUrl']) ? 'hidden' : ''); ?>"></i>
                </div>
                <div class="absolute bg-admin-600 text-white p-3 rounded-full shadow-md w-10 h-10 flex items-center justify-center"><i class="ph ph-camera text-[14px]"></i></div>
              </div>
            </div>
            <div class="md:col-span-2 space-y-4 justify-center flex flex-col">
              <div>
                <label class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1.5"><i class="ph ph-flag text-[14px] text-admin-500"></i> Nama Organisasi</label>
                <input id="orgName" type="text" value="<?php echo e($identity['orgName'] ?? ''); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20" required>
              </div>
              <div>
                <label class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1.5"><i class="ph ph-tag text-[14px] text-admin-500"></i> Singkatan / Alias</label>
                <input id="shortName" type="text" value="<?php echo e($identity['shortName'] ?? ''); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
              </div>
            </div>
          </div>
          <div class="space-y-1.5 pt-2 border-t border-slate-50">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Tagline Utama</label>
            <input id="tagline" type="text" value="<?php echo e($identity['tagline'] ?? ''); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
          </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-envelope text-[14px] text-admin-500"></i> Email Korespondensi</label><input id="identityEmail" type="email" value="<?php echo e($identity['email'] ?? ''); ?>" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required></div>
              <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-phone text-[14px] text-admin-500"></i> WhatsApp / Kontak</label><input id="identityPhone" type="text" value="<?php echo e($identity['phone'] ?? ''); ?>" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
              <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-instagram-logo text-[14px] text-admin-500"></i> URL Instagram</label><input id="identityInstagram" type="url" value="<?php echo e($identity['instagramUrl'] ?? ''); ?>" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
              <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-map-pin text-[14px] text-admin-500"></i> Alamat Sekretariat</label><input id="identityAddress" type="text" value="<?php echo e($identity['address'] ?? ''); ?>" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            </div>

            <div class="pt-6 mt-6 border-t border-slate-100">
              <h4 class="text-sm font-bold text-slate-900 mb-4">Teks & Slogan (Landing Page)</h4>
              <div class="space-y-4">
                <div>
                  <label class="block text-xs font-bold text-slate-500 mb-1.5">Slogan Utama (Hero Title)</label>
                  <input id="heroTitle" type="text" value="<?php echo e($identity['heroTitle'] ?? ''); ?>" placeholder="Wujudkan Dampak Nyata, Sinergi Membangun Negeri." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-500 mb-1.5">Deskripsi Slogan (Hero Subtitle)</label>
                  <textarea id="heroSubtitle" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20" placeholder="Lebih dari sekadar platform donasi..."><?php echo e($identity['heroSubtitle'] ?? ''); ?></textarea>
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-500 mb-1.5">Deskripsi Footer (Tagline Bawah)</label>
                  <textarea id="footerTagline" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20"><?php echo e($identity['footerTagline'] ?? ''); ?></textarea>
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-500 mb-1.5">Copyright Text Footer</label>
                  <input id="footerCopyright" type="text" value="<?php echo e($identity['footerCopyright'] ?? ''); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
                </div>
              </div>
            </div>

          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Identitas</button></div>
        </form>

        <form id="pembayaranPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">QRIS Donasi</h3>
            <p class="text-xs text-slate-400">Upload gambar QRIS untuk donatur.</p>
          </div>

          <div class="flex justify-center pt-2">
            <div class="space-y-4 w-full max-w-xs">
              <label class="block text-xs font-bold text-slate-500 mb-1.5">Gambar QRIS</label>
              <div class="relative group cursor-pointer" id="qrisTrigger">
                <input id="qrisInput" type="file" accept="image/*" class="hidden">
                <div class="w-full aspect-square md:w-56 mx-auto bg-slate-50 border-2 border-dashed border-slate-200 rounded-[32px] flex flex-col items-center justify-center p-6 overflow-hidden shadow-inner hover:border-admin-300 transition-colors">
                  <img id="qrisPreview" class="<?php echo e(!empty($payment['qrisUrl']) ? '' : 'hidden'); ?> w-full h-full object-contain" alt="QRIS" <?php if(!empty($payment['qrisUrl'])): ?> src="<?php echo e($payment['qrisUrl']); ?>" <?php endif; ?>>
                  <div id="qrisPlaceholder" class="<?php echo e(!empty($payment['qrisUrl']) ? 'hidden' : 'contents'); ?>">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-admin-600 shadow-sm border border-admin-50 mb-3"><i class="ph ph-qr-code text-2xl"></i></div>
                    <p class="text-[10px] font-bold text-slate-400 text-center">Tap untuk Upload QRIS</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan QRIS</button></div>
        </form>

        <form id="seoPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div><h3 class="text-base font-bold text-slate-900 mb-1">SEO & Pengaturan Global</h3><p class="text-xs text-slate-400">Optimasi pencarian Google dan status operasional website.</p></div>
          <div class="space-y-5">
            <div><label class="block text-xs font-bold text-slate-500 mb-1.5">Meta Description (SEO)</label><textarea id="seoMetaDescription" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"><?php echo e($seo['metaDescription'] ?? ''); ?></textarea></div>
            <div class="p-4 rounded-xl border border-rose-200 bg-rose-50/50 flex items-center justify-between">
              <div><p class="text-sm font-bold text-rose-900">Mode Pemeliharaan (Maintenance)</p><p class="text-xs text-rose-600">Pengunjung tidak dapat mengakses landing page saat aktif.</p></div>
              <button type="button" id="maintenanceToggle" class="px-4 py-1.5 rounded-lg text-[10px] font-bold transition-all">Nonaktif</button>
            </div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Pengaturan</button></div>
        </form>

        <form id="keamananPane" class="hidden setting-pane space-y-6 animate-fade-in">
          <div><h3 class="text-base font-bold text-slate-900 mb-1">Keamanan & Kredensial</h3><p class="text-xs text-slate-400">Pengaturan kata sandi akun untuk akses manajemen admin.</p></div>
          <div id="passError" class="hidden text-xs font-bold text-rose-600 bg-rose-50 border border-rose-100 px-4 py-2 rounded-xl"></div>
          <div class="space-y-4 pt-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Kata Sandi Baru</label>
                <div class="relative">
                  <input id="newPass" type="password" class="w-full px-4 py-2 bg-slate-50 border border-admin-200 rounded-xl text-sm outline-none">
                  <button type="button" id="toggleNewPass" class="absolute right-3 top-2 text-slate-400 hover:text-slate-600"><i class="ph ph-eye text-base"></i></button>
                </div>
              </div>
              <div><label class="block text-xs font-bold text-slate-500 mb-2">Konfirmasi Sandi Baru</label><input id="confirmPass" type="password" class="w-full px-4 py-2 bg-slate-50 border border-admin-200 rounded-xl text-sm outline-none"></div>
            </div>
            <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Perbarui Password</button></div>
          </div>
        </form>

        <div id="menuPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Manajemen Menu</h3>
            <p class="text-xs text-slate-400">Aktifkan atau nonaktifkan menu di sidebar admin dan halaman depan. Hanya Super Admin yang dapat mengakses pengaturan ini.</p>
          </div>

          <!-- Admin Theme Preset -->
          <div class="p-5 rounded-2xl border border-slate-100 bg-slate-50">
            <div class="flex items-center justify-between gap-4">
              <div>
                <h4 class="text-sm font-bold text-slate-800">Tema Warna Admin</h4>
                <p class="text-xs text-slate-500">Pilih preset warna untuk sidebar & tombol admin.</p>
              </div>
              <div class="min-w-[210px]">
                <select id="adminThemePreset" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-admin-500/20">
                  <?php
                    $currentTheme = (string)($siteSettings['admin_theme_preset'] ?? 'emerald');
                  ?>
                  <option value="emerald" <?php echo e($currentTheme === 'emerald' ? 'selected' : ''); ?>>Emerald</option>
                  <option value="indigo" <?php echo e($currentTheme === 'indigo' ? 'selected' : ''); ?>>Indigo</option>
                  <option value="slate" <?php echo e($currentTheme === 'slate' ? 'selected' : ''); ?>>Slate</option>
                  <option value="rose" <?php echo e($currentTheme === 'rose' ? 'selected' : ''); ?>>Rose</option>
                </select>
              </div>
            </div>
          </div>


          <!-- Admin Sidebar Menu -->
          <div class="space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
              <i class="ph ph-sidebar text-admin-600 text-[18px]"></i>
              <h4 class="text-sm font-bold text-slate-700">Sidebar Admin</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <?php
                $adminMenuItems = [
                  ['key' => 'admin_menu_dashboard_enabled', 'label' => 'Dashboard'],
                  ['key' => 'admin_menu_campaign_enabled', 'label' => 'Campaign'],
                  ['key' => 'admin_menu_keuangantransparansi_enabled', 'label' => 'Keuangan'],
                  ['key' => 'admin_menu_databasestakeholder_enabled', 'label' => 'Relasi & Bantuan'],
                  ['key' => 'admin_menu_messages_enabled', 'label' => 'Kotak Masuk'],
                  ['key' => 'admin_menu_gallery_enabled', 'label' => 'Galeri Aktivitas'],
                  ['key' => 'admin_menu_aboutus_enabled', 'label' => 'Visi & Misi'],
                  ['key' => 'admin_menu_members_enabled', 'label' => 'Struktur Organisasi'],
                  ['key' => 'admin_menu_focusareas_enabled', 'label' => 'Fokus Area'],
                  ['key' => 'admin_menu_imageslider_enabled', 'label' => 'Banner Slider'],
                  ['key' => 'admin_menu_partners_enabled', 'label' => 'Mitra Kami'],
                  ['key' => 'admin_menu_faqs_enabled', 'label' => 'Tanya Jawab'],
                  ['key' => 'admin_menu_legal_enabled', 'label' => 'Kebijakan & Privasi'],
                  ['key' => 'admin_menu_settings_enabled', 'label' => 'Akun & Sistem'],
                  ['key' => 'admin_menu_management_enabled', 'label' => 'Manajemen Admin'],
                ];
              ?>
              <?php $__currentLoopData = $adminMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between px-4 py-3 bg-slate-50 rounded-xl border border-slate-100 hover:border-admin-200 transition-colors">
                  <span class="text-xs font-semibold text-slate-700"><?php echo e($item['label']); ?></span>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="menu-toggle sr-only peer" data-key="<?php echo e($item['key']); ?>" value="1" <?php echo e(($siteSettings[$item['key']] ?? '1') === '1' ? 'checked' : ''); ?>>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-admin-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-200 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-admin-600"></div>
                  </label>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>

          <!-- Landing Page Menu -->
          <div class="space-y-4 pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
              <i class="ph ph-browser text-admin-600 text-[18px]"></i>
              <h4 class="text-sm font-bold text-slate-700">Menu Halaman Depan</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <?php
                $landingMenuItems = [
                  ['key' => 'landing_menu_home_enabled', 'label' => 'Beranda'],
                  ['key' => 'landing_menu_about_enabled', 'label' => 'Tentang Kami'],
                  ['key' => 'landing_menu_team_enabled', 'label' => 'Struktur Pengurus'],
                  ['key' => 'landing_menu_focus_areas_enabled', 'label' => 'Pilar Fokus Program'],
                  ['key' => 'landing_menu_programs_enabled', 'label' => 'Program Galang Dana'],
                  ['key' => 'landing_menu_gallery_enabled', 'label' => 'Galeri Dokumentasi'],
                  ['key' => 'landing_menu_faq_enabled', 'label' => 'FAQ (Tanya Jawab)'],
                  ['key' => 'landing_menu_get_involved_enabled', 'label' => 'Pendaftaran Relawan'],
                  ['key' => 'landing_menu_donate_enabled', 'label' => 'Tombol Donasi'],
                ];
              ?>
              <?php $__currentLoopData = $landingMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between px-4 py-3 bg-slate-50 rounded-xl border border-slate-100 hover:border-admin-200 transition-colors">
                  <span class="text-xs font-semibold text-slate-700"><?php echo e($item['label']); ?></span>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="menu-toggle sr-only peer" data-key="<?php echo e($item['key']); ?>" value="1" <?php echo e(($siteSettings[$item['key']] ?? '1') === '1' ? 'checked' : ''); ?>>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-admin-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-200 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-admin-600"></div>
                  </label>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>

          <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="button" id="saveMenuBtn" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Pengaturan Menu</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  @keyframes fade-in { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
</style>

<script>
  const ss = { active: 'profil', maintenance: <?php echo json_encode(!empty($seo['maintenanceMode']), 15, 512) ?> };
  const csrfToken = <?php echo json_encode(csrf_token(), 15, 512) ?>;
  const endpoints = {
    profile: <?php echo json_encode(route('admin.settings.profile.update'), 15, 512) ?>,
    identity: <?php echo json_encode(route('admin.settings.identity.update'), 15, 512) ?>,
    payment: <?php echo json_encode(route('admin.settings.payment.update'), 15, 512) ?>,
    seo: <?php echo json_encode(route('admin.settings.seo.update'), 15, 512) ?>,
    security: <?php echo json_encode(route('admin.settings.security.update'), 15, 512) ?>,
    menu: <?php echo json_encode(route('admin.settings.menu.update'), 15, 512) ?>,
  };

  function toast(msg) {
    document.getElementById('settingToastText').textContent = msg;
    const t = document.getElementById('settingToast');
    t.classList.remove('hidden');
    t.classList.add('flex');
    setTimeout(() => t.classList.add('hidden'), 3000);
    setTimeout(() => t.classList.remove('flex'), 3000);
  }

  function setButtonState(button, isActive, label) {
    if (!button) {
      return;
    }
    button.disabled = !isActive;
    button.classList.toggle('opacity-70', !isActive);
    button.classList.toggle('cursor-not-allowed', !isActive);
    if (label) {
      button.textContent = label;
    }
  }

  function setMaintenanceButton() {
    const btn = document.getElementById('maintenanceToggle');
    btn.textContent = ss.maintenance ? 'Aktif' : 'Nonaktif';
    btn.className = 'px-4 py-1.5 rounded-lg text-[10px] font-bold transition-all ' + (ss.maintenance ? 'bg-rose-600 text-white shadow-md' : 'bg-white border border-rose-200 text-rose-500 hover:bg-rose-50');
  }

  function syncTabs() {
    document.querySelectorAll('.setting-tab').forEach((btn) => {
      const tab = btn.getAttribute('data-tab');
      const active = tab === ss.active;
      btn.className = 'setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border ' + (active ? 'bg-admin-600 border-admin-100 text-white shadow-sm' : 'bg-transparent border-transparent text-slate-500 hover:bg-slate-50 hover:text-slate-700');
      btn.querySelector('i:last-child').style.display = active ? 'inline-block' : 'none';
      document.getElementById(tab + 'Pane').classList.toggle('hidden', !active);
    });
  }

  function readImage(input, imgId, iconId, placeholderId) {
    const f = input.files && input.files[0];
    if (!f) return;
    const url = URL.createObjectURL(f);
    const img = document.getElementById(imgId);
    img.src = url;
    img.classList.remove('hidden');
    if (iconId) document.getElementById(iconId).classList.add('hidden');
    if (placeholderId) document.getElementById(placeholderId).classList.add('hidden');
  }

  async function requestJson(url, payload) {
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload),
    });

    const result = await response.json().catch(() => ({}));
    if (!response.ok) {
      if (response.status === 419) {
        throw new Error('Sesi Anda telah habis (CSRF token kadaluwarsa). Silakan muat ulang (refresh) halaman.');
      }
      const firstValidation = result.errors ? Object.values(result.errors)[0]?.[0] : null;
      throw new Error(firstValidation || result.message || 'Request gagal diproses.');
    }

    return result;
  }

  async function requestForm(url, formData) {
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: formData,
    });

    const result = await response.json().catch(() => ({}));
    if (!response.ok) {
      if (response.status === 419) {
        throw new Error('Sesi Anda telah habis (CSRF token kadaluwarsa). Silakan muat ulang (refresh) halaman.');
      }
      const firstValidation = result.errors ? Object.values(result.errors)[0]?.[0] : null;
      throw new Error(firstValidation || result.message || 'Request gagal diproses.');
    }

    return result;
  }

  document.querySelectorAll('.setting-tab').forEach((btn) => btn.addEventListener('click', function () { ss.active = this.getAttribute('data-tab'); syncTabs(); }));

  document.getElementById('profilePhotoTrigger').addEventListener('click', () => document.getElementById('profilePhotoInput').click());
  document.getElementById('profilePhotoInput').addEventListener('change', function () { readImage(this, 'profilePhotoPreview', 'profilePhotoIcon'); });
  document.getElementById('logoTrigger').addEventListener('click', () => document.getElementById('logoInput').click());
  document.getElementById('logoInput').addEventListener('change', function () { readImage(this, 'logoPreview', 'logoIcon'); });
  document.getElementById('qrisTrigger').addEventListener('click', () => document.getElementById('qrisInput').click());
  document.getElementById('qrisInput').addEventListener('change', function () { readImage(this, 'qrisPreview', null, 'qrisPlaceholder'); });

  document.getElementById('saveProfileBtn').addEventListener('click', async function () {
    const button = this;
    setButtonState(button, false, 'Menyimpan...');
    try {
      const formData = new FormData();
      formData.append('displayName', document.getElementById('displayName').value);
      formData.append('email', document.getElementById('newEmail').value || document.getElementById('currentEmail').textContent.trim());

      const photo = document.getElementById('profilePhotoInput').files[0];
      if (photo) {
        formData.append('photo_file', photo);
      }

      const result = await requestForm(endpoints.profile, formData);
      document.getElementById('currentEmail').textContent = result.data?.email || formData.get('email');
      document.getElementById('newEmail').value = '';
      toast(result.message || 'Profil admin berhasil diperbarui.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      if (typeof customAlert === 'function') customAlert('Kesalahan', error.message, 'error'); else alert(error.message);
    } finally {
      setButtonState(button, true, 'Simpan Profil');
    }
  });

  document.getElementById('identitasPane').addEventListener('submit', async function (e) {
    e.preventDefault();
    const button = this.querySelector('button[type="submit"]');
    setButtonState(button, false, 'Menyimpan...');

    try {
      const formData = new FormData();
      formData.append('orgName', document.getElementById('orgName').value);
      formData.append('shortName', document.getElementById('shortName').value);
      formData.append('tagline', document.getElementById('tagline').value);
      formData.append('email', document.getElementById('identityEmail').value);
      formData.append('phone', document.getElementById('identityPhone').value);
      formData.append('instagramUrl', document.getElementById('identityInstagram').value);
      formData.append('address', document.getElementById('identityAddress').value);
      
      formData.append('heroTitle', document.getElementById('heroTitle').value);
      formData.append('heroSubtitle', document.getElementById('heroSubtitle').value);
      formData.append('footerTagline', document.getElementById('footerTagline').value);
      formData.append('footerCopyright', document.getElementById('footerCopyright').value);

      const logoFile = document.getElementById('logoInput').files[0];
      if (logoFile) {
        formData.append('logo_file', logoFile);
      }

      const result = await requestForm(endpoints.identity, formData);
      toast(result.message || 'Identitas website berhasil disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      if (typeof customAlert === 'function') customAlert('Kesalahan', error.message, 'error'); else alert(error.message);
    } finally {
      setButtonState(button, true, 'Simpan Identitas');
    }
  });

  document.getElementById('pembayaranPane').addEventListener('submit', async function (e) {
    e.preventDefault();
    const button = this.querySelector('button[type="submit"]');
    setButtonState(button, false, 'Menyimpan...');

    try {
      const formData = new FormData();
      
      const qrisFile = document.getElementById('qrisInput').files[0];
      if (qrisFile) {
        formData.append('qris_file', qrisFile);
      }

      const result = await requestForm(endpoints.payment, formData);
      toast(result.message || 'Konfigurasi pembayaran disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      if (typeof customAlert === 'function') customAlert('Kesalahan', error.message, 'error'); else alert(error.message);
    } finally {
      setButtonState(button, true, 'Simpan Pembayaran');
    }
  });

  document.getElementById('seoPane').addEventListener('submit', async function (e) {
    e.preventDefault();
    const button = this.querySelector('button[type="submit"]');
    setButtonState(button, false, 'Menyimpan...');

    try {
      const result = await requestJson(endpoints.seo, {
        metaDescription: document.getElementById('seoMetaDescription').value,
        maintenanceMode: ss.maintenance,
      });

      toast(result.message || 'Pengaturan SEO dan global disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      if (typeof customAlert === 'function') customAlert('Kesalahan', error.message, 'error'); else alert(error.message);
    } finally {
      setButtonState(button, true, 'Simpan Pengaturan');
    }
  });

  document.getElementById('maintenanceToggle').addEventListener('click', function () {
    ss.maintenance = !ss.maintenance;
    setMaintenanceButton();
  });

  function togglePass(inputId, btnId) {
    const input = document.getElementById(inputId);
    const icon = document.querySelector('#' + btnId + ' i');
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.className = 'ph ' + (input.type === 'password' ? 'ph-eye' : 'ph-eye-slash') + ' text-base';
  }

  document.getElementById('toggleNewPass').addEventListener('click', () => togglePass('newPass', 'toggleNewPass'));

  document.getElementById('keamananPane').addEventListener('submit', async function (e) {
    e.preventDefault();
    const button = this.querySelector('button[type="submit"]');
    const next = document.getElementById('newPass').value;
    const confirm = document.getElementById('confirmPass').value;
    const err = document.getElementById('passError');

    err.classList.add('hidden');

    if (next.length < 8) { err.textContent = 'Kata sandi baru minimal 8 karakter.'; err.classList.remove('hidden'); return; }
    if (next !== confirm) { err.textContent = 'Konfirmasi kata sandi tidak cocok.'; err.classList.remove('hidden'); return; }

    setButtonState(button, false, 'Menyimpan...');

    try {
      const result = await requestJson(endpoints.security, {
        new_password: next,
        new_password_confirmation: confirm,
      });

      document.getElementById('newPass').value = '';
      document.getElementById('confirmPass').value = '';
      toast(result.message || 'Kata sandi berhasil diperbarui.');
    } catch (error) {
      err.textContent = error.message;
      err.classList.remove('hidden');
    } finally {
      setButtonState(button, true, 'Perbarui Password');
    }
  });

  setMaintenanceButton();
  syncTabs();

  document.getElementById('saveMenuBtn').addEventListener('click', async function () {
    const button = this;
    setButtonState(button, false, 'Menyimpan...');

    try {
      const payload = {};
      // Tema admin
      payload.admin_theme_preset = document.getElementById('adminThemePreset')?.value || 'emerald';

      // ambil checkbox yang memang punya data-key
      document.querySelectorAll('input[type="checkbox"][data-key]').forEach(function (toggle) {
        payload[toggle.dataset.key] = toggle.checked ? '1' : '0';
      });


      const result = await requestJson(endpoints.menu, payload);
      toast(result.message || 'Pengaturan menu berhasil disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      if (typeof customAlert === 'function') customAlert('Kesalahan', error.message, 'error'); else alert(error.message);
    } finally {
      setButtonState(button, true, 'Simpan Pengaturan Menu');
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\coding\fundunity\resources\views/admin/settings.blade.php ENDPATH**/ ?>