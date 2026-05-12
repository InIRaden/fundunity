@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6">
  <div class="flex flex-col relative">
    <div class="flex items-end gap-1.5 relative z-20 -mb-[1px]">
      <button id="tabVisi" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Visi Organisasi</button>
      <button id="tabMisi" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Misi Organisasi</button>
    </div>

    <div class="bg-white rounded-b-2xl rounded-tr-2xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden relative z-10 flex flex-col min-h-[400px]">
      <div class="p-8">
        <div id="aboutDisplay" class="flex flex-col md:flex-row gap-12">
           {{-- Visual Preview --}}
           <div class="w-full md:w-5/12 space-y-4">
              <div class="aspect-video rounded-3xl overflow-hidden border-4 border-slate-50 shadow-inner bg-slate-100 relative group">
                <img id="displayImage" src="" alt="Preview" class="w-full h-full object-cover">
              </div>
              <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                <div class="flex gap-3">
                  <i class="ph ph-info text-emerald-600 text-xl mt-0.5"></i>
                  <p class="text-xs text-emerald-800 leading-relaxed font-medium">
                    Konten ini akan muncul di bagian "Tentang Kami" di halaman depan. Pastikan narasi yang ditulis mencerminkan nilai organisasi.
                  </p>
                </div>
              </div>
           </div>

           {{-- Content Area --}}
           <div class="flex-1 space-y-6">
              <div class="flex items-center justify-between">
                 <h2 id="displayTitle" class="text-2xl font-black text-slate-800"></h2>
                 <button id="btnEditAbout" class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                    <i class="ph ph-pencil-simple text-lg"></i> Edit Konten
                 </button>
              </div>
              <p id="displayDesc" class="text-slate-600 text-lg leading-relaxed whitespace-pre-line"></p>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Edit Modal --}}
