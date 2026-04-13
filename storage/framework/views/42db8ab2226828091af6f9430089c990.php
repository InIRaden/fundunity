<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="flex flex-col relative">
    <div class="flex items-end gap-1.5 relative z-20 -mb-[1px]">
      <button id="allTab" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Semua Kotak</button>
      <button id="unreadTab" class="flex items-center gap-2 px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Belum Dibaca <span id="unreadBadge" class="w-5 h-5 rounded-full flex items-center justify-center text-[10px]"></span></button>
    </div>

    <div class="bg-white border border-slate-200 shadow-xl shadow-slate-200/40 rounded-b-2xl rounded-tr-2xl overflow-hidden relative z-10 flex flex-col min-h-[400px]">
      <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
        <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">Daftar Kotak Masuk <span id="messageCount" class="bg-slate-100 text-slate-500 text-xs px-2 py-0.5 rounded-full"></span></h2>
        <div class="relative w-full md:w-96">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><i class="ph ph-magnifying-glass text-[18px] text-emerald-500"></i></div>
          <input id="messageSearch" type="text" placeholder="Cari pengirim atau pesan..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
        </div>
      </div>

      <div id="messageEmpty" class="hidden text-center py-40 px-4">
        <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100"><i class="ph ph-envelope text-[28px]"></i></div>
        <h3 class="text-slate-800 font-bold text-lg mb-1">Tidak Ada Pesan</h3>
        <p class="text-slate-500 text-sm">Kotak masuk Anda sedang kosong.</p>
      </div>

      <div id="messageTableWrap" class="overflow-x-auto min-h-[500px]">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-emerald-600">
              <th class="w-10 px-6 py-4 border-b border-emerald-100/50"></th>
              <th class="px-6 py-4 text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Pengirim</th>
              <th class="px-6 py-4 text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Cuplikan Pesan</th>
              <th class="px-6 py-4 text-[11px] font-semibold text-white uppercase tracking-widest text-right border-b border-emerald-100/50">Tanggal Masuk</th>
              <th class="px-6 py-4 text-[11px] font-semibold text-white uppercase tracking-widest text-center border-b border-emerald-100/50">Aksi</th>
            </tr>
          </thead>
          <tbody id="messageRows" class="divide-y divide-slate-100"></tbody>
        </table>
      </div>

      <div id="messageFooter" class="px-5 py-3 bg-slate-50/50 border-t border-slate-100 mt-auto"><span id="messageFooterText" class="text-xs text-slate-400 font-medium"></span></div>
    </div>
  </div>
</div>

<div id="messageModal" class="hidden fixed inset-0 z-50 items-center justify-center p-4">
  <div id="modalBackdrop" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
  <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden animate-fade-in flex flex-col max-h-[90vh]">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50 shrink-0">
      <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2 uppercase tracking-wider"><i class="ph ph-envelope-open text-emerald-600 text-lg"></i> Detail Pesan Masuk</h2>
      <button id="closeMessageModal" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-colors"><i class="ph ph-x text-lg"></i></button>
    </div>

    <div class="p-8 space-y-6 overflow-y-auto">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
        <div class="flex items-center gap-4">
          <div id="modalInitial" class="w-12 h-12 bg-emerald-100 text-emerald-700 font-bold rounded-full flex items-center justify-center text-lg uppercase shrink-0"></div>
          <div>
            <h3 id="modalName" class="text-lg font-bold text-slate-900 leading-tight"></h3>
            <a id="modalEmail" href="#" class="text-sm text-emerald-600 hover:underline"></a>
          </div>
        </div>
        <div id="modalDate" class="text-xs font-semibold text-slate-400 flex items-center gap-1.5 shrink-0 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100/60"></div>
      </div>
      <div><p id="modalBody" class="whitespace-pre-wrap leading-relaxed text-slate-700"></p></div>
    </div>

    <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
      <button id="modalCloseBtn" class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors shadow-sm">Tutup</button>
      <a id="modalReply" href="#" class="px-5 py-2.5 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/20 flex items-center gap-2">Balas via Email <i class="ph ph-arrow-up-right text-base"></i></a>
    </div>
  </div>
</div>

