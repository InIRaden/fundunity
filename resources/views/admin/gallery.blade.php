@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6 max-w-[1400px] mx-auto w-full">
  <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
    <div class="relative w-full sm:w-96">
      <i class="ph ph-magnifying-glass text-[18px] absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500"></i>
      <input id="gallerySearch" type="text" placeholder="Cari dokumentasi..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
    </div>
    <button id="openGalleryModal" class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-600/20 transition-all whitespace-nowrap">
      <i class="ph ph-plus text-[18px]"></i> Tambah Foto Aktivitas
    </button>
  </div>

  <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
</div>

<div id="galleryModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm animate-fade-in shadow-2xl">
  <div class="bg-white rounded-[32px] w-full max-w-xl overflow-hidden shadow-2xl border border-slate-100 animate-slide-up">
    <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-emerald-50/30">
      <div>
        <h3 class="text-xl font-bold text-slate-800">Dokumentasi Baru</h3>
        <p class="text-sm text-slate-500 mt-0.5">Unggah bukti kegiatan lapangan untuk transparansi publik.</p>
      </div>
      <button id="closeGalleryModal" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white shadow-sm border border-slate-100 text-slate-400 hover:text-emerald-600 transition-all"><i class="ph ph-x text-xl"></i></button>
    </div>

    <form id="galleryForm">
      <div class="p-8 space-y-6">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Judul Aktivitas</label>
          <input id="galleryTitle" required class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner placeholder:text-slate-300" placeholder="Cth: Penyerahan Beasiswa Tahap II">
        </div>

        <div class="grid grid-cols-2 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Kategori</label>
            <select id="galleryCategory" class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 transition-all font-semibold text-slate-700">
              <option>Pendidikan</option>
              <option>Kesehatan</option>
              <option>Bencana Alam</option>
              <option>Infrastruktur</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Tanggal Kegiatan</label>
            <input id="galleryDate" type="date" class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 transition-all font-semibold">
          </div>
        </div>

        <div class="relative group">
          <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Unggah Foto Utama</label>
          <div class="border-2 border-dashed border-slate-200 rounded-[32px] p-10 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50 group-hover:border-emerald-300 transition-all cursor-pointer">
            <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-emerald-500 shadow-xl border border-emerald-50 mb-4 group-hover:scale-110 transition-transform"><i class="ph ph-images-square text-[32px]"></i></div>
            <p class="text-sm font-bold text-slate-700 mb-1">Pilih Berkas Gambar</p>
            <p class="text-xs text-slate-400 font-medium text-center">Seret foto ke sini atau telusuri folder.<br>Format JPG, PNG (Max. 5MB)</p>
          </div>
        </div>
      </div>

      <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" id="cancelGalleryModal" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">Tutup</button>
        <button type="submit" class="px-10 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-sm font-bold shadow-xl shadow-emerald-600/30 transition-all hover:scale-[1.02] active:scale-[0.98]">Simpan Dokumentasi</button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
  @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
  .animate-slide-up { animation: slideUp 0.4s ease-out forwards; }
</style>

<script>
  const galleryState = { items: @json($galleryImages), search: '' };

  function filteredGallery() {
    const q = galleryState.search.toLowerCase();
    return galleryState.items.filter((item) => item.title.toLowerCase().includes(q) || item.category.toLowerCase().includes(q));
  }

  function renderGallery() {
    document.getElementById('galleryGrid').innerHTML = filteredGallery().map((item) => `
      <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
        <div class="aspect-video relative overflow-hidden">
          <img src="${item.imageUrl}" alt="${item.title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
          <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity"><button class="p-2 bg-rose-600 text-white rounded-xl shadow-lg hover:bg-rose-700 transition-colors" onclick="deleteGallery(${item.id})"><i class="ph ph-trash text-base"></i></button></div>
          <div class="absolute bottom-3 left-3 flex gap-2"><span class="text-[10px] bg-white/90 backdrop-blur-md text-emerald-700 font-bold px-2 py-1 rounded-lg flex items-center gap-1 shadow-sm"><i class="ph ph-tag text-xs"></i>${item.category}</span></div>
        </div>
        <div class="p-5">
          <h3 class="font-bold text-slate-800 text-base mb-2 group-hover:text-emerald-600 transition-colors">${item.title}</h3>
          <div class="flex items-center justify-between"><p class="text-xs text-slate-500 flex items-center gap-1.5 font-medium"><i class="ph ph-calendar-blank text-sm text-emerald-400"></i> ${item.date || '-'}</p><button class="text-[10px] font-bold text-emerald-600 hover:underline">Edit Detail</button></div>
        </div>
      </div>
    `).join('');
  }

  function openGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }

  function deleteGallery(id) {
    galleryState.items = galleryState.items.filter((i) => i.id !== id);
    renderGallery();
  }

  document.getElementById('gallerySearch').addEventListener('input', function (e) { galleryState.search = e.target.value; renderGallery(); });
  document.getElementById('openGalleryModal').addEventListener('click', openGalleryModal);
  document.getElementById('closeGalleryModal').addEventListener('click', closeGalleryModal);
  document.getElementById('cancelGalleryModal').addEventListener('click', closeGalleryModal);
  document.getElementById('galleryForm').addEventListener('submit', function (e) {
    e.preventDefault();
    galleryState.items.unshift({
      id: Date.now(),
      title: document.getElementById('galleryTitle').value,
      category: document.getElementById('galleryCategory').value,
      date: document.getElementById('galleryDate').value,
      imageUrl: '',
    });
    closeGalleryModal();
    renderGallery();
  });

  renderGallery();
</script>
@endsection
