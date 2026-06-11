@extends('layouts.admin.app')

@section('admin-content')
@php
  $legal = $legal ?? [];
@endphp

<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div id="legalToast" class="hidden items-center gap-3 px-5 py-3 bg-admin-50 border border-admin-200 text-admin-700 rounded-xl text-sm font-bold fixed top-24 right-8 z-[100] shadow-lg">
    <i class="ph ph-check-circle text-base"></i><span id="legalToastText"></span>
  </div>

  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/30 border border-slate-100 p-8">
    <div class="space-y-8">
      <div>
        <h2 class="text-2xl font-bold text-slate-900 mb-2">Kebijakan & Privasi</h2>
        <p class="text-sm text-slate-500">Kelola Kebijakan Privasi dan Syarat & Ketentuan yang ditampilkan di website publik.</p>
      </div>

      <form id="legalForm" class="space-y-8">
        @csrf

        <!-- Privacy Policy Section -->
        <div class="space-y-4 pb-8 border-b border-slate-100">
          <div>
            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-3">
              <i class="ph ph-shield-check text-admin-600 text-base"></i>
              Kebijakan Privasi
            </label>
            <textarea id="privacyPolicy" name="privacyPolicy" rows="10" placeholder="Masukkan Kebijakan Privasi lengkap..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-admin-500/20 resize-none transition-all">{{ $legal['privacyPolicy'] ?? '' }}</textarea>
            <p class="mt-2 text-xs text-slate-400 flex items-center gap-2">
              <i class="ph ph-info text-base"></i>
              <span>Ditampilkan di halaman <a href="{{ route('privacy') }}" target="_blank" class="text-admin-600 hover:underline font-semibold">/privacy</a></span>
            </p>
          </div>
        </div>

        <!-- Terms & Conditions Section -->
        <div class="space-y-4">
          <div>
            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-3">
              <i class="ph ph-gavel text-blue-600 text-base"></i>
              Syarat & Ketentuan
            </label>
            <textarea id="termsConditions" name="termsConditions" rows="10" placeholder="Masukkan Syarat & Ketentuan lengkap..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-admin-500/20 resize-none transition-all">{{ $legal['termsConditions'] ?? '' }}</textarea>
            <p class="mt-2 text-xs text-slate-400 flex items-center gap-2">
              <i class="ph ph-info text-base"></i>
              <span>Ditampilkan di halaman <a href="{{ route('terms') }}" target="_blank" class="text-admin-600 hover:underline font-semibold">/terms</a></span>
            </p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
          <button type="button" onclick="window.location.reload();" class="px-6 py-2.5 bg-slate-100 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-200 transition-all flex items-center gap-2">
            <i class="ph ph-arrow-clockwise text-base"></i>
            Reset
          </button>
          <button type="submit" id="legalSubmitBtn" class="px-6 py-2.5 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 transition-all flex items-center gap-2">
            <i class="ph ph-floppy-disk text-base"></i>
            <span id="legalSubmitLabel">Simpan Dokumen Hukum</span>
            <svg id="legalSubmitSpinner" class="hidden animate-spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const csrfToken = @json(csrf_token());
  const endpoint = @json(route('admin.legal.update'));

  function toast(msg) {
    const t = document.getElementById('legalToast');
    document.getElementById('legalToastText').textContent = msg;
    t.classList.remove('hidden');
    t.classList.add('flex');
    setTimeout(() => {
      t.classList.add('hidden');
      t.classList.remove('flex');
    }, 3000);
  }

  async function requestJson(url, payload) {
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload),
    });

    const result = await response.json().catch(() => ({}));
    if (!response.ok) {
      const firstValidation = result.errors ? Object.values(result.errors)[0]?.[0] : null;
      throw new Error(firstValidation || result.message || 'Request gagal diproses.');
    }

    return result;
  }

  document.getElementById('legalForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const btn = document.getElementById('legalSubmitBtn');
    const label = document.getElementById('legalSubmitLabel');
    const spinner = document.getElementById('legalSubmitSpinner');

    if (btn) btn.disabled = true;
    if (label) label.textContent = 'Menyimpan...';
    if (spinner) spinner.classList.remove('hidden');

    try {
      const result = await requestJson(endpoint, {
        privacyPolicy: document.getElementById('privacyPolicy').value,
        termsConditions: document.getElementById('termsConditions').value,
      });

      toast(result.message || 'Kebijakan Privasi dan Syarat & Ketentuan berhasil disimpan.');
    } catch (error) {
      window.alert(error.message);
    } finally {
      if (btn) btn.disabled = false;
      if (label) label.textContent = 'Simpan Dokumen Hukum';
      if (spinner) spinner.classList.add('hidden');
    }
  });
</script>
@endsection