<div id="aboutEditModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
    <div class="flex items-center justify-between p-6 border-b border-slate-100">
      <h3 id="editModalTitle" class="text-lg font-bold text-slate-800">Edit Konten</h3>
      <button id="closeAboutEdit" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-colors"><i class="ph ph-x text-lg"></i></button>
    </div>
    <form id="aboutEditForm">
      <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Judul</label>
          <input id="editNama" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Pernyataan Konten</label>
          <textarea id="editDesc" rows="6" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none"></textarea>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Upload Gambar (Opsional)</label>
          <input id="editImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
          {{-- Live Preview --}}
          <div id="imagePreviewWrap" class="hidden mt-3 relative">
            <p class="text-[10px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Preview Gambar</p>
            <div class="relative rounded-2xl overflow-hidden border border-slate-200 aspect-video bg-slate-100">
              <img id="imagePreviewEl" src="" alt="Preview" class="w-full h-full object-cover">
            </div>
          </div>
        </div>
      </div>
      <div class="p-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl">
        <button type="button" id="cancelAboutEdit" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="submitEditAbout" type="submit" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-xl text-sm shadow-md hover:bg-emerald-700 flex items-center gap-2 min-w-[140px] justify-center transition-all">
          <span id="submitBtnText">Simpan Perubahan</span>
          <svg id="submitSpinner" class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
          </svg>
        </button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const aboutBaseUrl = @json(url('/admin/aboutus'));
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const aboutState = {
    active: 'visi',
    data: (@json($generalProfile ?? []) || []).map(v => ({
       id: v.id,
       nama: v.nama,
       description: v.description,
       imageUrl: v.imageUrl
    })),
  };

  function currentItem() {
    if (aboutState.active === 'visi') {
       return aboutState.data.find(v => v.nama.toLowerCase().includes('visi')) || aboutState.data[0] || { id: 'new_visi', nama: 'Visi Organisasi', description: '', imageUrl: '' };
    }
    return aboutState.data.find(v => v.nama.toLowerCase().includes('misi')) || { id: 'new_misi', nama: 'Misi Organisasi', description: '', imageUrl: '' };
  }

  function paintTabs() {
    const on = 'bg-emerald-600 text-white border-slate-200 border-b-transparent z-30';
    const off = 'bg-gray-50 border-transparent text-slate-400 hover:text-emerald-600 hover:bg-white z-10 border-b-slate-200';
    document.getElementById('tabVisi').className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (aboutState.active === 'visi' ? on : off);
    document.getElementById('tabMisi').className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (aboutState.active === 'misi' ? on : off);
    
    const item = currentItem();
    if (item) {
      document.getElementById('displayTitle').textContent = item.nama;
      document.getElementById('displayDesc').textContent = item.description;
      document.getElementById('displayImage').src = item.imageUrl || '';
    }
  }

  function openEdit() {
    const item = currentItem();
    if (!item) return;
    document.getElementById('editModalTitle').textContent = 'Edit ' + (aboutState.active === 'visi' ? 'Visi' : 'Misi');
    document.getElementById('editNama').value = item.nama;
    document.getElementById('editDesc').value = item.description;
    document.getElementById('editImageFile').value = '';
    document.getElementById('imagePreviewWrap').classList.add('hidden');
    document.getElementById('imagePreviewEl').src = '';
    setSubmitLoading(false);
    document.getElementById('aboutEditModal').classList.remove('hidden');
    document.getElementById('aboutEditModal').classList.add('flex');
  }

  function closeEdit() {
    document.getElementById('aboutEditModal').classList.add('hidden');
    document.getElementById('aboutEditModal').classList.remove('flex');
  }

  function setSubmitLoading(isLoading) {
    const btn = document.getElementById('submitEditAbout');
    const text = document.getElementById('submitBtnText');
    const spinner = document.getElementById('submitSpinner');
    btn.disabled = isLoading;
    btn.classList.toggle('opacity-70', isLoading);
    btn.classList.toggle('cursor-not-allowed', isLoading);
    text.textContent = isLoading ? 'Menyimpan...' : 'Simpan Perubahan';
    spinner.classList.toggle('hidden', !isLoading);
  }

  // Live preview saat pilih file
  document.getElementById('editImageFile').addEventListener('change', function () {
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

  document.getElementById('tabVisi').addEventListener('click', () => { aboutState.active = 'visi'; paintTabs(); });
  document.getElementById('tabMisi').addEventListener('click', () => { aboutState.active = 'misi'; paintTabs(); });
  document.getElementById('btnEditAbout').addEventListener('click', openEdit);
  document.getElementById('closeAboutEdit').addEventListener('click', closeEdit);
  document.getElementById('cancelAboutEdit').addEventListener('click', closeEdit);

  document.getElementById('aboutEditForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const item = currentItem();
    if (!item) return;

    setSubmitLoading(true);

    const formData = new FormData();
    const isNew = String(item.id).startsWith('new_');
    if (!isNew) {
      formData.append('_method', 'PUT');
    }
    formData.append('section', 'general');
    formData.append('nama', document.getElementById('editNama').value);
    formData.append('description', document.getElementById('editDesc').value);
    
    const fileInput = document.getElementById('editImageFile');
    if (fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    }

    try {
      const url = isNew ? aboutBaseUrl : `${aboutBaseUrl}/${item.id}`;
      const res = await fetch(url, {
        method: 'POST',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: formData
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json.message || 'Terjadi kesalahan.');
      
      if (isNew) {
        aboutState.data.push({
          id: json.data.id,
          nama: json.data.nama,
          description: json.data.description,
          imageUrl: json.data.imageUrl
        });
      } else {
        aboutState.data = aboutState.data.map(v => v.id === item.id ? {
          id: json.data.id,
          nama: json.data.nama,
          description: json.data.description,
          imageUrl: json.data.imageUrl
        } : v);
      }
      
      closeEdit();
      paintTabs(); // Re-render dengan data terbaru
    } catch (err) {
      alert('Gagal menyimpan: ' + err.message);
      setSubmitLoading(false);
    }
  });

  paintTabs();
</script>
@endsection