<script>
  const messageBaseUrl = <?php echo json_encode(url('/admin/messages'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  function normalizeMessage(m) {
    return {
      id: Number(m.id),
      name: m.name || m.sender_name || 'Pengirim',
      email: m.email || m.sender_email || '-',
      message: m.message || '',
      isRead: Boolean(m.isRead ?? m.is_read),
      date: m.date || '-',
      created_at: m.created_at || null,
    };
  }

  const ms = {
    filter: 'all',
    search: '',
    selected: null,
    messages: (<?php echo json_encode($messages, 15, 512) ?> || []).map(normalizeMessage),
  };

  async function requestMessage(url, method, payload = {}) {
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
      throw new Error(firstError || json.message || 'Terjadi kesalahan saat memproses pesan.');
    }

    return json;
  }

  function upsertMessage(rawMessage) {
    const normalized = normalizeMessage(rawMessage);
    ms.messages = ms.messages.map((message) => message.id === normalized.id ? normalized : message);

    if (ms.selected && ms.selected.id === normalized.id) {
      ms.selected = normalized;
    }
  }

  function getFiltered() {
    return ms.messages.filter((msg) => {
      const matchFilter = ms.filter === 'unread' ? !msg.isRead : true;
      const q = ms.search.toLowerCase();
      const matchSearch = msg.name.toLowerCase().includes(q) || msg.email.toLowerCase().includes(q) || msg.message.toLowerCase().includes(q);
      return matchFilter && matchSearch;
    });
  }

  function unreadCount() {
    return ms.messages.filter((m) => !m.isRead).length;
  }

  function renderTabs() {
    const all = document.getElementById('allTab');
    const unread = document.getElementById('unreadTab');
    const on = 'bg-emerald-600 text-white border-slate-200 border-b-transparent z-30';
    const off = 'bg-gray-50 border-transparent text-slate-400 hover:text-emerald-600 hover:bg-white z-10 border-b-slate-200';
    all.className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (ms.filter === 'all' ? on : off);
    unread.className = 'flex items-center gap-2 px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (ms.filter === 'unread' ? on : off);

    const count = unreadCount();
    const badge = document.getElementById('unreadBadge');
    badge.textContent = String(count);
    badge.className = 'w-5 h-5 rounded-full flex items-center justify-center text-[10px] ' + (ms.filter === 'unread' ? 'bg-white text-emerald-700' : 'bg-rose-500 text-white');
    badge.style.display = count > 0 ? 'inline-flex' : 'none';
  }

  async function toggleRead(id, button) {
    const current = ms.messages.find((m) => m.id === id);
    if (!current) return;

    const originalHtml = button?.innerHTML;
    if (button) {
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.innerHTML = '<i class="ph ph-spinner-gap animate-spin text-[20px]"></i>';
    }

    try {
      const result = await requestMessage(`${messageBaseUrl}/${id}`, 'PUT', { is_read: !current.isRead });
      upsertMessage(result.data || { ...current, is_read: !current.isRead });
      renderAll();
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

  async function markReadSilently(id) {
    const current = ms.messages.find((m) => m.id === id);
    if (!current || current.isRead) {
      return;
    }

    current.isRead = true;
    renderAll();

    try {
      const result = await requestMessage(`${messageBaseUrl}/${id}`, 'PUT', { is_read: true });
      upsertMessage(result.data || current);
      renderAll();
    } catch (error) {
      current.isRead = false;
      renderAll();
    }
  }

  async function deleteMsg(id, button) {
    if (window.confirm('Apakah Anda yakin ingin menghapus pesan ini secara permanen?')) {
      const originalHtml = button?.innerHTML;

      if (button) {
        button.disabled = true;
        button.classList.add('opacity-70', 'cursor-not-allowed');
        button.innerHTML = '<i class="ph ph-spinner-gap animate-spin text-base"></i>';
      }

      try {
        await requestMessage(`${messageBaseUrl}/${id}`, 'DELETE', {});
        ms.messages = ms.messages.filter((m) => m.id !== id);
        if (ms.selected && ms.selected.id === id) closeModal();
        renderAll();
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
  }

  function openModal(id) {
    const msg = ms.messages.find((m) => m.id === id);
    if (!msg) return;
    if (!msg.isRead) {
      markReadSilently(msg.id);
    }
    ms.selected = msg;
    document.getElementById('modalInitial').textContent = msg.name.charAt(0);
    document.getElementById('modalName').textContent = msg.name;
    document.getElementById('modalEmail').textContent = msg.email;
    document.getElementById('modalEmail').href = 'mailto:' + msg.email;
    document.getElementById('modalReply').href = 'mailto:' + msg.email;
    document.getElementById('modalDate').innerHTML = '<i class="ph ph-calendar-blank text-sm"></i> ' + msg.date;
    document.getElementById('modalBody').textContent = msg.message;
    const modal = document.getElementById('messageModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    renderAll();
  }

  function closeModal() {
    const modal = document.getElementById('messageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    ms.selected = null;
  }

  function renderRows() {
    const filtered = getFiltered();
    const tbody = document.getElementById('messageRows');
    if (!filtered.length) {
      document.getElementById('messageEmpty').classList.remove('hidden');
      document.getElementById('messageTableWrap').classList.add('hidden');
      document.getElementById('messageFooter').classList.add('hidden');
      document.getElementById('messageCount').textContent = '0 Pesan';
      return;
    }

    document.getElementById('messageEmpty').classList.add('hidden');
    document.getElementById('messageTableWrap').classList.remove('hidden');
    document.getElementById('messageFooter').classList.remove('hidden');
    document.getElementById('messageCount').textContent = filtered.length + ' Pesan';

    tbody.innerHTML = filtered.map((msg) => `
      <tr class="group cursor-pointer transition-colors ${!msg.isRead ? 'bg-emerald-50/30 hover:bg-emerald-50/70' : 'hover:bg-slate-50/70'}" onclick="openModal(${msg.id})">
        <td class="px-6 py-5 align-top">
          <button onclick="event.stopPropagation(); toggleRead(${msg.id}, this)" class="p-1.5 rounded-md transition-colors ${!msg.isRead ? 'text-emerald-500 hover:bg-emerald-100' : 'text-slate-300 hover:text-slate-500 hover:bg-slate-100'}">
            <i class="ph ${!msg.isRead ? 'ph-envelope' : 'ph-envelope-open'} text-[20px]"></i>
          </button>
        </td>
        <td class="px-6 py-5 align-top"><p class="text-sm ${!msg.isRead ? 'font-bold text-slate-900' : 'font-semibold text-slate-700'}">${msg.name}</p><p class="text-xs text-slate-500 mt-1">${msg.email}</p></td>
        <td class="px-6 py-5 align-top max-w-sm"><p class="text-sm line-clamp-2 leading-relaxed ${!msg.isRead ? 'font-bold text-slate-800' : 'text-slate-600'}">${msg.message}</p></td>
        <td class="px-6 py-5 align-top text-right whitespace-nowrap"><div class="flex items-center justify-end gap-1.5 text-xs text-slate-500"><i class="ph ph-calendar-blank"></i>${msg.date}</div></td>
        <td class="px-6 py-5 align-top"><div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity"><button onclick="event.stopPropagation(); openModal(${msg.id})" class="px-3 py-1.5 bg-emerald-600 text-white font-bold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors">Baca</button><button onclick="event.stopPropagation(); deleteMsg(${msg.id}, this)" class="px-3 py-1.5 bg-rose-600 text-white font-bold rounded-lg text-[11px] hover:bg-rose-700 transition-colors">Hapus</button></div></td>
      </tr>
    `).join('');
    document.getElementById('messageFooterText').textContent = 'Menampilkan ' + filtered.length + ' pesan';
  }

  function renderAll() {
    renderTabs();
    renderRows();
  }

  document.getElementById('allTab').addEventListener('click', () => { ms.filter = 'all'; renderAll(); });
  document.getElementById('unreadTab').addEventListener('click', () => { ms.filter = 'unread'; renderAll(); });
  document.getElementById('messageSearch').addEventListener('input', (e) => { ms.search = e.target.value; renderRows(); });
  document.getElementById('closeMessageModal').addEventListener('click', closeModal);
  document.getElementById('modalCloseBtn').addEventListener('click', closeModal);
  document.getElementById('modalBackdrop').addEventListener('click', closeModal);

  renderAll();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/messages.blade.php ENDPATH**/ ?>