@props([
    'id',
    'title' => '',
    'subtitle' => null,
    'maxWidth' => 'max-w-lg',
    'headerColor' => 'bg-emerald-600',
    'closeButtonId' => null, // Optional, jika ingin memberikan id khusus ke tombol close
])

<div id="{{ $id }}" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm items-center justify-center z-[100] p-4 overflow-y-auto animate-fade-in">
  <div class="bg-white rounded-3xl shadow-2xl {{ $maxWidth }} w-full flex flex-col max-h-[90vh] my-auto animate-slide-up overflow-hidden">
    <!-- Header Modal -->
    <div class="bg-white border-b border-slate-100 px-6 py-4 flex items-center justify-between shrink-0 rounded-t-3xl">
      <div class="flex-1 min-w-0 pr-4">
        <h3 class="text-base font-bold text-emerald-700 leading-tight" id="{{ $id }}Title">{{ $title }}</h3>
        @if($subtitle)
            <p class="text-xs text-slate-500 mt-0.5" id="{{ $id }}Sub">{{ $subtitle }}</p>
        @endif
        {{ $headerSlot ?? '' }}
      </div>
      <button type="button" 
              {{ $closeButtonId ? 'id='.$closeButtonId : '' }}
              onclick="document.getElementById('{{ $id }}').classList.add('hidden'); document.getElementById('{{ $id }}').classList.remove('flex');" 
              class="text-slate-400 hover:text-slate-600 transition-colors">
        <i class="ph ph-x text-xl"></i>
      </button>
    </div>

    <!-- Konten Body & Footer Modal -->
    {{ $slot }}
  </div>
</div>
