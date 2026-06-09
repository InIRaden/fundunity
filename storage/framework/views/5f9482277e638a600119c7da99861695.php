<div id="customConfirmModal" class="hidden fixed inset-0 z-[200] items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
  <div class="bg-white rounded-3xl w-full max-w-sm shadow-2xl overflow-hidden animate-slide-up">
    <div class="p-6 text-center">
      <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="ph ph-warning-circle text-3xl"></i>
      </div>
      <h3 id="confirmTitle" class="text-lg font-bold text-slate-900 mb-2">Konfirmasi</h3>
      <p id="confirmMessage" class="text-sm text-slate-500 leading-relaxed"></p>
    </div>
    <div class="p-4 bg-slate-50 border-t border-slate-100 flex gap-3">
      <button id="confirmCancelBtn" class="flex-1 px-4 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-200 rounded-xl transition-colors">Batal</button>
      <button id="confirmOkBtn" class="flex-1 px-4 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors shadow-lg shadow-emerald-600/20">Ya, Lanjutkan</button>
    </div>
  </div>
</div>

<div id="customAlertModal" class="hidden fixed inset-0 z-[200] items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
  <div class="bg-white rounded-3xl w-full max-w-sm shadow-2xl overflow-hidden animate-slide-up">
    <div class="p-6 text-center">
      <div id="alertIconBox" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
        <i id="alertIcon" class="text-3xl"></i>
      </div>
      <h3 id="alertTitle" class="text-lg font-bold text-slate-900 mb-2">Pemberitahuan</h3>
      <p id="alertMessage" class="text-sm text-slate-500 leading-relaxed"></p>
    </div>
    <div class="p-4 bg-slate-50 border-t border-slate-100">
      <button id="alertOkBtn" class="w-full px-4 py-2.5 text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-colors shadow-lg">Tutup</button>
    </div>
  </div>
</div>

<script>
  window.customConfirm = function(title, message, okLabel = 'Ya, Lanjutkan') {
    return new Promise((resolve) => {
      const modal = document.getElementById('customConfirmModal');
      const titleEl = document.getElementById('confirmTitle');
      const msgEl = document.getElementById('confirmMessage');
      const okBtn = document.getElementById('confirmOkBtn');
      const cancelBtn = document.getElementById('confirmCancelBtn');

      titleEl.textContent = title;
      msgEl.textContent = message;
      okBtn.textContent = okLabel;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      const cleanup = (result) => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        okBtn.onclick = null;
        cancelBtn.onclick = null;
        resolve(result);
      };

      okBtn.onclick = () => cleanup(true);
      cancelBtn.onclick = () => cleanup(false);
    });
  };

  window.customAlert = function(title, message, type = 'success') {
    return new Promise((resolve) => {
      const modal = document.getElementById('customAlertModal');
      const titleEl = document.getElementById('alertTitle');
      const msgEl = document.getElementById('alertMessage');
      const okBtn = document.getElementById('alertOkBtn');
      const iconBox = document.getElementById('alertIconBox');
      const icon = document.getElementById('alertIcon');

      titleEl.textContent = title;
      msgEl.textContent = message;

      if (type === 'error') {
        iconBox.className = 'w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4';
        icon.className = 'ph ph-x-circle text-3xl';
        okBtn.className = 'w-full px-4 py-2.5 text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-colors shadow-lg shadow-rose-600/20';
      } else {
        iconBox.className = 'w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4';
        icon.className = 'ph ph-check-circle text-3xl';
        okBtn.className = 'w-full px-4 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors shadow-lg shadow-emerald-600/20';
      }

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      okBtn.onclick = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        resolve();
      };
    });
  };
</script>
<?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/components/admin-modals.blade.php ENDPATH**/ ?>