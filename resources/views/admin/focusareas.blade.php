@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div class="relative w-full md:w-96">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><i class="ph ph-magnifying-glass text-[18px] text-emerald-500"></i></div>
        <input id="areaSearch" type="text" class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm" placeholder="Cari pilar area pengabdian...">
      </div>
      <button id="openAreaModal" class="flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700 transition-colors shadow-sm">
        <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Area</span>
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Fokus Pilar Pengabdian</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Deskripsi Utama</th>
            <th class="py-4 px-6 text-center text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="areaRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>

    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100">
      <span id="areaCount" class="text-xs text-slate-400"></span>
    </div>
  </div>
</div>

<div id="areaModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden animate-scale-in">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 id="areaModalTitle" class="text-base font-semibold text-slate-900">Tambah Fokus Area Baru</h3>
      <button id="closeAreaModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="areaForm">
      <div class="p-6 space-y-5">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Judul Area</label>
          <input id="areaTitle" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20" placeholder="Contoh: Pendidikan Desa">
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Deskripsi Kegiatan</label>
          <textarea id="areaDesc" required rows="4" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20 resize-none leading-relaxed" placeholder="Jelaskan fokus pengabdian..."></textarea>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" id="cancelAreaModal" class="px-5 py-2 text-sm font-semibold text-slate-500 hover:text-slate-700">Batal</button>
        <button type="submit" id="submitAreaModal" class="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 shadow-sm transition-all">Tambahkan</button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const focusAreaStoreUrl = @json(route('admin.focusareas.store'));
  const focusAreaBaseUrl = @json(url('/admin/focusareas'));
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  function normalizeArea(raw) {
    return {
      id: Number(raw.id),
      title: raw.title || '',
      description: raw.description || '',
      icon: raw.icon || 'ph ph-target',
    };
  }

  const fsState = {
    areas: (@json($focusAreas) || []).map(normalizeArea),
    search: '',
    editingId: null,
    isSubmitting: false,
  };

  async function requestFocusArea(url, method, payload) {
    const response = await fetch(url, {
      method,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload),
    });

    const json = await response.json().catch(() => ({}));

    if (!response.ok) {
      const firstError = json.errors ? Object.values(json.errors)[0]?.[0] : null;
      throw new Error(firstError || json.message || 'Terjadi kesalahan saat memproses fokus area.');
    }

    return json;
  }

  function setAreaSubmitLoading(loading) {
    const button = document.getElementById('submitAreaModal');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin text-sm"></i> Menyimpan...'
      : (fsState.editingId ? 'Konfirmasi Update' : 'Tambahkan');
  }

  function iconFor(name) {
    if (String(name).startsWith('ph ')) return name;
    if (name === 'PiGraduationCap') return 'ph ph-graduation-cap';
    if (name === 'PiHeartbeat') return 'ph ph-heartbeat';
    if (name === 'PiTree') return 'ph ph-tree';
    if (name === 'PiUsers') return 'ph ph-users';
    return 'ph ph-target';
  }

  function filteredAreas() {
    const q = fsState.search.toLowerCase();
    return fsState.areas.filter((a) => a.title.toLowerCase().includes(q) || a.description.toLowerCase().includes(q));
  }

  function renderAreas() {
    const data = filteredAreas();
    document.getElementById('areaRows').innerHTML = data.length ? data.map((a) => `
      <tr class="hover:bg-slate-50/50 transition-colors group">
        <td class="py-5 px-6"><div class="flex items-center gap-4"><div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="${iconFor(a.icon)} text-[24px]"></i></div><div class="flex flex-col"><span class="text-sm font-semibold text-slate-900">${a.title}</span><span class="text-[10px] text-emerald-500 font-semibold mt-1">Aktif Berjalan</span></div></div></td>
        <td class="py-5 px-6"><p class="text-sm text-slate-500 line-clamp-2 max-w-lg">${a.description}</p></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="editArea(${a.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteArea(${a.id}, this)">Hapus</button></div></td>
      </tr>
    `).join('') : '<tr><td colspan="3" class="px-6 py-12 text-center text-slate-500 font-medium text-sm">Fokus Area tidak ditemukan.</td></tr>';
    document.getElementById('areaCount').textContent = 'Menampilkan ' + data.length + ' area';
  }

  function openAreaModal(editItem) {
    const modal = document.getElementById('areaModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (editItem) {
      fsState.editingId = editItem.id;
      document.getElementById('areaModalTitle').textContent = 'Edit Fokus Area';
      document.getElementById('submitAreaModal').textContent = 'Konfirmasi Update';
      document.getElementById('areaTitle').value = editItem.title;
      document.getElementById('areaDesc').value = editItem.description;
    } else {
      fsState.editingId = null;
      document.getElementById('areaModalTitle').textContent = 'Tambah Fokus Area Baru';
      document.getElementById('areaForm').reset();
    }

    setAreaSubmitLoading(false);
  }

  function closeAreaModal() {
    const modal = document.getElementById('areaModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  function editArea(id) {
    const item = fsState.areas.find((a) => a.id === id);
    if (item) openAreaModal(item);
  }

  async function deleteArea(id, button) {
    if (!window.confirm('Apakah Anda yakin ingin menghapus fokus area ini?')) {
      return;
    }

    const originalHtml = button?.innerHTML;

    if (button) {
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.innerHTML = '<i class="ph ph-spinner-gap animate-spin text-sm"></i>';
    }

    try {
      await requestFocusArea(`${focusAreaBaseUrl}/${id}`, 'DELETE', {});
      fsState.areas = fsState.areas.filter((a) => a.id !== id);
      renderAreas();
    } catch (error) {
      window.alert(error.message);
    } finally {
      if (button) {
        button.disabled = false;
        button.classList.remove('opacity-70', 'cursor-not-allowed');
        button.innerHTML = originalHtml || button.innerHTML;
      }
    }
  }

  document.getElementById('areaSearch').addEventListener('input', function (e) {
    fsState.search = e.target.value;
    renderAreas();
  });
  document.getElementById('openAreaModal').addEventListener('click', () => openAreaModal(null));
  document.getElementById('closeAreaModal').addEventListener('click', closeAreaModal);
  document.getElementById('cancelAreaModal').addEventListener('click', closeAreaModal);
  document.getElementById('areaForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (fsState.isSubmitting) {
      return;
    }

    const existing = fsState.areas.find((a) => a.id === fsState.editingId);
    const payload = {
      title: document.getElementById('areaTitle').value,
      description: document.getElementById('areaDesc').value,
      icon: existing?.icon || 'ph ph-target',
    };

    fsState.isSubmitting = true;
    setAreaSubmitLoading(true);

    try {
      if (fsState.editingId) {
        const result = await requestFocusArea(`${focusAreaBaseUrl}/${fsState.editingId}`, 'PUT', payload);
        const normalized = normalizeArea(result.data || {});
        fsState.areas = fsState.areas.map((a) => a.id === fsState.editingId ? normalized : a);
      } else {
        const result = await requestFocusArea(focusAreaStoreUrl, 'POST', payload);
        fsState.areas.push(normalizeArea(result.data || {}));
      }

      closeAreaModal();
      renderAreas();
    } catch (error) {
      window.alert(error.message);
    } finally {
      fsState.isSubmitting = false;
      setAreaSubmitLoading(false);
    }
  });

  renderAreas();
</script>
@endsection
