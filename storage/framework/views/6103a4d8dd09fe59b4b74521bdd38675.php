<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5" id="campaignStats"></div>

  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div class="relative w-full md:w-80">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
          <i class="ph ph-magnifying-glass text-[18px] text-emerald-500"></i>
        </div>
        <input id="campaignSearch" type="text" placeholder="Cari campaign atau kategori..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
      </div>
      <button id="openCampaignModal" class="flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap">
        <i class="ph ph-plus text-sm"></i> Buat Campaign Baru
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Campaign</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Kategori</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Progress Donasi</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Deadline</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Status</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white border-b border-emerald-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="campaignRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>

    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100">
      <span id="campaignCount" class="text-xs text-slate-400 font-medium"></span>
    </div>
  </div>
</div>

<div id="campaignModal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden animate-scale-in">
    <div class="bg-emerald-600 px-6 py-5 flex items-center justify-between">
      <div>
        <h3 id="campaignModalTitle" class="text-base font-bold text-white">Buat Campaign Baru</h3>
        <p id="campaignModalSub" class="text-xs text-emerald-100/80">Isi detail campaign yang akan dipublikasikan</p>
      </div>
      <button id="closeCampaignModal" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/20 text-white hover:bg-white/30 transition-all">
        <i class="ph ph-x text-lg"></i>
      </button>
    </div>

    <form id="campaignForm">
      <div class="p-6 space-y-5">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Judul Campaign</label>
          <input required id="fTitle" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400 transition-all" placeholder="Contoh: Bantuan Bencana NTT">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Kategori</label>
            <input required id="fCategory" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400 transition-all" placeholder="Kebencanaan / Pendidikan...">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Status</label>
            <div id="statusToggle" class="flex items-center bg-slate-100 rounded-xl p-1 gap-1">
              <button type="button" data-status="draft" class="status-choice flex-1 py-1.5 rounded-lg text-[11px] font-bold transition-all text-slate-500 hover:text-slate-700">Draft</button>
              <button type="button" data-status="aktif" class="status-choice flex-1 py-1.5 rounded-lg text-[11px] font-bold transition-all">Aktif</button>
              <button type="button" data-status="selesai" class="status-choice flex-1 py-1.5 rounded-lg text-[11px] font-bold transition-all text-slate-500 hover:text-slate-700">Selesai</button>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Target Nominal (Rp)</label>
            <input required id="fTarget" type="number" min="1" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400 transition-all" placeholder="50000000">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Deadline</label>
            <input required id="fDeadline" type="date" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400 transition-all">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Deskripsi Campaign</label>
          <textarea required id="fDescription" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400 transition-all resize-none" placeholder="Jelaskan tujuan dan detail campaign ini..."></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Upload Poster/Thumbnail (Opsional)</label>
          <input id="fImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
          <div id="imagePreviewWrap" class="hidden mt-3 relative">
            <p class="text-[10px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Preview Gambar</p>
            <div class="relative rounded-2xl overflow-hidden border border-slate-200 aspect-video bg-slate-100">
              <img id="imagePreviewEl" src="" alt="Preview" class="w-full h-full object-cover">
            </div>
          </div>
        </div>
      </div>

      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-3">
        <button type="button" id="cancelCampaignModal" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 border border-slate-200 rounded-xl hover:bg-white transition-all">Batal</button>
        <button type="submit" id="submitCampaignBtn" class="px-8 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-600/20 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
          <i class="ph ph-plus text-base"></i> Buat Campaign
        </button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const campaignStoreUrl = <?php echo json_encode(route('admin.campaign.store'), 15, 512) ?>;
  const campaignBaseUrl = <?php echo json_encode(url('/admin/campaign'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  function normalizeCampaign(raw) {
    return {
      id: Number(raw.id),
      title: raw.title || '',
      description: raw.description || '',
      collected: Number(raw.collected || 0),
      target: Number(raw.target || 0),
      deadline: String(raw.deadline || '').slice(0, 10),
      category: raw.category || 'Umum',
      status: raw.status || 'aktif',
      imageUrl: raw.image || ''
    };
  }

  const campaignState = {
    campaigns: (<?php echo json_encode($campaigns, 15, 512) ?> || []).map(normalizeCampaign),
    search: '',
    editingId: null,
    status: 'aktif',
    isSubmitting: false,
  };

  const statusMap = {
    aktif: { badge: 'bg-emerald-600 text-white', label: 'Aktif' },
    selesai: { badge: 'bg-slate-500 text-white', label: 'Selesai' },
    draft: { badge: 'bg-amber-500 text-white', label: 'Draft' }
  };

  function rp(n) {
    return 'Rp ' + Number(n).toLocaleString('id-ID');
  }

  async function requestCampaignForm(url, method, formData) {
    if (method !== 'POST') {
      formData.append('_method', method);
      method = 'POST';
    }
    const response = await fetch(url, {
      method,
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: formData,
    });

    const json = await response.json().catch(() => ({}));

    if (!response.ok) {
      const firstError = json.errors ? Object.values(json.errors)[0]?.[0] : null;
      throw new Error(firstError || json.message || 'Terjadi kesalahan saat memproses campaign.');
    }

    return json;
  }

  document.getElementById('fImageFile').addEventListener('change', function () {
    const file = this.files[0];
    const wrap = document.getElementById('imagePreviewWrap');
    const preview = document.getElementById('imagePreviewEl');
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
        wrap.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    } else {
      wrap.classList.add('hidden');
      preview.src = '';
    }
  });

  function setSubmitLoading(loading) {
    const button = document.getElementById('submitCampaignBtn');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin text-base"></i> Menyimpan...'
      : (campaignState.editingId
          ? 'Simpan Perubahan'
          : '<i class="ph ph-plus text-base"></i> Buat Campaign');
  }

  function renderStats() {
    const active = campaignState.campaigns.filter(c => c.status === 'aktif');
    const totalTarget = active.reduce((acc, c) => acc + Number(c.target), 0);
    const totalCollected = active.reduce((acc, c) => acc + Number(c.collected), 0);
    const totalActive = active.length;
    const cards = [
      { label: 'Campaign Aktif', value: `${totalActive} Campaign`, icon: 'ph ph-target', iconClass: 'bg-emerald-50 border-emerald-100 text-emerald-600' },
      { label: 'Total Target (Aktif)', value: rp(totalTarget), icon: 'ph ph-arrow-up-right', iconClass: 'bg-indigo-50 border-indigo-100 text-indigo-600' },
      { label: 'Total Terkumpul (Aktif)', value: rp(totalCollected), icon: 'ph ph-users-three', iconClass: 'bg-amber-50 border-amber-100 text-amber-600' },
    ];
    document.getElementById('campaignStats').innerHTML = cards.map(c => `
      <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 p-6 flex items-center gap-4 group transition-colors">
        <div class="w-12 h-12 rounded-xl border flex items-center justify-center shrink-0 ${c.iconClass}">
          <i class="${c.icon} text-[22px]"></i>
        </div>
        <div>
          <p class="text-[11px] font-semibold text-slate-400">${c.label}</p>
          <p class="text-xl font-bold text-slate-900 mt-0.5">${c.value}</p>
        </div>
      </div>
    `).join('');
  }

  function renderRows() {
    const q = campaignState.search.toLowerCase();
    const filtered = campaignState.campaigns.filter(c => c.title.toLowerCase().includes(q) || c.category.toLowerCase().includes(q));
    const rows = filtered.length ? filtered.map(c => {
      const p = Math.min(100, Math.round((Number(c.collected) / Number(c.target)) * 100));
      const status = statusMap[c.status] || statusMap.aktif;
      return `
        <tr class="hover:bg-slate-50/50 transition-colors">
          <td class="py-5 px-6 max-w-[220px]">
            <p class="text-sm font-semibold text-slate-900 line-clamp-1">${c.title}</p>
            <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">${c.description}</p>
          </td>
          <td class="py-5 px-6"><span class="px-2.5 py-1 bg-slate-800 text-white rounded-full text-[10px] font-semibold">${c.category}</span></td>
          <td class="py-5 px-6 min-w-[200px]">
            <div class="flex items-center justify-between mb-1.5">
              <span class="text-xs font-bold text-emerald-600">${rp(c.collected)}</span>
              <span class="text-[10px] font-bold text-slate-400">${p}%</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-emerald-400" style="width:${p}%"></div></div>
            <p class="text-[10px] text-slate-400 mt-1">Target: ${rp(c.target)}</p>
          </td>
          <td class="py-5 px-6">
            <div class="flex items-center gap-1.5 text-sm text-slate-600 font-medium">
              <i class="ph ph-calendar-blank text-slate-400"></i>${c.deadline}
            </div>
          </td>
          <td class="py-5 px-6"><span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-semibold ${status.badge}">${status.label}</span></td>
          <td class="py-5 px-6">
            <div class="flex items-center justify-center gap-2">
              <button class="px-3 py-1.5 bg-emerald-600 text-white font-bold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="editCampaign(${c.id})">Edit</button>
              <button class="px-3 py-1.5 bg-rose-600 text-white font-bold rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteCampaign(${c.id}, this)">Hapus</button>
            </div>
          </td>
        </tr>
      `;
    }).join('') : '<tr><td colspan="6" class="py-12 text-center text-sm text-slate-400 font-medium">Belum ada campaign ditemukan.</td></tr>';
    document.getElementById('campaignRows').innerHTML = rows;
    document.getElementById('campaignCount').textContent = `Menampilkan ${filtered.length} campaign`;
  }

  function setStatusButtons() {
    document.querySelectorAll('.status-choice').forEach((btn) => {
      const s = btn.getAttribute('data-status');
      btn.className = 'status-choice flex-1 py-1.5 rounded-lg text-[11px] font-bold transition-all';
      if (campaignState.status === s) {
        if (s === 'aktif') btn.className += ' bg-emerald-600 text-white shadow-sm';
        if (s === 'draft') btn.className += ' bg-amber-500 text-white shadow-sm';
        if (s === 'selesai') btn.className += ' bg-slate-500 text-white shadow-sm';
      } else {
        btn.className += ' text-slate-500 hover:text-slate-700';
      }
    });
  }

  function openCampaignModal(editing) {
    const modal = document.getElementById('campaignModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (editing) {
      campaignState.editingId = editing.id;
      campaignState.status = editing.status;
      document.getElementById('campaignModalTitle').textContent = 'Edit Campaign';
      document.getElementById('campaignModalSub').textContent = 'Perbarui detail campaign yang dipilih';
      document.getElementById('fTitle').value = editing.title;
      document.getElementById('fCategory').value = editing.category;
      document.getElementById('fTarget').value = editing.target;
      document.getElementById('fDeadline').value = editing.deadline;
      document.getElementById('fDescription').value = editing.description;
      
      const wrap = document.getElementById('imagePreviewWrap');
      const preview = document.getElementById('imagePreviewEl');
      document.getElementById('fImageFile').value = '';
      if (editing.imageUrl) {
        preview.src = editing.imageUrl;
        wrap.classList.remove('hidden');
      } else {
        wrap.classList.add('hidden');
        preview.src = '';
      }
    } else {
      campaignState.editingId = null;
      campaignState.status = 'aktif';
      document.getElementById('campaignModalTitle').textContent = 'Buat Campaign Baru';
      document.getElementById('campaignModalSub').textContent = 'Isi detail campaign yang akan dipublikasikan';
      document.getElementById('campaignForm').reset();
      document.getElementById('imagePreviewWrap').classList.add('hidden');
      document.getElementById('imagePreviewEl').src = '';
    }
    setStatusButtons();
    setSubmitLoading(false);
  }

  function closeCampaignModal() {
    const modal = document.getElementById('campaignModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  function editCampaign(id) {
    const found = campaignState.campaigns.find(c => c.id === id);
    if (found) openCampaignModal(found);
  }

  async function deleteCampaign(id, button) {
    if (window.confirm('Hapus campaign ini secara permanen?')) {
      const originalHtml = button?.innerHTML;

      if (button) {
        button.disabled = true;
        button.classList.add('opacity-70', 'cursor-not-allowed');
        button.innerHTML = '<i class="ph ph-spinner-gap animate-spin"></i>';
      }

      try {
        const formData = new FormData();
        await requestCampaignForm(`${campaignBaseUrl}/${id}`, 'DELETE', formData);
        campaignState.campaigns = campaignState.campaigns.filter(c => c.id !== id);
        renderStats();
        renderRows();
      } catch (error) {
        window.alert(error.message);
      } finally {
        if (button) {
          button.disabled = false;
          button.classList.remove('opacity-70', 'cursor-not-allowed');
          button.innerHTML = originalHtml || 'Hapus';
        }
      }
    }
  }

  document.getElementById('campaignSearch').addEventListener('input', function (e) {
    campaignState.search = e.target.value;
    renderRows();
  });

  document.getElementById('openCampaignModal').addEventListener('click', () => openCampaignModal(null));
  document.getElementById('closeCampaignModal').addEventListener('click', closeCampaignModal);
  document.getElementById('cancelCampaignModal').addEventListener('click', closeCampaignModal);

  document.querySelectorAll('.status-choice').forEach((btn) => {
    btn.addEventListener('click', function () {
      campaignState.status = this.getAttribute('data-status');
      setStatusButtons();
    });
  });

  document.getElementById('campaignForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (campaignState.isSubmitting) {
      return;
    }

    const formData = new FormData();
    formData.append('title', document.getElementById('fTitle').value);
    formData.append('category', document.getElementById('fCategory').value);
    formData.append('target', document.getElementById('fTarget').value);
    formData.append('deadline', document.getElementById('fDeadline').value);
    formData.append('description', document.getElementById('fDescription').value);
    formData.append('status', campaignState.status);

    const fileInput = document.getElementById('fImageFile');
    if (fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    }

    campaignState.isSubmitting = true;
    setSubmitLoading(true);

    try {
      if (campaignState.editingId) {
        const result = await requestCampaignForm(`${campaignBaseUrl}/${campaignState.editingId}`, 'PUT', formData);
        const updated = normalizeCampaign(result.data || {});
        campaignState.campaigns = campaignState.campaigns.map((c) => c.id === campaignState.editingId ? updated : c);
      } else {
        const result = await requestCampaignForm(campaignStoreUrl, 'POST', formData);
        campaignState.campaigns.unshift(normalizeCampaign(result.data || {}));
      }

      closeCampaignModal();
      renderStats();
      renderRows();
    } catch (error) {
      window.alert(error.message);
    } finally {
      campaignState.isSubmitting = false;
      setSubmitLoading(false);
    }
  });

  renderStats();
  renderRows();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/admin/campaign.blade.php ENDPATH**/ ?>