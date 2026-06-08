<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden relative z-10 flex flex-col">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
      <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
        <span>Daftar Anggota Organisasi</span>
        <span id="memberCount" class="bg-slate-100 text-slate-500 text-xs px-2 py-0.5 rounded-full"></span>
      </h2>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-emerald-500"></i>
          <input id="memberSearch" type="text" placeholder="Cari nama atau jabatan..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 border border-emerald-500 text-emerald-900 rounded-xl text-sm bg-white focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
        </div>
        <button id="openMemberAdd" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Anggota</span>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-emerald-100/50">Jabatan</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-emerald-100/50">Nama</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-emerald-100/50">Keterangan</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-emerald-100/50 w-24">Foto</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-emerald-100/50 w-24">Aksi</th>
          </tr>
        </thead>
        <tbody id="memberRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>

    <div id="memberFooter" class="px-5 py-3 bg-slate-50/50 border-t border-slate-100 mt-auto">
      <span id="memberFooterText" class="text-xs text-slate-400 font-medium"></span>
    </div>
  </div>
</div>




<?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['id' => 'memberEditModal','title' => 'Edit Anggota','maxWidth' => 'max-w-lg','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeMemberEdit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'memberEditModal','title' => 'Edit Anggota','maxWidth' => 'max-w-lg','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeMemberEdit']); ?>
    <form id="memberEditForm" class="flex flex-col flex-1 overflow-hidden">
      <div class="p-6 space-y-4 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Jabatan</label>
          <input id="editJabatan" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Nama</label>
          <input id="editNama" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Bio / Keterangan</label>
          <textarea id="editDesc" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none"></textarea>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Foto Profil</label>
          <input id="editImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
        </div>
      </div>
      <div class="p-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl shrink-0">
        <button type="button" id="cancelMemberEdit" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="editMemberSubmitBtn" type="submit" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-xl text-sm shadow-md hover:bg-emerald-700">Simpan Perubahan</button>
      </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $attributes = $__attributesOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $component = $__componentOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__componentOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['id' => 'memberAddModal','title' => 'Tambah Anggota','maxWidth' => 'max-w-lg','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeMemberAdd']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'memberAddModal','title' => 'Tambah Anggota','maxWidth' => 'max-w-lg','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeMemberAdd']); ?>
    <form id="memberAddForm" class="flex flex-col flex-1 overflow-hidden">
      <div class="p-6 space-y-4 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Jabatan</label>
          <input id="addJabatan" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="Contoh: Ketua Umum">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Nama</label>
          <input id="addNama" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="Masukkan nama lengkap...">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Bio / Keterangan</label>
          <textarea id="addDesc" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="Tuliskan keterangan singkat..."></textarea>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Foto Profil</label>
          <input id="addImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
        </div>
      </div>
      <div class="p-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl shrink-0">
        <button type="button" id="cancelMemberAdd" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="addMemberSubmitBtn" type="submit" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-xl text-sm shadow-md hover:bg-emerald-700">Simpan Data Baru</button>
      </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $attributes = $__attributesOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $component = $__componentOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__componentOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>

