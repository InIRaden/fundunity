<?php $__env->startSection('admin-content'); ?>
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Manajemen Admin</h2>
            <p class="text-sm text-slate-400 font-medium">Buat dan kelola akun administrator FundUnity</p>
        </div>
        <button id="btnTambahAdmin"
            class="flex items-center gap-2 px-5 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 transition-all shadow-md shadow-admin-200">
            <i class="ph ph-plus-circle text-lg"></i> Tambah Admin Baru
        </button>
    </div>

    <!-- Info Banner -->
    <div class="flex items-start gap-3 p-4 bg-amber-50 border border-amber-200 rounded-2xl">
        <i class="ph ph-warning text-amber-600 text-xl flex-shrink-0 mt-0.5"></i>
        <div>
            <p class="text-sm font-bold text-amber-900">Informasi Keamanan</p>
            <p class="text-xs text-amber-700 mt-0.5">Kata sandi sementara hanya ditampilkan <strong>sekali</strong> saat akun dibuat. Salin dan kirimkan ke admin melalui WhatsApp atau pesan pribadi. Reset sandi hanya tersedia selama admin belum mengganti sandinya sendiri.</p>
        </div>
    </div>

    <!-- Tabel Admin -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-700">Daftar Akun Admin <span class="ml-2 bg-slate-100 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full"><?php echo e($admins->count()); ?></span></h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Admin</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status Sandi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="adminTableBody">
                    <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50/50 transition-colors" id="admin-row-<?php echo e($admin->id); ?>">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-admin-100 flex items-center justify-center text-admin-700 font-black text-sm">
                                    <?php echo e(strtoupper(substr($admin->name, 0, 1))); ?>

                                </div>
                                <span class="font-bold text-slate-800"><?php echo e($admin->name); ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-medium"><?php echo e($admin->email); ?></td>
                        <td class="px-6 py-4">
                            <?php if($admin->must_change_password): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold">
                                    <i class="ph ph-clock text-sm"></i> Belum Ganti Sandi
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-admin-100 text-admin-700 text-xs font-bold">
                                    <i class="ph ph-shield-check text-sm"></i> Aktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-xs font-medium">
                            <?php echo e($admin->created_at->format('d M Y')); ?>

                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <?php if($admin->must_change_password): ?>
                                    <button
                                        onclick="resetPassword(<?php echo e($admin->id); ?>, '<?php echo e($admin->name); ?>')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition-all">
                                        <i class="ph ph-arrow-clockwise text-sm"></i> Reset Sandi
                                    </button>
                                <?php else: ?>
                                    <span class="text-xs text-slate-300 font-medium italic px-3 py-1.5">Sandi Terkunci</span>
                                <?php endif; ?>
                                <button
                                    onclick="deleteAdmin(<?php echo e($admin->id); ?>, '<?php echo e($admin->name); ?>')"
                                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-rose-600 bg-rose-50 border border-rose-200 rounded-lg hover:bg-rose-100 transition-all">
                                    <i class="ph ph-trash text-sm"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                    <i class="ph ph-users text-2xl text-slate-300"></i>
                                </div>
                                <p class="text-slate-400 font-medium text-sm">Belum ada akun admin yang dibuat.</p>
                                <button onclick="document.getElementById('btnTambahAdmin').click()" class="text-admin-600 hover:text-admin-700 text-sm font-bold">+ Tambah Admin Sekarang</button>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin -->
<div id="modalTambahAdmin" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 animate-scale-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-black text-slate-900">Tambah Admin Baru</h3>
            <button onclick="closeModal('modalTambahAdmin')" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
        </div>
        <form id="formTambahAdmin" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap</label>
                <input type="text" id="inputNama" placeholder="cth: Budi Santoso" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20 focus:border-admin-400">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1.5">Alamat Email</label>
                <input type="email" id="inputEmail" placeholder="admin@fundunity.id" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20 focus:border-admin-400">
            </div>
            <div id="formError" class="hidden text-xs font-bold text-rose-600 bg-rose-50 border border-rose-100 px-4 py-2 rounded-xl"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalTambahAdmin')"
                    class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50">Batal</button>
                <button type="submit" id="btnSubmitAdmin"
                    class="flex-1 px-4 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 flex items-center justify-center gap-2">
                    <i class="ph ph-plus"></i>
                    <span id="btnSubmitAdminLabel">Buat Akun</span>
                    <svg id="btnSubmitAdminSpinner" class="hidden animate-spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Kredensial (Pop-up SEKALI) -->
<div id="modalKredensial" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-6">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-admin-100">
                <i class="ph ph-key text-2xl text-admin-600"></i>
            </div>
            <h3 class="text-lg font-black text-slate-900 mb-1">Akun Berhasil Dibuat!</h3>
            <p class="text-xs text-slate-500 font-medium">Salin kredensial ini dan kirimkan ke admin. Kata sandi <strong class="text-rose-600">tidak akan ditampilkan lagi</strong> setelah pop-up ini ditutup.</p>
        </div>

        <div class="bg-slate-50 rounded-2xl border border-slate-200 p-5 space-y-3 mb-5">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama</p>
                <p id="credName" class="font-bold text-slate-800 text-sm"></p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Email</p>
                <p id="credEmail" class="font-bold text-slate-800 text-sm"></p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kata Sandi Sementara</p>
                <div class="flex items-center gap-2">
                    <code id="credPassword" class="flex-1 font-black text-admin-700 text-base bg-admin-50 px-3 py-1.5 rounded-lg border border-admin-200 tracking-widest"></code>
                </div>
            </div>
        </div>

        <div class="text-center mb-3">
            <p class="text-[11px] text-amber-600 font-bold bg-amber-50 border border-amber-200 rounded-xl px-4 py-2">
                <i class="ph ph-info"></i> Admin wajib mengganti sandi saat login pertama kali.
            </p>
        </div>

        <div class="flex gap-3">
            <button id="btnCopyKredensial" onclick="copyKredensial()"
                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 transition-all">
                <i class="ph ph-copy text-base"></i> Salin Kredensial
            </button>
            <button onclick="closeModal('modalKredensial'); window.location.reload()"
                class="flex-1 px-4 py-3 border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all">
                Tutup & Refresh
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    .animate-scale-in { animation: scale-in 0.2s ease-out; }
</style>

