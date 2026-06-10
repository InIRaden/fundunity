@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
      <div>
        <h2 class="text-lg font-bold text-slate-900">Daftar Mitra</h2>
      </div>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-admin-500"></i>
          <input id="partnerSearch" type="text" class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-admin-500 text-admin-900 rounded-xl text-sm focus:ring-4 focus:ring-admin-500/20 outline-none transition-all placeholder:text-admin-500/50 shadow-sm" placeholder="Cari nama partner...">
        </div>
        <button id="openPartnerModal" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-admin-600 text-white rounded-lg text-xs font-bold hover:bg-admin-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Mitra</span>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-admin-600">
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50 w-24">Id</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50">Logo Mitra</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50">Nama Instansi</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-admin-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="partnerRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>
    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100"><span id="partnerCount" class="text-xs text-slate-400"></span></div>
  </div>
</div>

<x-admin.modal 
    id="partnerModal" 
    title="Tambah Mitra" 
    maxWidth="max-w-lg" 
    headerColor="bg-admin-600"
    closeButtonId="closePartnerModal">
    <form id="partnerForm" class="flex flex-col flex-1 overflow-hidden">
      <div class="p-6 space-y-5 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Nama Instansi / Mitra</label>
          <input id="partnerName" required placeholder="Masukkan nama resmi..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Logo Partner <span class="text-slate-400">(Pilih salah satu)</span></label>
          <div class="space-y-3">
            <div>
              <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1.5">Upload File</p>
              <input id="partnerImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-admin-50 file:text-admin-700 hover:file:bg-admin-100">
            </div>
            <div class="flex items-center gap-2">
              <div class="flex-1 h-px bg-slate-100"></div>
              <span class="text-[10px] text-slate-400 font-bold">ATAU</span>
              <div class="flex-1 h-px bg-slate-100"></div>
            </div>
            <div>
              <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1.5">URL Gambar Eksternal</p>
              <input id="partnerImageUrl" type="url" placeholder="https://..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
            </div>
          </div>
          <p class="text-[10px] text-slate-400 mt-2">Format: JPG, PNG, WEBP. Maks 2MB. Logo boleh kosong.</p>
          {{-- Live Preview --}}
          <div id="partnerPreviewWrap" class="hidden mt-3">
            <p class="text-[10px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Preview</p>
            <div class="w-32 h-16 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden p-2">
              <img id="partnerPreviewEl" src="" alt="Preview" class="max-w-full max-h-full object-contain">
            </div>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0 rounded-b-3xl">
        <button type="button" id="cancelPartnerModal" class="px-5 py-2 text-sm font-semibold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="submitPartnerModal" type="submit" class="px-6 py-2 bg-admin-600 text-white rounded-xl text-sm font-semibold hover:bg-admin-700 shadow-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2 min-w-[140px] justify-center">
          <span id="partnerBtnText">Konfirmasi Simpan</span>
          <x-icons.spinner id="partnerSpinner" class="hidden animate-spin h-4 w-4 text-white" />
        </button>
      </div>
    </form>
</x-admin.modal>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  window.partnerInitial = {
    csrfToken: @json(csrf_token()),
    partnerStoreUrl: @json(route('admin.partners.store')),
    partnerBaseUrl: @json(url('/admin/partners')),
    partners: @json($partners)
  };
</script>
@section('body-data','admin-partners')
@endsection
