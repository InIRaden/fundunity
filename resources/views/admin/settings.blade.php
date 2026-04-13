@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6">
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
            <p class="text-xs text-slate-400">Pengaturan foto profil dan data kontak utama administrator dashboard.</p>
          </div>

          <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
            <div class="relative group cursor-pointer" id="profilePhotoTrigger">
              <input id="profilePhotoInput" type="file" accept="image/*" class="hidden">
              <div class="w-24 h-24 rounded-2xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden shadow-sm transition-transform group-hover:scale-105">
                <img id="profilePhotoPreview" class="hidden w-full h-full object-cover" alt="Profile">
                <i id="profilePhotoIcon" class="ph ph-user text-[36px] text-emerald-600"></i>
              </div>
              <div class="absolute -bottom-2 -right-2 bg-emerald-600 text-white p-2 rounded-xl shadow-md transition-all group-hover:scale-110"><i class="ph ph-camera text-[14px]"></i></div>
            </div>
            <div class="text-center sm:text-left flex-1 space-y-2">
              <label class="block text-xs font-bold text-slate-400 mb-1.5">Nama Pengguna</label>
              <input id="displayName" type="text" value="Administrator Utama" class="w-full max-w-sm px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-emerald-500/20">
            </div>
          </div>

          <div class="space-y-5 pt-2">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 border border-slate-100 rounded-xl bg-slate-50/50">
              <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-emerald-600"><i class="ph ph-envelope text-[18px]"></i></div>
                <div>
                  <p class="text-[11px] text-slate-400 font-bold mb-0.5">Email Autentikasi</p>
                  <p id="currentEmail" class="text-sm font-bold text-slate-800">admin@fundunity.org</p>
                </div>
              </div>
              <button id="toggleEmailEdit" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-all">Ubah Email</button>
            </div>

            <div id="emailEditWrap" class="hidden p-4 border border-emerald-100 bg-emerald-50/20 rounded-xl animate-fade-in flex-col sm:flex-row items-end gap-4">
              <div class="flex-1 w-full">
                <label class="block text-xs font-bold text-slate-500 mb-2">Masukkan Email Baru</label>
                <input id="newEmail" type="email" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20" placeholder="adminbaru@domain.com">
              </div>
              <button id="saveEmailBtn" class="px-4 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-[14px]"></i> Simpan</button>
            </div>
          </div>
        </div>

        <form id="identitasPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Identitas & Organisasi</h3>
            <p class="text-xs text-slate-400">Kelola nama resmi, logo, dan kontak utama organisasi pada platform.</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
              <label class="block text-xs font-bold text-slate-400 mb-1.5">Logo Utama</label>
              <div class="relative group cursor-pointer" id="logoTrigger">
                <input id="logoInput" type="file" accept="image/*" class="hidden">
                <div class="w-full aspect-video sm:aspect-square md:w-40 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center p-4 overflow-hidden shadow-sm">
                  <img id="logoPreview" class="hidden w-full h-full object-contain" alt="Logo">
                  <i id="logoIcon" class="ph ph-image text-[40px] text-slate-300"></i>
                </div>
                <div class="absolute bg-emerald-600 text-white p-1.5 rounded-xl shadow-md"><i class="ph ph-camera text-[14px]"></i></div>
              </div>
            </div>
            <div class="md:col-span-2 space-y-4 justify-center flex flex-col">
              <div>
                <label class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1.5"><i class="ph ph-flag text-[14px] text-emerald-500"></i> Nama Organisasi</label>
                <input type="text" value="Himpunan Mahasiswa Teknik" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
              </div>
              <div>
                <label class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1.5"><i class="ph ph-tag text-[14px] text-emerald-500"></i> Singkatan / Alias</label>
                <input type="text" value="HMT-Unpad" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
              </div>
            </div>
          </div>
          <div class="space-y-1.5 pt-2 border-t border-slate-50">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Tagline Utama</label>
            <p class="text-[10px] text-slate-400 mb-2">Tagline akan muncul di header landing page dan metadata SEO untuk memperkuat branding.</p>
            <input type="text" value="Sinergi dalam Keberagaman, Unggul dalam Karya." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-envelope text-[14px] text-emerald-500"></i> Email Korespondensi</label><input type="email" value="hmt@unpad.ac.id" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-phone text-[14px] text-emerald-500"></i> WhatsApp / Kontak</label><input type="text" value="08123456789" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-instagram-logo text-[14px] text-emerald-500"></i> Akun Instagram</label><input type="text" value="@hmt_unpad" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div><label class="flex items-center gap-2 text-xs font-bold text-slate-500"><i class="ph ph-map-pin text-[14px] text-emerald-500"></i> Alamat Sekretariat</label><input type="text" value="Gedung Kemahasiswaan Lt. 2, Jatinangor" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Identitas</button></div>
        </form>

        <div id="pembayaranPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Rekening Donasi Utama</h3>
            <p class="text-xs text-slate-400">Konfigurasi rekening bank dan upload QRIS global yayasan.</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-2">
            <div class="space-y-5">
              <div><label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase">Nama Bank</label><input type="text" value="Bank BCA" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
              <div><label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase">Nomor Rekening</label><input type="text" value="8984 1234 5678" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold"></div>
              <div><label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase">Atas Nama</label><input type="text" value="HMT-Unpad" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            </div>
            <div class="space-y-4">
              <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase">Master QRIS Foundation</label>
              <div class="relative group cursor-pointer" id="qrisTrigger">
                <input id="qrisInput" type="file" accept="image/*" class="hidden">
                <div class="w-full aspect-square md:w-56 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[32px] flex flex-col items-center justify-center p-6 overflow-hidden shadow-inner">
                  <img id="qrisPreview" class="hidden w-full h-full object-contain" alt="QRIS">
                  <div id="qrisPlaceholder" class="contents">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-emerald-50 mb-3"><i class="ph ph-image text-2xl"></i></div>
                    <p class="text-[10px] font-bold text-slate-400 text-center uppercase tracking-wider">Tap untuk Upload QRIS</p>
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-3 p-4 bg-emerald-50/50 border border-emerald-100 rounded-2xl">
                <input id="qrisReady" type="checkbox" checked class="w-5 h-5 rounded-lg text-emerald-600 focus:ring-emerald-500 border-emerald-300">
                <div><p class="text-[11px] font-bold text-emerald-800">Aktifkan Metode QRIS</p><p class="text-[10px] text-emerald-600">Scan QRIS akan muncul di setiap modal donasi.</p></div>
              </div>
            </div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button id="savePayBtn" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Pembayaran</button></div>
        </div>

        <div id="seoPane" class="hidden setting-pane space-y-8 animate-fade-in">
          <div><h3 class="text-base font-bold text-slate-900 mb-1">SEO & Pengaturan Global</h3><p class="text-xs text-slate-400">Optimasi pencarian Google dan status operasional website.</p></div>
          <div class="space-y-5">
            <div><label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase">Meta Description (SEO)</label><textarea rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm">Platform donasi dan transparansi keuangan Himpunan Mahasiswa Teknik.</textarea></div>
            <div><label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase">Copyright Text Footer</label><input type="text" value="2024 HMT-Unpad. All rights reserved." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm"></div>
            <div class="p-4 rounded-xl border border-rose-200 bg-rose-50/50 flex items-center justify-between">
              <div><p class="text-sm font-bold text-rose-900">Mode Pemeliharaan (Maintenance)</p><p class="text-xs text-rose-600">Pengunjung tidak dapat mengakses landing page saat aktif.</p></div>
              <button id="maintenanceToggle" class="px-4 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all bg-white border border-rose-200 text-rose-500 hover:bg-rose-50">Nonaktif</button>
            </div>
          </div>
          <div class="flex justify-end pt-4 border-t border-slate-50"><button id="saveSeoBtn" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Simpan Pengaturan</button></div>
        </div>

        <div id="keamananPane" class="hidden setting-pane space-y-6 animate-fade-in">
          <div><h3 class="text-base font-bold text-slate-900 mb-1">Keamanan & Kredensial</h3><p class="text-xs text-slate-400">Pengaturan kata sandi akun untuk akses manajemen admin.</p></div>
          <div id="passError" class="hidden text-xs font-bold text-rose-600 bg-rose-50 border border-rose-100 px-4 py-2 rounded-xl"></div>
          <div class="space-y-4 pt-2">
            <div>
              <label class="block text-xs font-bold text-slate-500 mb-2">Kata Sandi Saat Ini</label>
              <div class="relative max-w-md">
                <input id="currentPass" type="password" class="w-full px-4 py-2 bg-slate-50 border border-emerald-200 rounded-xl text-sm outline-none">
                <button type="button" id="toggleCurrentPass" class="absolute right-3 top-2 text-slate-400 hover:text-slate-600"><i class="ph ph-eye text-base"></i></button>
              </div>
            </div>
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
            <div class="flex justify-end pt-4 border-t border-slate-50"><button id="savePassBtn" class="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 flex items-center gap-1.5"><i class="ph ph-floppy-disk text-base"></i> Perbarui Password</button></div>
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
  const ss = { active: 'profil', maintenance: false, showCurrent: false, showNew: false };

  function toast(msg) {
    document.getElementById('settingToastText').textContent = msg;
    const t = document.getElementById('settingToast');
    t.classList.remove('hidden');
    t.classList.add('flex');
    setTimeout(() => t.classList.add('hidden'), 3000);
    setTimeout(() => t.classList.remove('flex'), 3000);
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

  document.querySelectorAll('.setting-tab').forEach((btn) => btn.addEventListener('click', function () { ss.active = this.getAttribute('data-tab'); syncTabs(); }));

  document.getElementById('profilePhotoTrigger').addEventListener('click', () => document.getElementById('profilePhotoInput').click());
  document.getElementById('profilePhotoInput').addEventListener('change', function () { readImage(this, 'profilePhotoPreview', 'profilePhotoIcon'); });
  document.getElementById('logoTrigger').addEventListener('click', () => document.getElementById('logoInput').click());
  document.getElementById('logoInput').addEventListener('change', function () { readImage(this, 'logoPreview', 'logoIcon'); });
  document.getElementById('qrisTrigger').addEventListener('click', () => document.getElementById('qrisInput').click());
  document.getElementById('qrisInput').addEventListener('change', function () { readImage(this, 'qrisPreview', null, 'qrisPlaceholder'); });

  const emailWrap = document.getElementById('emailEditWrap');
  document.getElementById('toggleEmailEdit').addEventListener('click', function () {
    emailWrap.classList.toggle('hidden');
    emailWrap.classList.toggle('flex');
    this.textContent = emailWrap.classList.contains('hidden') ? 'Ubah Email' : 'Batal';
  });
  document.getElementById('saveEmailBtn').addEventListener('click', function () {
    const val = document.getElementById('newEmail').value;
    if (val && val.includes('@')) {
      document.getElementById('currentEmail').textContent = val;
      document.getElementById('newEmail').value = '';
      emailWrap.classList.add('hidden');
      emailWrap.classList.remove('flex');
      document.getElementById('toggleEmailEdit').textContent = 'Ubah Email';
      toast('Email berhasil diperbarui.');
    }
  });

  document.getElementById('identitasPane').addEventListener('submit', function (e) { e.preventDefault(); toast('Identitas website berhasil disimpan.'); });
  document.getElementById('savePayBtn').addEventListener('click', () => toast('Konfigurasi pembayaran disimpan.'));
  document.getElementById('saveSeoBtn').addEventListener('click', () => toast('Pengaturan SEO & Global disimpan.'));

  document.getElementById('maintenanceToggle').addEventListener('click', function () {
    ss.maintenance = !ss.maintenance;
    this.textContent = ss.maintenance ? 'Aktif' : 'Nonaktif';
    this.className = 'px-4 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all ' + (ss.maintenance ? 'bg-rose-600 text-white' : 'bg-white border border-rose-200 text-rose-500 hover:bg-rose-50');
  });

  function togglePass(inputId, btnId) {
    const input = document.getElementById(inputId);
    const icon = document.querySelector('#' + btnId + ' i');
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.className = 'ph ' + (input.type === 'password' ? 'ph-eye' : 'ph-eye-slash') + ' text-base';
  }
  document.getElementById('toggleCurrentPass').addEventListener('click', () => togglePass('currentPass', 'toggleCurrentPass'));
  document.getElementById('toggleNewPass').addEventListener('click', () => togglePass('newPass', 'toggleNewPass'));

  document.getElementById('savePassBtn').addEventListener('click', function () {
    const current = document.getElementById('currentPass').value;
    const next = document.getElementById('newPass').value;
    const confirm = document.getElementById('confirmPass').value;
    const err = document.getElementById('passError');
    err.classList.add('hidden');
    if (!current) { err.textContent = 'Masukkan kata sandi saat ini.'; err.classList.remove('hidden'); return; }
    if (next.length < 8) { err.textContent = 'Kata sandi baru minimal 8 karakter.'; err.classList.remove('hidden'); return; }
    if (next !== confirm) { err.textContent = 'Konfirmasi kata sandi tidak cocok.'; err.classList.remove('hidden'); return; }
    document.getElementById('currentPass').value = '';
    document.getElementById('newPass').value = '';
    document.getElementById('confirmPass').value = '';
    toast('Kata sandi berhasil diperbarui.');
  });

  syncTabs();
</script>
@endsection
