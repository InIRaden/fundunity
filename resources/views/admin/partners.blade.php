@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between group hover:border-emerald-200 transition-colors">
    <div class="flex items-center gap-5">
      <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform"><i class="ph ph-users text-[26px]"></i></div>
      <div>
        <p class="text-[11px] text-slate-400 font-semibold mb-1">Total Kemitraan Aktif</p>
        <h3 class="text-2xl font-bold text-slate-900"><span id="partnerTotal"></span> <span class="text-sm font-medium text-slate-400">Organisasi</span></h3>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div class="relative w-full md:w-96">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><i class="ph ph-magnifying-glass text-[18px] text-emerald-500"></i></div>
        <input id="partnerSearch" type="text" class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm" placeholder="Cari nama partner...">
      </div>
      <button id="openPartnerModal" class="flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700 transition-colors shadow-sm"><i class="ph ph-plus text-sm"></i> Tambah Mitra</button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50 w-24">Id</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Logo Mitra</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Nama Instansi</th>
            <th class="py-4 px-6 text-center text-[11px] font-semibold text-white border-b border-emerald-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="partnerRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>
    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100"><span id="partnerCount" class="text-xs text-slate-400"></span></div>
  </div>
</div>

<div id="partnerModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden animate-scale-in">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 id="partnerModalTitle" class="text-base font-semibold text-slate-900">Tambah Mitra</h3>
      <button id="closePartnerModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="partnerForm">
      <div class="p-6 space-y-5">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Nama Instansi / Mitra</label>
          <input id="partnerName" required placeholder="Masukkan nama resmi..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Logo Partner <span class="text-slate-400">(Pilih salah satu)</span></label>
          <div class="space-y-3">
            <div>
              <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1.5">Upload File</p>
              <input id="partnerImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>
            <div class="flex items-center gap-2">
              <div class="flex-1 h-px bg-slate-100"></div>
              <span class="text-[10px] text-slate-400 font-bold">ATAU</span>
              <div class="flex-1 h-px bg-slate-100"></div>
            </div>
            <div>
              <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1.5">URL Gambar Eksternal</p>
              <input id="partnerImageUrl" type="url" placeholder="https://..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
            </div>
          </div>
          <p class="text-[10px] text-slate-400 mt-2">Format: JPG, PNG, WEBP. Maks 2MB. Logo boleh kosong.</p>
          {{-- Live Preview --}}
          <div id="partnerPreviewWrap" class="hidden mt-3">
            <p class="text-[10px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Preview</p>
            <div class="w-32 h-16 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden p-2">
              <img id="partnerPreviewEl" src="" alt="Preview" class="max-w-full max-h-full object-contain">
            </div>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" id="cancelPartnerModal" class="px-5 py-2 text-sm font-semibold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="submitPartnerModal" type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 shadow-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2 min-w-[140px] justify-center">
          <span id="partnerBtnText">Konfirmasi Simpan</span>
          <svg id="partnerSpinner" class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
        </button>
      </div>
    </form>
  </div>
</div>

<div id="partnerDeleteModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[110] p-4">
  <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full overflow-hidden animate-scale-in border border-slate-100 p-6 flex flex-col items-center text-center">
    <div class="w-16 h-16 bg-rose-50 border border-rose-100 text-rose-500 rounded-full flex items-center justify-center mb-4"><i class="ph ph-trash text-[28px]"></i></div>
    <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus Mitra?</h3>
    <p class="text-sm text-slate-500 mb-6 leading-relaxed">Tindakan ini tidak dapat dibatalkan. Data mitra akan dihapus secara permanen dari sistem.</p>
    <div class="flex w-full gap-3">
      <button id="cancelPartnerDelete" class="flex-1 py-2.5 px-4 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-100 hover:text-slate-800 transition-colors">Batal</button>
      <button id="confirmPartnerDelete" class="flex-1 py-2.5 px-4 bg-rose-600 text-white rounded-xl text-sm font-semibold shadow-md shadow-rose-600/20 hover:bg-rose-700 transition-colors transform hover:-translate-y-0.5">Ya, Hapus</button>
    </div>
  </div>