<script>
const csrfToken = <?php echo json_encode(csrf_token(), 15, 512) ?>;
const endpoints = {
    store: <?php echo json_encode(route('admin.management.store'), 15, 512) ?>,
    resetPrefix: '/admin/management/',
    deletePrefix: '/admin/management/',
};

let currentCredentials = {};

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('flex');
    document.getElementById(id).classList.add('hidden');
}

document.getElementById('btnTambahAdmin').addEventListener('click', () => {
    document.getElementById('inputNama').value = '';
    document.getElementById('inputEmail').value = '';
    document.getElementById('formError').classList.add('hidden');
    openModal('modalTambahAdmin');
});

document.getElementById('formTambahAdmin').addEventListener('submit', async function (e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmitAdmin');
    const label = document.getElementById('btnSubmitAdminLabel');
    const spinner = document.getElementById('btnSubmitAdminSpinner');
    const err = document.getElementById('formError');
    err.classList.add('hidden');
    btn.disabled = true;
    if (label) label.textContent = 'Memproses...';
    if (spinner) spinner.classList.remove('hidden');

    try {
        const res = await fetch(endpoints.store, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({
                name: document.getElementById('inputNama').value,
                email: document.getElementById('inputEmail').value,
            }),
        });
        const data = await res.json();
        if (!res.ok) {
            const msg = data.errors ? Object.values(data.errors)[0][0] : (data.message || 'Gagal membuat akun.');
            err.textContent = msg;
            err.classList.remove('hidden');
            return;
        }

        closeModal('modalTambahAdmin');
        currentCredentials = data;
        showKredensial(data.admin.name, data.admin.email, data.password);
    } catch (ex) {
        err.textContent = 'Terjadi kesalahan. Coba lagi.';
        err.classList.remove('hidden');
    } finally {
        btn.disabled = false;
        if (label) label.textContent = 'Buat Akun';
        if (spinner) spinner.classList.add('hidden');
    }
});

function showKredensial(name, email, password) {
    document.getElementById('credName').textContent = name;
    document.getElementById('credEmail').textContent = email;
    document.getElementById('credPassword').textContent = password;
    currentCredentials = { name, email, password };
    openModal('modalKredensial');
}

function copyKredensial() {
    const text = `Kredensial Admin FundUnity\nNama: ${currentCredentials.name}\nEmail: ${currentCredentials.email}\nKata Sandi: ${currentCredentials.password}\n\nSilakan login di: <?php echo e(url('/login')); ?>\nGanti kata sandi Anda setelah login pertama.`;
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('btnCopyKredensial');
        btn.innerHTML = '<i class="ph ph-check-circle text-base"></i> Tersalin!';
        btn.classList.replace('bg-admin-600', 'bg-admin-800');
        setTimeout(() => {
            btn.innerHTML = '<i class="ph ph-copy text-base"></i> Salin Kredensial';
            btn.classList.replace('bg-admin-800', 'bg-admin-600');
        }, 2500);
    });
}

async function resetPassword(adminId, adminName) {
    if (!confirm(`Reset sandi sementara untuk "${adminName}"? Sandi acak baru akan dibuat.`)) return;

    // Cari button reset milik admin ini dan tampilkan loading
    const resetBtn = document.querySelector(`#admin-row-${adminId} button[onclick*='resetPassword']`);
    const originalHtml = resetBtn ? resetBtn.innerHTML : '';
    if (resetBtn) {
        resetBtn.disabled = true;
        resetBtn.innerHTML = '<svg class="animate-spin inline-block" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg> Mereset...';
    }

    try {
        const res = await fetch(`/admin/management/${adminId}/reset-password`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        });
        const data = await res.json();
        if (!res.ok) { alert(data.message || 'Gagal mereset sandi.'); return; }
        showKredensial(data.admin.name, data.admin.email, data.password);
    } catch {
        alert('Terjadi kesalahan. Coba lagi.');
    } finally {
        if (resetBtn) {
            resetBtn.disabled = false;
            resetBtn.innerHTML = originalHtml;
        }
    }
}

async function deleteAdmin(adminId, adminName) {
    if (!confirm(`Hapus akun admin "${adminName}"? Tindakan ini tidak dapat dibatalkan.`)) return;

    // Tampilkan loading di baris admin
    const deleteBtn = document.querySelector(`#admin-row-${adminId} button[onclick*='deleteAdmin']`);
    if (deleteBtn) {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<svg class="animate-spin inline-block" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg> Menghapus...';
    }

    try {
        const res = await fetch(`/admin/management/${adminId}`, {
            method: 'DELETE',
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        });
        const data = await res.json();
        if (!res.ok) { alert(data.message || 'Gagal menghapus akun.'); return; }
        const row = document.getElementById(`admin-row-${adminId}`);
        if (row) {
            row.style.transition = 'opacity 0.3s';
            row.style.opacity = '0';
            setTimeout(() => row.remove(), 300);
        }
    } catch {
        alert('Terjadi kesalahan. Coba lagi.');
        if (deleteBtn) {
            deleteBtn.disabled = false;
            deleteBtn.innerHTML = '<i class="ph ph-trash text-sm"></i> Hapus';
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/management.blade.php ENDPATH**/ ?>