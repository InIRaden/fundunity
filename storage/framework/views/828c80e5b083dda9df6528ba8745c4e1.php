<?php $__env->startSection('title', 'FAQ'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $faqItems = collect($faqs ?? []);
?>

<div class="relative min-h-[70vh] bg-slate-50 pb-12 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <section class="py-24 bg-slate-50 border-t border-slate-100">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-16 text-center">
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Pertanyaan yang Sering <span class="text-emerald-500">Diajukan</span>
                </h1>
                <p class="text-slate-500 text-lg">Kami merangkum jawaban jujur dari pertanyaan-pertanyaan donatur untuk menghapus keraguan Anda.</p>
            </div>

            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $faqItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="faq-item <?php echo e($index === 0 ? 'bg-white rounded-2xl border-none shadow-xl shadow-slate-200/50 p-2 md:p-6 mb-4 -mx-2 md:-mx-6' : 'border-b border-slate-200 py-4'); ?>" data-open="<?php echo e($index === 0 ? 'true' : 'false'); ?>">
                        <button type="button" class="faq-trigger flex items-center justify-between w-full text-left font-bold text-slate-900 hover:text-emerald-600 transition-colors">
                            <span class="<?php echo e($index === 0 ? 'text-xl' : 'text-lg'); ?>"><?php echo e($faq->question); ?></span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors <?php echo e($index === 0 ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500'); ?>">
                                <svg data-icon="plus" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="<?php echo e($index === 0 ? 'hidden' : ''); ?>"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
                                <svg data-icon="minus" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="<?php echo e($index === 0 ? '' : 'hidden'); ?>"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128Z"></path></svg>
                            </span>
                        </button>

                        <div class="faq-body overflow-hidden transition-all duration-300 <?php echo e($index === 0 ? 'max-h-96 mt-4 opacity-100' : 'max-h-0 opacity-0'); ?>">
                            <p class="text-slate-500 leading-relaxed pr-8"><?php echo e($faq->answer); ?></p>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-500">
                        FAQ belum tersedia dari admin.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.faq-item').forEach(function (item) {
            const trigger = item.querySelector('.faq-trigger');
            const body = item.querySelector('.faq-body');
            const iconWrap = item.querySelector('.faq-icon');
            const plusIcon = iconWrap?.querySelector('[data-icon="plus"]');
            const minusIcon = iconWrap?.querySelector('[data-icon="minus"]');

            trigger?.addEventListener('click', function () {
                const isOpen = item.dataset.open === 'true';

                document.querySelectorAll('.faq-item').forEach(function (other) {
                    const otherBody = other.querySelector('.faq-body');
                    const otherIconWrap = other.querySelector('.faq-icon');
                    const otherIcon = otherIconWrap?.querySelector('i');
                    const title = other.querySelector('.faq-trigger span');

                    other.dataset.open = 'false';
                    other.classList.remove('rounded-2xl', 'bg-white', 'p-2', 'shadow-xl', 'shadow-slate-200/50', 'md:-mx-6', 'md:p-6', 'mb-4', '-mx-2');
                    other.classList.add('border-b', 'border-slate-200', 'py-4');
                    otherBody?.classList.add('max-h-0', 'opacity-0');
                    otherBody?.classList.remove('max-h-96', 'mt-4', 'opacity-100');
                    otherIconWrap?.classList.remove('bg-emerald-100', 'text-emerald-600');
                    otherIconWrap?.classList.add('bg-slate-100', 'text-slate-500');
                    otherIconWrap?.querySelector('[data-icon="plus"]')?.classList.remove('hidden');
                    otherIconWrap?.querySelector('[data-icon="minus"]')?.classList.add('hidden');
                    if (title) {
                        title.classList.remove('text-xl');
                        title.classList.add('text-lg');
                    }
                });

                if (!isOpen) {
                    item.dataset.open = 'true';
                    item.classList.add('rounded-2xl', 'bg-white', 'p-2', 'shadow-xl', 'shadow-slate-200/50', 'md:-mx-6', 'md:p-6', 'mb-4', '-mx-2');
                    item.classList.remove('border-b', 'border-slate-200', 'py-4');
                    body?.classList.remove('max-h-0', 'opacity-0');
                    body?.classList.add('max-h-96', 'mt-4', 'opacity-100');
                    iconWrap?.classList.add('bg-emerald-100', 'text-emerald-600');
                    iconWrap?.classList.remove('bg-slate-100', 'text-slate-500');
                    plusIcon?.classList.add('hidden');
                    minusIcon?.classList.remove('hidden');
                    const title = trigger.querySelector('span');
                    title?.classList.remove('text-lg');
                    title?.classList.add('text-xl');
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\faq.blade.php ENDPATH**/ ?>