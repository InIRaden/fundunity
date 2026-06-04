export default function initAdminPartners() {
  const initial = window.partnerInitial || {};
  const csrfToken = initial.csrfToken || '';
  const partnerStoreUrl = initial.partnerStoreUrl || '';
  const partnerBaseUrl = initial.partnerBaseUrl || '';

  function normalizePartner(raw = {}) {
    return {
      id: raw.id,
      name: raw.name || '',
      imageUrl: raw.imageUrl || raw.logo || '',
    };
  }

  const partnerState = {
    data: (initial.partners || []).map((item) => normalizePartner(item)),
    search: '',
    editingId: null,
    deletingId: null,
    isSubmitting: false,
    isDeleting: false,
  };

  async function requestPartner(url, method, payload = null, isFormData = false) {
    const headers = {
      Accept: 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    };

    if (!isFormData) headers['Content-Type'] = 'application/json';

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
    if (!button) return;
    if (loading) {
      button.dataset.originalLabel = button.textContent;
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.textContent = 'Menghapus...';
      return;
    }
    button.disabled = false;
    button.classList.remove('opacity-70', 'cursor-not-allowed');
    if (button.dataset.originalLabel) button.textContent = button.dataset.originalLabel;
  }

  function filteredPartners() {
    const q = partnerState.search.toLowerCase();
    return partnerState.data.filter((p) => p.name.toLowerCase().includes(q));
  }

  function renderPartners() {
    const data = filteredPartners();
    const totalEl = document.getElementById('partnerTotal');
    const rowsEl = document.getElementById('partnerRows');
    const countEl = document.getElementById('partnerCount');
    if (totalEl) totalEl.textContent = String(partnerState.data.length);
    if (!rowsEl) return;

    rowsEl.innerHTML = data.length ? data.map((p) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-5 px-6 text-sm font-semibold text-slate-400">#${p.id}</td>
        <td class="py-5 px-6">
          <div class="w-24 h-12 bg-white border border-slate-100 rounded-lg overflow-hidden flex items-center justify-center p-2 shadow-sm">
            ${p.imageUrl
              ? `<img src="${p.imageUrl}" class="max-w-full max-h-full object-contain" alt="" onerror="this.parentElement.innerHTML='<span class=\\'text-[10px] text-slate-300 font-bold\\'>No Logo</span>'">`
              : `<span class="text-[10px] text-slate-300 font-bold">No Logo</span>`
            }
          </div>
        </td>
        <td class="py-5 px-6"><span class="text-sm font-semibold text-slate-900">${p.name}</span></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" data-action="edit" data-id="${p.id}">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" data-action="delete" data-id="${p.id}">Hapus</button></div></td>
      </tr>
    `).join('') : '<tr><td colspan="4" class="py-20 text-center text-slate-400"><div class="flex flex-col items-center justify-center gap-3"><i class="ph ph-info text-[32px] text-slate-300"></i><p>Tidak ada data ditemukan.</p></div></td></tr>';

    if (countEl) countEl.textContent = 'Menampilkan ' + data.length + ' mitra';

    // Attach event listeners for edit/delete buttons
    rowsEl.querySelectorAll('button[data-action]').forEach((btn) => {
      const action = btn.dataset.action;
      const id = Number(btn.dataset.id);
      if (action === 'edit') btn.addEventListener('click', () => editPartner(id));
      if (action === 'delete') btn.addEventListener('click', () => promptDeletePartner(id));
    });
  }

  function resetPartnerPreview() {
    const wrap = document.getElementById('partnerPreviewWrap');
    const el = document.getElementById('partnerPreviewEl');
    if (wrap) wrap.classList.add('hidden');
    if (el) el.src = '';
  }

  function showPartnerModal(item) {
    const modal = document.getElementById('partnerModal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    resetPartnerPreview();
    if (item) {
      partnerState.editingId = item.id;
      const title = document.getElementById('partnerModalTitle');
      if (title) title.textContent = 'Ubah Data Mitra';
      const name = document.getElementById('partnerName');
      if (name) name.value = item.name;
      const file = document.getElementById('partnerImageFile'); if (file) file.value = '';
      const url = document.getElementById('partnerImageUrl'); if (url) url.value = '';
      if (item.imageUrl) {
        const preview = document.getElementById('partnerPreviewEl');
        if (preview) preview.src = item.imageUrl;
        const wrap = document.getElementById('partnerPreviewWrap'); if (wrap) wrap.classList.remove('hidden');
      }
    } else {
      partnerState.editingId = null;
      const form = document.getElementById('partnerForm'); if (form) form.reset();
      const title = document.getElementById('partnerModalTitle'); if (title) title.textContent = 'Tambah Mitra';
    }
    setPartnerSubmitLoading(false);
  }

  function hidePartnerModal() {
    const modal = document.getElementById('partnerModal');
    if (!modal) return;
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
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function hideDeleteModal() {
    const modal = document.getElementById('partnerDeleteModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    partnerState.deletingId = null;
  }

  function attachEvents() {
    const search = document.getElementById('partnerSearch');
    if (search) search.addEventListener('input', function (e) { partnerState.search = e.target.value; renderPartners(); });
    const open = document.getElementById('openPartnerModal'); if (open) open.addEventListener('click', () => showPartnerModal(null));
    const close = document.getElementById('closePartnerModal'); if (close) close.addEventListener('click', hidePartnerModal);
    const cancel = document.getElementById('cancelPartnerModal'); if (cancel) cancel.addEventListener('click', hidePartnerModal);

    const fileInput = document.getElementById('partnerImageFile');
    if (fileInput) fileInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          const previewEl = document.getElementById('partnerPreviewEl'); if (previewEl) previewEl.src = e.target.result;
          const wrap = document.getElementById('partnerPreviewWrap'); if (wrap) wrap.classList.remove('hidden');
          const urlInput = document.getElementById('partnerImageUrl'); if (urlInput) urlInput.value = '';
        };
        reader.readAsDataURL(file);
      }
    });

    const urlInput = document.getElementById('partnerImageUrl');
    if (urlInput) urlInput.addEventListener('input', function () {
      const url = this.value.trim();
      const previewEl = document.getElementById('partnerPreviewEl');
      const wrap = document.getElementById('partnerPreviewWrap');
      const fileInputEl = document.getElementById('partnerImageFile');
      if (url) {
        if (previewEl) previewEl.src = url;
        if (wrap) wrap.classList.remove('hidden');
        if (fileInputEl) fileInputEl.value = '';
      } else {
        if (wrap) wrap.classList.add('hidden');
      }
    });

    const form = document.getElementById('partnerForm');
    if (form) form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (partnerState.isSubmitting) return;
      const fd = new FormData();
      const nameEl = document.getElementById('partnerName'); if (nameEl) fd.append('name', nameEl.value);
      const fileEl = document.getElementById('partnerImageFile');
      if (fileEl && fileEl.files[0]) fd.append('image_file', fileEl.files[0]);
      else {
        const urlInputEl = document.getElementById('partnerImageUrl'); if (urlInputEl && urlInputEl.value.trim()) fd.append('image_url', urlInputEl.value.trim());
      }

      partnerState.isSubmitting = true; setPartnerSubmitLoading(true);
      if (partnerState.editingId) fd.append('_method', 'PUT');

      const action = partnerState.editingId ? requestPartner(`${partnerBaseUrl}/${partnerState.editingId}`, 'POST', fd, true) : requestPartner(partnerStoreUrl, 'POST', fd, true);
      action.then((result) => {
        const normalized = normalizePartner(result.data || {});
        if (partnerState.editingId) partnerState.data = partnerState.data.map((p) => p.id === partnerState.editingId ? normalized : p);
        else partnerState.data.unshift(normalized);
        hidePartnerModal(); renderPartners();
      }).catch((error) => {
        window.alert(error.message);
        partnerState.isSubmitting = false; setPartnerSubmitLoading(false);
      });
    });

    const cancelDelete = document.getElementById('cancelPartnerDelete'); if (cancelDelete) cancelDelete.addEventListener('click', hideDeleteModal);
    const confirmDelete = document.getElementById('confirmPartnerDelete'); if (confirmDelete) confirmDelete.addEventListener('click', function () {
      if (partnerState.deletingId === null || partnerState.isDeleting) return;
      partnerState.isDeleting = true; setPartnerDeleteLoading(true);
      requestPartner(`${partnerBaseUrl}/${partnerState.deletingId}`, 'DELETE').then(() => {
        partnerState.data = partnerState.data.filter((p) => p.id !== partnerState.deletingId);
        hideDeleteModal(); renderPartners();
      }).catch((error) => {
        window.alert(error.message);
      }).finally(() => {
        partnerState.isDeleting = false; setPartnerDeleteLoading(false);
      });
    });
  }

  attachEvents();
  renderPartners();
}
