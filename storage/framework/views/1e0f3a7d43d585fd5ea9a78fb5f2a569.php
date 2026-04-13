<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div class="relative w-full md:w-96">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><i class="ph ph-magnifying-glass text-[18px] text-emerald-500"></i></div>
        <input id="faqSearch" type="text" placeholder="Cari FAQ..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
      </div>
      <button id="openFaqModal" class="flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-medium hover:bg-emerald-700 transition-colors shadow-sm">
        <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah FAQ</span>
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-center text-[11px] font-medium text-white uppercase tracking-widest border-b border-emerald-100/50 w-16">No</th>
            <th class="py-4 px-6 text-left text-[11px] font-medium text-white uppercase tracking-widest border-b border-emerald-100/50">Pertanyaan (Q)</th>
            <th class="py-4 px-6 text-left text-[11px] font-medium text-white uppercase tracking-widest border-b border-emerald-100/50">Jawaban (A)</th>
            <th class="py-4 px-6 text-center text-[11px] font-medium text-white uppercase tracking-widest border-b border-emerald-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="faqRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>
    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100"><span id="faqCount" class="text-xs text-slate-400"></span></div>
  </div>
</div>

<div id="faqModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden animate-scale-in">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 id="faqModalTitle" class="text-base font-medium text-slate-900">Tambah FAQ Baru</h3>
      <button id="closeFaqModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="faqForm">
      <div class="p-6 space-y-5">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Pertanyaan (Tanya)</label>
          <textarea id="faqQuestion" required rows="2" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20 resize-none leading-relaxed" placeholder="Ketik pertanyaan umum..."></textarea>
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Jawaban (Jawab)</label>
          <textarea id="faqAnswer" required rows="4" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20 resize-none leading-relaxed" placeholder="Jelaskan rincian jawabannya di sini..."></textarea>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" id="cancelFaqModal" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button type="submit" id="submitFaqModal" class="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 shadow-sm transition-all hover:scale-105 active:scale-95">Tambahkan</button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const faqState = { faqs: <?php echo json_encode($faqs, 15, 512) ?>, search: '', editingId: null };

  function filteredFaqs() {
    const q = faqState.search.toLowerCase();
    return faqState.faqs.filter((f) => f.question.toLowerCase().includes(q) || f.answer.toLowerCase().includes(q));
  }

  function renderFaqRows() {
    const data = filteredFaqs();
    document.getElementById('faqRows').innerHTML = data.length ? data.map((f, i) => `
      <tr class="hover:bg-slate-50/50 transition-colors group">
        <td class="py-5 px-6 text-center"><span class="text-sm text-slate-400">${String(i + 1).padStart(2, '0')}</span></td>
        <td class="py-5 px-6"><h3 class="text-sm text-slate-900 line-clamp-2">${f.question}</h3></td>
        <td class="py-5 px-6"><p class="text-sm text-slate-500 line-clamp-2 max-w-md">${f.answer}</p></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="editFaq(${f.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteFaq(${f.id})">Hapus</button></div></td>
      </tr>
    `).join('') : '<tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 text-sm">FAQ Tidak Ditemukan.</td></tr>';
    document.getElementById('faqCount').textContent = 'Menampilkan ' + data.length + ' baris data';
  }

  function openFaqModal(item) {
    const modal = document.getElementById('faqModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (item) {
      faqState.editingId = item.id;
      document.getElementById('faqModalTitle').textContent = 'Edit FAQ';
      document.getElementById('submitFaqModal').textContent = 'Konfirmasi Update';
      document.getElementById('faqQuestion').value = item.question;
      document.getElementById('faqAnswer').value = item.answer;
    } else {
      faqState.editingId = null;
      document.getElementById('faqModalTitle').textContent = 'Tambah FAQ Baru';
      document.getElementById('submitFaqModal').textContent = 'Tambahkan';
      document.getElementById('faqForm').reset();
    }
  }

  function closeFaqModal() {
    const modal = document.getElementById('faqModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  function editFaq(id) {
    const found = faqState.faqs.find((f) => f.id === id);
    if (found) openFaqModal(found);
  }

  function deleteFaq(id) {
    if (window.confirm('Apakah Anda yakin ingin menghapus pertanyaan ini dari daftar FAQ?')) {
      faqState.faqs = faqState.faqs.filter((f) => f.id !== id);
      renderFaqRows();
    }
  }

  document.getElementById('faqSearch').addEventListener('input', function (e) { faqState.search = e.target.value; renderFaqRows(); });
  document.getElementById('openFaqModal').addEventListener('click', () => openFaqModal(null));
  document.getElementById('closeFaqModal').addEventListener('click', closeFaqModal);
  document.getElementById('cancelFaqModal').addEventListener('click', closeFaqModal);
  document.getElementById('faqForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const payload = { question: document.getElementById('faqQuestion').value, answer: document.getElementById('faqAnswer').value };
    if (faqState.editingId) faqState.faqs = faqState.faqs.map((f) => f.id === faqState.editingId ? { ...f, ...payload } : f);
    else faqState.faqs.unshift({ id: Date.now(), ...payload });
    closeFaqModal();
    renderFaqRows();
  });

  renderFaqRows();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/faqs.blade.php ENDPATH**/ ?>