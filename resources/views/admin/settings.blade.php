@extends('layouts.admin.app')

@section('admin-content')
@php
  $profile = $profile ?? [];
  $identity = $identity ?? [];
  $payment = $payment ?? [];
  $seo = $seo ?? [];
@endphp

<div class="max-w-6xl mx-auto space-y-6">
  <div id="settingToast" class="hidden items-center gap-3 px-5 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold fixed top-24 right-8 z-[100] shadow-lg">
    <i class="ph ph-check-circle text-base"></i><span id="settingToastText"></span>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
    <div class="lg:col-span-1 space-y-1 bg-white rounded-2xl p-3 border border-slate-100 shadow-sm">
      <button data-tab="profil" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-user text-[18px]"></i>Informasi Profil</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="identitas" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-browser text-[18px]"></i>Identitas Website</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="pembayaran" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-buildings text-[18px]"></i>Rekening Donasi</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="seo" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-flag text-[18px]"></i>SEO & Pemeliharaan</span><i class="ph ph-caret-right text-[15px]"></i></button>
      <button data-tab="keamanan" class="setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border"><span class="flex items-center gap-3"><i class="ph ph-shield-check text-[18px]"></i>Keamanan Akun</span><i class="ph ph-caret-right text-[15px]"></i></button>
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
                <img id="profilePhotoPreview" class="{{ !empty($profile['photoUrl']) ? '' : 'hidden' }} w-full h-full object-cover" alt="Profile" @if(!empty($profile['photoUrl'])) src="{{ $profile['photoUrl'] }}" @endif>
                <i id="profilePhotoIcon" class="ph ph-user text-[36px] text-emerald-600 {{ !empty($profile['photoUrl']) ? 'hidden' : '' }}"></i>
              </div>
              <div class="absolute -bottom-2 -right-2 bg-emerald-600 text-white p-3 rounded-full shadow-md transition-all group-hover:scale-110 w-10 h-10 flex items-center justify-center"><i class="ph ph-camera text-[14px]"></i></div>
            </div>
            <div class="text-center sm:text-left flex-1 space-y-3">
              <div>
                <label class="block text-xs font-bold text-slate-400 mb-1.5">Nama Pengguna</label>
                <input id="displayName" type="text" value="{{ $profile['displayName'] ?? '' }}" class="w-full max-w-sm px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-emerald-500/20">
              </div>
              <div>
                <p class="text-[11px] text-slate-400 font-bold mb-0.5">Email Saat Ini</p>
                <p id="currentEmail" class="text-sm font-bold text-slate-800">{{ $profile['email'] ?? '' }}</p>
              </div>
              <div class="max-w-sm">
                <label class="block text-xs font-bold text-slate-500 mb-2">Ganti Email (opsional)</label>
                <input id="newEmail" type="email" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20" placeholder="adminbaru@domain.com">
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <button id="saveProfileBtn" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Profil</button>
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
                  <img id="logoPreview" class="{{ !empty($identity['logoUrl']) ? '' : 'hidden' }} w-full h-full object-contain" alt="Logo" @if(!empty($identity['logoUrl'])) src="{{ $identity['logoUrl'] }}" @endif>
                  <i id="logoIcon" class="ph ph-image text-[40px] text-slate-300 {{ !empty($identity['logoUrl']) ? 'hidden' : '' }}"></i>
                </div>
                <div class="absolute bg-emerald-600 text-white p-3 rounded-full shadow-md w-10 h-10 flex items-center justify-center"><i class="ph ph-camera text-[14px]"></i></div>
              </div>
            </div>
            <div class="md:col-span-2 space-y-4 justify-center flex flex-col">
              <div>
                <label class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1.5"><i class="ph ph-flag text-[14px] text-emerald-500"></i> Nama Organisasi</label>
                <input id="orgName" type="text" value="{{ $identity['orgName'] ?? '' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20" required>
              </div>
              <div>
                <label class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1.5"><i class="ph ph-tag text-[14px] text-emerald-500"></i> Singkatan / Alias</label>
                <input id="shortName" type="text" value="{{ $identity['shortName'] ?? '' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
              </div>
            </div>
          </div>
          <div class="space-y-1.5 pt-2 border-t border-slate-50">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Tagline Utama</label>
            <input id="tagline" type="text" value="{{ $identity['tagline'] ?? '' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-envelope text-[14px] text-emerald-500"></i> Email Korespondensi</label><input id="identityEmail" type="email" value="{{ $identity['email'] ?? '' }}" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required></div>
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-phone text-[14px] text-emerald-500"></i> WhatsApp / Kontak</label><input id="identityPhone" type="text" value="{{ $identity['phone'] ?? '' }}" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-instagram-logo text-[14px] text-emerald-500"></i> URL Instagram</label><input id="identityInstagram" type="url" value="{{ $identity['instagramUrl'] ?? '' }}" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-map-pin text-[14px] text-emerald-500"></i> Alamat Sekretariat</label><input id="identityAddress" type="text" value="{{ $identity['address'] ?? '' }}" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Identitas</button></div>
        </form>

        <form id="pembayaranPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Rekening Donasi Utama</h3>
            <p class="text-xs text-slate-400">Konfigurasi rekening bank dan upload QRIS global yayasan.</p>
          </div>
          <div class="flex justify-center pt-2">
            <div class="space-y-4 w-full md:w-auto">
              <label class="block text-xs font-bold text-slate-500 mb-1.5">Master QRIS Foundation</label>
              <div class="relative group cursor-pointer" id="qrisTrigger">
                <input id="qrisInput" type="file" accept="image/*" class="hidden">
                <div class="w-full aspect-square md:w-56 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[32px] flex flex-col items-center justify-center p-6 overflow-hidden shadow-inner">
                  <img id="qrisPreview" class="{{ !empty($payment['qrisUrl']) ? '' : 'hidden' }} w-full h-full object-contain" alt="QRIS" @if(!empty($payment['qrisUrl'])) src="{{ $payment['qrisUrl'] }}" @endif>
                  <div id="qrisPlaceholder" class="{{ !empty($payment['qrisUrl']) ? 'hidden' : 'contents' }}">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-emerald-50 mb-3"><i class="ph ph-image text-2xl"></i></div>
                    <p class="text-[10px] font-bold text-slate-400 text-center">Tap untuk Upload QRIS</p>
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-3 p-4 bg-emerald-50/50 border border-emerald-100 rounded-2xl">
                <input id="qrisReady" type="checkbox" {{ !empty($payment['qrisEnabled']) ? 'checked' : '' }} class="w-5 h-5 rounded-lg text-emerald-600 focus:ring-emerald-500 border-emerald-300">
                <div><p class="text-[11px] font-bold text-emerald-800">Aktifkan Metode QRIS</p><p class="text-[10px] text-emerald-600">Scan QRIS akan muncul di setiap modal donasi.</p></div>
              </div>
            </div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Pembayaran</button></div>
        </form>

        <form id="seoPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div><h3 class="text-base font-bold text-slate-900 mb-1">SEO & Pengaturan Global</h3><p class="text-xs text-slate-400">Optimasi pencarian Google dan status operasional website.</p></div>
          <div class="space-y-5">
            <div><label class="block text-xs font-bold text-slate-500 mb-1.5">Meta Description (SEO)</label><textarea id="seoMetaDescription" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm">{{ $seo['metaDescription'] ?? '' }}</textarea></div>
            <div><label class="block text-xs font-bold text-slate-500 mb-1.5">Deskripsi Footer (Tagline)</label><textarea id="seoFooterTagline" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm">{{ $seo['footerTagline'] ?? '' }}</textarea></div>
            <div><label class="block text-xs font-bold text-slate-500 mb-1.5">Copyright Text Footer</label><input id="seoFooterCopyright" type="text" value="{{ $seo['footerCopyright'] ?? '' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div class="p-4 rounded-xl border border-rose-200 bg-rose-50/50 flex items-center justify-between">
              <div><p class="text-sm font-bold text-rose-900">Mode Pemeliharaan (Maintenance)</p><p class="text-xs text-rose-600">Pengunjung tidak dapat mengakses landing page saat aktif.</p></div>
              <button type="button" id="maintenanceToggle" class="px-4 py-1.5 rounded-lg text-[10px] font-bold transition-all">Nonaktif</button>
            </div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Pengaturan</button></div>
        </form>

        <form id="keamananPane" class="hidden setting-pane space-y-6 animate-fade-in">
          <div><h3 class="text-base font-bold text-slate-900 mb-1">Keamanan & Kredensial</h3><p class="text-xs text-slate-400">Pengaturan kata sandi akun untuk akses manajemen admin.</p></div>
          <div id="passError" class="hidden text-xs font-bold text-rose-600 bg-rose-50 border border-rose-100 px-4 py-2 rounded-xl"></div>
          <div class="space-y-4 pt-2">
            <!-- Kata Sandi Saat Ini telah dihapus sesuai permintaan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Kata Sandi Baru</label>
                <div class="relative">
                  <input id="newPass" type="password" class="w-full px-4 py-2 bg-slate-50 border border-emerald-200 rounded-xl text-sm outline-none">
                  <button type="button" id="toggleNewPass" class="absolute right-3 top-2 text-slate-400 hover:text-slate-600"><i class="ph ph-eye text-base"></i></button>
                </div>
              </div>
              <div><label class="block text-xs font-bold text-slate-500 mb-2">Konfirmasi Sandi Baru</label><input id="confirmPass" type="password" class="w-full px-4 py-2 bg-slate-50 border border-emerald-200 rounded-xl text-sm outline-none"></div>
            </div>
            <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Perbarui Password</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  @keyframes fade-in { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
</style>

<script>
  const ss = { active: 'profil', maintenance: @json(!empty($seo['maintenanceMode'])) };
  const csrfToken = @json(csrf_token());
  const endpoints = {
    profile: @json(route('admin.settings.profile.update')),
    identity: @json(route('admin.settings.identity.update')),
    payment: @json(route('admin.settings.payment.update')),
    seo: @json(route('admin.settings.seo.update')),
    security: @json(route('admin.settings.security.update')),
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
      btn.className = 'setting-tab w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-bold border ' + (active ? 'bg-emerald-600 border-emerald-100 text-white shadow-sm' : 'bg-transparent border-transparent text-slate-500 hover:bg-slate-50 hover:text-slate-700');
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
      window.alert(error.message);
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

      const logoFile = document.getElementById('logoInput').files[0];
      if (logoFile) {
        formData.append('logo_file', logoFile);
      }

      const result = await requestForm(endpoints.identity, formData);
      toast(result.message || 'Identitas website berhasil disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      window.alert(error.message);
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
      formData.append('qrisEnabled', document.getElementById('qrisReady').checked ? '1' : '0');

      const qrisFile = document.getElementById('qrisInput').files[0];
      if (qrisFile) {
        formData.append('qris_file', qrisFile);
      }

      const result = await requestForm(endpoints.payment, formData);
      toast(result.message || 'Konfigurasi pembayaran disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      window.alert(error.message);
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
        footerCopyright: document.getElementById('seoFooterCopyright').value,
        footerTagline: document.getElementById('seoFooterTagline').value,
        maintenanceMode: ss.maintenance,
      });

      toast(result.message || 'Pengaturan SEO dan global disimpan.');
      setTimeout(() => window.location.reload(), 800);
    } catch (error) {
      window.alert(error.message);
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
</script>
@endsection
