@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
      <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">Daftar FAQ</h2>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-admin-500"></i>
          <input id="faqSearch" type="text" placeholder="Cari FAQ..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-admin-500 text-admin-900 rounded-xl text-sm focus:ring-4 focus:ring-admin-500/20 outline-none transition-all placeholder:text-admin-500/50 shadow-sm">
        </div>
        <button id="openFaqModal" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-admin-600 text-white rounded-lg text-xs font-bold hover:bg-admin-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah FAQ</span>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-admin-600">
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-admin-100/50 w-16">No</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50">Pertanyaan (Q)</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50">Jawaban (A)</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-admin-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="faqRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>
    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100"><span id="faqCount" class="text-xs text-slate-400"></span></div>
  </div>
</div>

<div id="faqModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4 overflow-y-auto">
  <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full flex flex-col max-h-[90vh] my-auto animate-scale-in overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 id="faqModalTitle" class="text-base font-bold text-admin-700">Tambah FAQ Baru</h3>
      <button id="closeFaqModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="faqForm" class="flex flex-col flex-1 overflow-hidden">
      <div class="p-6 space-y-5 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Pertanyaan (Tanya)</label>
          <textarea id="faqQuestion" required rows="2" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20 resize-none leading-relaxed" placeholder="Ketik pertanyaan umum..."></textarea>
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Jawaban (Jawab)</label>
          <textarea id="faqAnswer" required rows="4" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20 resize-none leading-relaxed" placeholder="Jelaskan rincian jawabannya di sini..."></textarea>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
        <button type="button" id="cancelFaqModal" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button type="submit" id="submitFaqModal" class="px-6 py-2 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 shadow-sm transition-all hover:scale-105 active:scale-95">Tambahkan</button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const faqStoreUrl = @json(route('admin.faqs.store'));
  const faqBaseUrl = @json(url('/admin/faqs'));

  function normalizeFaq(raw = {}) {
    return {
      id: raw.id,
      question: raw.question || '',
      answer: raw.answer || '',
    };
  }

  const faqState = {
    faqs: (@json($faqs) || []).map((item) => normalizeFaq(item)),
    search: '',
    editingId: null,
    isSubmitting: false,
    isDeleting: false,
  };

  async function requestFaq(url, method, payload) {
    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload),
    });

    const result = await response.json().catch(() => ({}));

    if (!response.ok) {
      const validationErrors = result.errors ? Object.values(result.errors).flat().join('\n') : null;
      throw new Error(validationErrors || result.message || 'Permintaan gagal diproses.');
    }

    return result;
  }

  function filteredFaqs() {
    const q = faqState.search.toLowerCase();
    return faqState.faqs.filter((f) => f.question.toLowerCase().includes(q) || f.answer.toLowerCase().includes(q));
  }

  function setSubmitLoading(loading) {
    const button = document.getElementById('submitFaqModal');
    if (!button) {
      return;
    }

    if (loading) {
      button.dataset.originalLabel = button.textContent;
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.textContent = faqState.editingId ? 'Menyimpan...' : 'Menambahkan...';
      return;
    }

    button.disabled = false;
    button.classList.remove('opacity-70', 'cursor-not-allowed');
    if (button.dataset.originalLabel) {
      button.textContent = button.dataset.originalLabel;
    }
  }

  function setDeleteButtonLoading(button, loading) {
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

  function renderFaqRows() {
    const data = filteredFaqs();
    document.getElementById('faqRows').innerHTML = data.length ? data.map((f, i) => `
      <tr class="hover:bg-slate-50/50 transition-colors group">
        <td class="py-5 px-6 text-center"><span class="text-sm text-slate-400">${String(i + 1).padStart(2, '0')}</span></td>
        <td class="py-5 px-6"><h3 class="text-sm text-slate-900 line-clamp-2">${f.question}</h3></td>
        <td class="py-5 px-6"><p class="text-sm text-slate-500 line-clamp-2 max-w-md">${f.answer}</p></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-admin-600 text-white rounded-lg text-[11px] hover:bg-admin-700 transition-colors" onclick="editFaq(${f.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteFaq(${f.id}, this)">Hapus</button></div></td>
      </tr>
    `).join('') : emptyTableRow(4);
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
      return;
    }

    faqState.editingId = null;
    document.getElementById('faqModalTitle').textContent = 'Tambah FAQ Baru';
    document.getElementById('submitFaqModal').textContent = 'Tambahkan';
    document.getElementById('faqForm').reset();
  }

  function closeFaqModal() {
    const modal = document.getElementById('faqModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    faqState.isSubmitting = false;
    setSubmitLoading(false);
  }

  function editFaq(id) {
    const found = faqState.faqs.find((f) => f.id === id);
    if (found) {
      openFaqModal(found);
    }
  }

  function deleteFaq(id, triggerButton) {
    if (faqState.isDeleting) {
      return;
    }

    if (!window.confirm('Apakah Anda yakin ingin menghapus pertanyaan ini dari daftar FAQ?')) {
      return;
    }

    faqState.isDeleting = true;
    setDeleteButtonLoading(triggerButton, true);

    requestFaq(`${faqBaseUrl}/${id}`, 'DELETE', {})
      .then(() => {
        faqState.faqs = faqState.faqs.filter((f) => f.id !== id);
        renderFaqRows();
      })
      .catch((error) => {
        window.alert(error.message);
      })
      .finally(() => {
        faqState.isDeleting = false;
        setDeleteButtonLoading(triggerButton, false);
      });
  }

  document.getElementById('faqSearch').addEventListener('input', function (e) {
    faqState.search = e.target.value;
    renderFaqRows();
  });

  document.getElementById('openFaqModal').addEventListener('click', () => openFaqModal(null));
  document.getElementById('closeFaqModal').addEventListener('click', closeFaqModal);
  document.getElementById('cancelFaqModal').addEventListener('click', closeFaqModal);
  document.getElementById('faqForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (faqState.isSubmitting) {
      return;
    }

    const payload = {
      question: document.getElementById('faqQuestion').value,
      answer: document.getElementById('faqAnswer').value,
    };

    faqState.isSubmitting = true;
    setSubmitLoading(true);

    try {
      if (faqState.editingId) {
        const result = await requestFaq(`${faqBaseUrl}/${faqState.editingId}`, 'PUT', payload);
        const normalized = normalizeFaq(result.data || {});
        faqState.faqs = faqState.faqs.map((f) => f.id === faqState.editingId ? normalized : f);
      } else {
        const result = await requestFaq(faqStoreUrl, 'POST', payload);
        const normalized = normalizeFaq(result.data || {});
        faqState.faqs.unshift(normalized);
      }

      closeFaqModal();
      renderFaqRows();
    } catch (error) {
      window.alert(error.message);
      faqState.isSubmitting = false;
      setSubmitLoading(false);
    }
  });

  renderFaqRows();
</script>
@endsection