</div>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const partnerStoreUrl = @json(route('admin.partners.store'));
  const partnerBaseUrl = @json(url('/admin/partners'));

  function normalizePartner(raw = {}) {
    return {
      id: raw.id,
      name: raw.name || '',
      imageUrl: raw.imageUrl || raw.logo || '',
    };
  }

  const partnerState = {
    data: (@json($partners) || []).map((item) => normalizePartner(item)),
    search: '',
    editingId: null,
    deletingId: null,
    isSubmitting: false,
    isDeleting: false,
  };

  async function requestPartner(url, method, payload = null, isFormData = false) {
    const headers = {
      'Accept': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    };

    if (!isFormData) {
      headers['Content-Type'] = 'application/json';
    }

    const response = await fetch(url, {
      method,
      headers,
      body: isFormData ? payload : (payload ? JSON.stringify(payload) : null),
    });

    const result = await response.json().catch(() => ({}));

    if (!response.ok) {
      const validationErrors = result.errors ? Object.values(result.errors).flat().join('\n') : null;
      throw new Error(validationErrors || result.message || 'Permintaan gagal diproses.');
    }

    return result;
  }

  function setPartnerSubmitLoading(loading) {
    const button = document.getElementById('submitPartnerModal');
    const text = document.getElementById('partnerBtnText');
    const spinner = document.getElementById('partnerSpinner');
    if (!button) return;
    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    if (text) text.textContent = loading ? (partnerState.editingId ? 'Menyimpan...' : 'Menambahkan...') : 'Konfirmasi Simpan';
    if (spinner) spinner.classList.toggle('hidden', !loading);
  }

  function setPartnerDeleteLoading(loading) {
    const button = document.getElementById('confirmPartnerDelete');
    if (!button) {
      return;
    }

    if (loading) {
      button.dataset.originalLabel = button.textContent;
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.textContent = 'Menghapus...';
      return;
    }

    button.disabled = false;
    button.classList.remove('opacity-70', 'cursor-not-allowed');
    if (button.dataset.originalLabel) {
      button.textContent = button.dataset.originalLabel;
    }
  }

  function filteredPartners() {
    const q = partnerState.search.toLowerCase();
    return partnerState.data.filter((p) => p.name.toLowerCase().includes(q));
  }

  function renderPartners() {
    const data = filteredPartners();
    document.getElementById('partnerTotal').textContent = String(partnerState.data.length);
    document.getElementById('partnerRows').innerHTML = data.length ? data.map((p) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-5 px-6 text-sm font-semibold text-slate-400">#${p.id}</td>
        <td class="py-5 px-6">
          <div class="w-24 h-12 bg-white border border-slate-100 rounded-lg overflow-hidden flex items-center justify-center p-2 shadow-sm">
            ${p.imageUrl
              ? `<img src="${p.imageUrl}" class="max-w-full max-h-full object-contain" alt="" onerror="this.parentElement.innerHTML='<span class=\'text-[10px] text-slate-300 font-bold\'>No Logo</span>'">`
              : `<span class="text-[10px] text-slate-300 font-bold">No Logo</span>`
            }
          </div>
        </td>
        <td class="py-5 px-6"><span class="text-sm font-semibold text-slate-900">${p.name}</span></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="editPartner(${p.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="promptDeletePartner(${p.id})">Hapus</button></div></td>
      </tr>
    `).join('') : '<tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 text-sm">Mitra tidak ditemukan.</td></tr>';
    document.getElementById('partnerCount').textContent = 'Menampilkan ' + data.length + ' mitra';
  }

  function resetPartnerPreview() {
    document.getElementById('partnerPreviewWrap').classList.add('hidden');
    document.getElementById('partnerPreviewEl').src = '';
  }

  function showPartnerModal(item) {
    const modal = document.getElementById('partnerModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    resetPartnerPreview();
    if (item) {
      partnerState.editingId = item.id;
      document.getElementById('partnerModalTitle').textContent = 'Ubah Data Mitra';
      document.getElementById('partnerName').value = item.name;
      document.getElementById('partnerImageFile').value = '';
      document.getElementById('partnerImageUrl').value = '';
      // Show current logo as preview
      if (item.imageUrl) {
        document.getElementById('partnerPreviewEl').src = item.imageUrl;
        document.getElementById('partnerPreviewWrap').classList.remove('hidden');
      }
    } else {
      partnerState.editingId = null;
      document.getElementById('partnerModalTitle').textContent = 'Tambah Mitra';
      document.getElementById('partnerForm').reset();
    }
    setPartnerSubmitLoading(false);
  }

  function hidePartnerModal() {
    const modal = document.getElementById('partnerModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    partnerState.isSubmitting = false;
    setPartnerSubmitLoading(false);
  }

  function editPartner(id) {
    const found = partnerState.data.find((p) => p.id === id);
    if (found) showPartnerModal(found);
  }

  function promptDeletePartner(id) {
    partnerState.deletingId = id;
    const modal = document.getElementById('partnerDeleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function hideDeleteModal() {
    const modal = document.getElementById('partnerDeleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    partnerState.deletingId = null;
  }

  document.getElementById('partnerSearch').addEventListener('input', function (e) { partnerState.search = e.target.value; renderPartners(); });
  document.getElementById('openPartnerModal').addEventListener('click', () => showPartnerModal(null));
  document.getElementById('closePartnerModal').addEventListener('click', hidePartnerModal);
  document.getElementById('cancelPartnerModal').addEventListener('click', hidePartnerModal);

  // Live preview — file upload
  document.getElementById('partnerImageFile').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById('partnerPreviewEl').src = e.target.result;
        document.getElementById('partnerPreviewWrap').classList.remove('hidden');
        document.getElementById('partnerImageUrl').value = ''; // clear URL input
      };
      reader.readAsDataURL(file);
    }
  });

  // Live preview — URL input
  document.getElementById('partnerImageUrl').addEventListener('input', function () {
    const url = this.value.trim();
    if (url) {
      document.getElementById('partnerPreviewEl').src = url;
      document.getElementById('partnerPreviewWrap').classList.remove('hidden');
      document.getElementById('partnerImageFile').value = ''; // clear file input
    } else {
      document.getElementById('partnerPreviewWrap').classList.add('hidden');
    }
  });

  document.getElementById('partnerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    if (partnerState.isSubmitting) {
      return;
    }

    const formData = new FormData();
    formData.append('name', document.getElementById('partnerName').value);
    
    const fileInput = document.getElementById('partnerImageFile');
    if (fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    } else {
      const urlInput = document.getElementById('partnerImageUrl').value.trim();
      if (urlInput) formData.append('image_url', urlInput);
    }

    partnerState.isSubmitting = true;
    setPartnerSubmitLoading(true);

    if (partnerState.editingId) {
      formData.append('_method', 'PUT');
    }

    const action = partnerState.editingId
      ? requestPartner(`${partnerBaseUrl}/${partnerState.editingId}`, 'POST', formData, true)
      : requestPartner(partnerStoreUrl, 'POST', formData, true);

    action
      .then((result) => {
        const normalized = normalizePartner(result.data || {});
        if (partnerState.editingId) {
          partnerState.data = partnerState.data.map((p) => p.id === partnerState.editingId ? normalized : p);
        } else {
          partnerState.data.unshift(normalized);
        }
        hidePartnerModal();
        renderPartners();
      })
      .catch((error) => {
        window.alert(error.message);
        partnerState.isSubmitting = false;
        setPartnerSubmitLoading(false);
      });
  });
  document.getElementById('cancelPartnerDelete').addEventListener('click', hideDeleteModal);
  document.getElementById('confirmPartnerDelete').addEventListener('click', function () {
    if (partnerState.deletingId === null || partnerState.isDeleting) {
      return;
    }

    partnerState.isDeleting = true;
    setPartnerDeleteLoading(true);

    requestPartner(`${partnerBaseUrl}/${partnerState.deletingId}`, 'DELETE')
      .then(() => {
        partnerState.data = partnerState.data.filter((p) => p.id !== partnerState.deletingId);
        hideDeleteModal();
        renderPartners();
      })
      .catch((error) => {
        window.alert(error.message);
      })
      .finally(() => {
        partnerState.isDeleting = false;
        setPartnerDeleteLoading(false);
      });
  });

  renderPartners();
</script>
@endsection