<style>
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const memberStoreUrl = <?php echo json_encode(route('admin.members.store'), 15, 512) ?>;
  const memberBaseUrl = <?php echo json_encode(url('/admin/members'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const memberState = {
    search: '',
    data: (<?php echo json_encode($members ?? [], 15, 512) ?> || []),
    deletingId: null,
    editingId: null,
    isDeleting: false,
    isSubmitting: false,
  };

  function filteredMembers() {
    const q = memberState.search.toLowerCase();
    return memberState.data.filter((item) => {
      const nama = (item.nama || '').toLowerCase();
      const desc = (item.description || '').toLowerCase();
      const jab = (item.jabatan || '').toLowerCase();
      return nama.includes(q) || desc.includes(q) || jab.includes(q);
    });
  }

  async function requestMember(url, method, payload, isFormData = false) {
    const headers = {
      'Accept': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    };
    
    if (!isFormData) {
      headers['Content-Type'] = 'application/json';
    }

    const options = {
      method,
      headers,
    };

    if (payload) {
      options.body = isFormData ? payload : JSON.stringify(payload);
    }

    const response = await fetch(url, options);

    const json = await response.json().catch(() => ({}));
    if (!response.ok) throw new Error(json.message || 'Terjadi kesalahan.');
    return json;
  }

  function renderMemberRows() {
    const data = filteredMembers();
    document.getElementById('memberCount').innerHTML = '<span class="flex items-center gap-1"><i class="ph ph-users text-sm"></i>' + data.length + ' Orang</span>';
    document.getElementById('memberRows').innerHTML = data.length ? data.map((item) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="px-6 py-5 align-top"><span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100"><i class="ph ph-identification-badge"></i> ${item.jabatan}</span></td>
        <td class="px-6 py-5 align-top"><p class="text-sm font-semibold text-slate-800">${item.nama}</p></td>
        <td class="px-6 py-5 align-top max-w-md"><p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">${item.description || '-'}</p></td>
        <td class="px-6 py-5 align-top text-center">${item.imageUrl ? `<div class="w-12 h-12 rounded-lg border border-slate-200 overflow-hidden mx-auto bg-slate-50"><img src="${item.imageUrl}" alt="${item.nama}" class="w-full h-full object-cover"></div>` : `<div class="w-12 h-12 rounded-lg border border-slate-200 border-dashed mx-auto flex items-center justify-center bg-slate-50 text-slate-400"><i class="ph ph-image text-xl"></i></div>`}</td>
        <td class="p-5"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-bold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="openEditMember(${item.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-bold rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="openDeleteMember(${item.id})">Hapus</button></div></td>
      </tr>
    `).join('') : emptyTableRow(5);
    document.getElementById('memberFooterText').textContent = 'Menampilkan ' + data.length + ' data anggota';
  }

  async function openDeleteMember(id) {
    if (memberState.isDeleting) return;
    const isConfirm = await customConfirm('Hapus Anggota?', 'Anda yakin ingin menghapus data anggota ini secara permanen?');
    if (!isConfirm) return;
    
    memberState.isDeleting = true;
    try {
      await requestMember(`${memberBaseUrl}/${id}`, 'DELETE');
      memberState.data = memberState.data.filter(v => v.id !== id);
      renderMemberRows();
      customAlert('Berhasil', 'Anggota berhasil dihapus.');
    } catch (e) { customAlert('Kesalahan', e.message, 'error'); }
    memberState.isDeleting = false;
  }

  function openEditMember(id) {
    const item = memberState.data.find((v) => v.id === id);
    if (!item) return;

    memberState.editingId = id;
    document.getElementById('editJabatan').value = item.jabatan;
    document.getElementById('editNama').value = item.nama;
    document.getElementById('editDesc').value = item.description || '';
    document.getElementById('editImageFile').value = '';

    document.getElementById('memberEditModal').classList.remove('hidden');
    document.getElementById('memberEditModal').classList.add('flex');
  }

  function closeEditMember() {
    document.getElementById('memberEditModal').classList.add('hidden');
    document.getElementById('memberEditModal').classList.remove('flex');
    memberState.editingId = null;
  }

  function openAddMember() {
    document.getElementById('memberAddForm').reset();
    document.getElementById('memberAddModal').classList.remove('hidden');
    document.getElementById('memberAddModal').classList.add('flex');
  }

  function closeAddMember() {
    document.getElementById('memberAddModal').classList.add('hidden');
    document.getElementById('memberAddModal').classList.remove('flex');
  }

  document.getElementById('memberSearch').addEventListener('input', (e) => {
    memberState.search = e.target.value;
    renderMemberRows();
  });

  document.getElementById('openMemberAdd').addEventListener('click', openAddMember);


  document.getElementById('closeMemberEdit').addEventListener('click', closeEditMember);
  document.getElementById('cancelMemberEdit').addEventListener('click', closeEditMember);
  document.getElementById('memberEditForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    if (memberState.isSubmitting || !memberState.editingId) return;
    memberState.isSubmitting = true;
    
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('jabatan', document.getElementById('editJabatan').value);
    formData.append('nama', document.getElementById('editNama').value);
    formData.append('description', document.getElementById('editDesc').value);
    
    const fileInput = document.getElementById('editImageFile');
    if (fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    }

    try {
      const res = await requestMember(`${memberBaseUrl}/${memberState.editingId}`, 'POST', formData, true);
      memberState.data = memberState.data.map(v => v.id === res.data.id ? res.data : v);
      closeEditMember();
      renderMemberRows();
    } catch (e) { alert(e.message); }
    memberState.isSubmitting = false;
  });

  document.getElementById('closeMemberAdd').addEventListener('click', closeAddMember);
  document.getElementById('cancelMemberAdd').addEventListener('click', closeAddMember);
  document.getElementById('memberAddForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    if (memberState.isSubmitting) return;
    memberState.isSubmitting = true;
    
    const formData = new FormData();
    formData.append('jabatan', document.getElementById('addJabatan').value);
    formData.append('nama', document.getElementById('addNama').value);
    formData.append('description', document.getElementById('addDesc').value);
    
    const fileInput = document.getElementById('addImageFile');
    if (fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    }

    try {
      const res = await requestMember(memberStoreUrl, 'POST', formData, true);
      memberState.data.unshift(res.data);
      closeAddMember();
      renderMemberRows();
    } catch (e) { alert(e.message); }
    memberState.isSubmitting = false;
  });

  renderMemberRows();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/members.blade.php ENDPATH**/ ?>