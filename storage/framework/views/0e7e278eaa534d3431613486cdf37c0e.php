<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'title' => '',
    'subtitle' => null,
    'maxWidth' => 'max-w-lg',
    'headerColor' => 'bg-emerald-600',
    'closeButtonId' => null, // Optional, jika ingin memberikan id khusus ke tombol close
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id',
    'title' => '',
    'subtitle' => null,
    'maxWidth' => 'max-w-lg',
    'headerColor' => 'bg-emerald-600',
    'closeButtonId' => null, // Optional, jika ingin memberikan id khusus ke tombol close
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div id="<?php echo e($id); ?>" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm items-center justify-center z-[100] p-4 overflow-y-auto animate-fade-in">
  <div class="bg-white rounded-3xl shadow-2xl <?php echo e($maxWidth); ?> w-full flex flex-col max-h-[90vh] my-auto animate-slide-up overflow-hidden">
    <!-- Header Modal -->
    <div class="bg-white border-b border-slate-100 px-6 py-4 flex items-center justify-between shrink-0 rounded-t-3xl">
      <div class="flex-1 min-w-0 pr-4">
        <h3 class="text-base font-bold text-emerald-700 leading-tight" id="<?php echo e($id); ?>Title"><?php echo e($title); ?></h3>
        <?php if($subtitle): ?>
            <p class="text-xs text-slate-500 mt-0.5" id="<?php echo e($id); ?>Sub"><?php echo e($subtitle); ?></p>
        <?php endif; ?>
        <?php echo e($headerSlot ?? ''); ?>

      </div>
      <button type="button" 
              <?php echo e($closeButtonId ? 'id='.$closeButtonId : ''); ?>

              onclick="document.getElementById('<?php echo e($id); ?>').classList.add('hidden'); document.getElementById('<?php echo e($id); ?>').classList.remove('flex');" 
              class="text-slate-400 hover:text-slate-600 transition-colors">
        <i class="ph ph-x text-xl"></i>
      </button>
    </div>

    <!-- Konten Body & Footer Modal -->
    <?php echo e($slot); ?>

  </div>
</div>
<?php /**PATH D:\coding\fundunity\resources\views/components/admin/modal.blade.php ENDPATH**/ ?>