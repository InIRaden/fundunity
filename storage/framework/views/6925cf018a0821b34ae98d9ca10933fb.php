<?php $__env->startSection('title', $campaign->title); ?>

<?php $__env->startSection('content'); ?>
<?php
    $progress = (int) min(100, round(((int) $campaign->collected / max((int) $campaign->target, 1)) * 100));
    $daysLeft = max(0, (int) now()->diffInDays($campaign->deadline, false));
    $donorCount = $campaign->donations()->where('status', 'success')->count();
?>

<div class="min-h-screen bg-slate-50 pb-20 pt-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Image and Description -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[40px] overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-100">
                    <img src="<?php echo e($campaign->image); ?>" alt="<?php echo e($campaign->title); ?>" class="w-full h-[400px] object-cover">
                    <div class="p-8 md:p-12">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full text-xs font-black tracking-widest uppercase">
                                <?php echo e($campaign->category ?? 'Umum'); ?>

                            </span>
                            <?php if($campaign->status === 'aktif' && $daysLeft <= 7): ?>
                                <span class="bg-rose-50 text-rose-600 px-4 py-1.5 rounded-full text-xs font-black tracking-widest uppercase animate-pulse">
                                    Mendesak
                                </span>
                            <?php endif; ?>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight mb-8"><?php echo e($campaign->title); ?></h1>
                        
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                            <?php echo nl2br(e($campaign->description)); ?>

                        </div>
                    </div>
                </div>

                <!-- Tabs/Social Proof Section -->
                <div class="bg-white rounded-[40px] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden" id="campaignTabs">
                    <div class="flex border-b border-slate-100 overflow-x-auto scrollbar-hide">
                        <button data-tab="description" class="tab-btn flex-1 min-w-[120px] py-6 text-sm font-black text-emerald-600 border-b-2 border-emerald-600 transition-all">Deskripsi</button>
                        <button data-tab="updates" class="tab-btn flex-1 min-w-[120px] py-6 text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">Update (<?php echo e($campaign->updates->count()); ?>)</button>
                        <button data-tab="donors" class="tab-btn flex-1 min-w-[120px] py-6 text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">Donatur (<?php echo e($recentDonations->count()); ?>)</button>
                    </div>
                    
                    <div class="p-8 md:p-12">
                        <!-- Description Tab Content -->
                        <div id="tab-description" class="tab-content block">
                            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                                <?php echo nl2br(e($campaign->description)); ?>

                            </div>
                        </div>

                        <!-- Updates Tab Content -->
                        <div id="tab-updates" class="tab-content hidden">
                            <div class="space-y-8">
                                <?php $__empty_1 = true; $__currentLoopData = $campaign->updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="border border-slate-100 bg-white rounded-2xl p-6 shadow-sm">
                                        <div class="text-sm font-semibold text-slate-500 mb-2">
                                            <?php echo e($update->created_at->format('d M Y')); ?>

                                        </div>
                                        <h4 class="text-lg font-bold text-slate-900 mb-3"><?php echo e($update->title); ?></h4>
                                        <?php if($update->image): ?>
                                            <img src="<?php echo e($update->image); ?>" class="w-full h-auto max-h-64 object-cover rounded-xl mb-4 bg-slate-50" alt="Update Image">
                                        <?php endif; ?>
                                        <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line"><?php echo e($update->content); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-center py-12 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                                            <i class="ph ph-megaphone text-slate-400 text-2xl"></i>
                                        </div>
                                        <p class="text-slate-500 font-medium">Belum ada update untuk program ini.</p>
                                        <p class="text-xs text-slate-400 mt-1">Laporan penyaluran akan muncul di sini secara berkala.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Donors Tab Content -->
                        <div id="tab-donors" class="tab-content hidden">
                            <div class="divide-y divide-slate-50">
                                <?php $__empty_1 = true; $__currentLoopData = $recentDonations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="flex items-center gap-4 py-6">
                                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 font-bold shrink-0">
                                            <?php echo e(strtoupper(substr($donation->is_anonymous ? 'H' : ($donation->donor->name ?? 'A'), 0, 1))); ?>

                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center mb-1">
                                                <p class="font-bold text-slate-900"><?php echo e($donation->is_anonymous ? 'Hamba Allah' : ($donation->donor->name ?? 'Anonim')); ?></p>
                                                <p class="text-[10px] font-bold text-slate-400"><?php echo e($donation->created_at->diffForHumans()); ?></p>
                                            </div>
                                            <p class="text-sm font-bold text-emerald-600">Berdonasi Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?></p>
                                            <?php if($donation->prayer): ?>
                                                <div class="mt-2 bg-slate-50 p-4 rounded-2xl relative">
                                                    <div class="absolute -top-2 left-4 w-4 h-4 bg-slate-50 rotate-45"></div>
                                                    <p class="text-sm text-slate-600 italic">"<?php echo e($donation->prayer); ?>"</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-center py-12 text-slate-400">
                                        <p>Belum ada donasi. Jadilah yang pertama membantu!</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Donation Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white rounded-[40px] p-8 md:p-10 shadow-2xl shadow-emerald-900/10 border border-slate-100 border-t-4 border-t-emerald-500">
                        <div class="mb-8">
                            <p class="text-slate-500 text-xs font-bold tracking-widest mb-2 uppercase">Terkumpul</p>
                            <h2 class="text-4xl font-black text-emerald-600 mb-1">Rp <?php echo e(number_format((int) $campaign->collected, 0, ',', '.')); ?></h2>
                            <p class="text-slate-400 text-sm font-bold">dari target Rp <?php echo e(number_format((int) $campaign->target, 0, ',', '.')); ?></p>
                        </div>

                        <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden mb-8 relative">
                            <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full transition-all duration-1000" style="width: <?php echo e($progress); ?>%"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="bg-slate-50 rounded-2xl p-4 text-center">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Donatur</p>
                                <p class="text-xl font-black text-slate-900"><?php echo e(number_format($donorCount, 0, ',', '.')); ?></p>
                            </div>
                            <div class="bg-slate-50 rounded-2xl p-4 text-center">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Hari Lagi</p>
                                <p class="text-xl font-black text-slate-900"><?php echo e($daysLeft); ?></p>
                            </div>
                        </div>

                        <a href="<?php echo e(route('donation.form', ['campaign' => $campaign->id])); ?>" class="hidden lg:block w-full text-center bg-emerald-500 hover:bg-emerald-600 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-emerald-500/40 active:scale-95 text-lg">
                            Donasi Sekarang
                        </a>

                        <button type="button" onclick="shareCampaign()" class="hidden lg:flex w-full mt-3 items-center justify-center gap-2 border-2 border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold py-3.5 rounded-2xl transition-colors">
                            <i class="ph ph-share-network text-xl"></i>
                            Bagikan
                        </button>

                        <div class="mt-6 hidden lg:flex items-center justify-center gap-2 text-xs font-bold text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Pembayaran Aman & Terenkripsi
                        </div>
                    </div>

                    <!-- Organization Info -->
                    <div class="bg-slate-900 rounded-[40px] p-8 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl -translate-x-1/2 -translate-y-1/2"></div>
                        <p class="text-xs font-black text-emerald-400 tracking-widest uppercase mb-4">Organisasi Penggalang</p>
                        <div class="flex items-center gap-4">
                            <img src="/images/Logo.png" alt="Logo" class="w-12 h-12 rounded-xl bg-white p-1">
                            <div>
                                <p class="font-black text-sm">HMT-Unpad</p>
                                <p class="text-[10px] text-slate-400 font-bold">Terverifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Bottom Donation Button (Mobile Only) -->
<div class="fixed bottom-0 left-0 right-0 z-[100] lg:hidden animate-slide-up">
    <div class="bg-white/80 backdrop-blur-md border-t border-slate-100 p-4 shadow-[0_-10px_40px_rgba(0,0,0,0.1)]">
        <div class="flex items-center gap-4 max-w-7xl mx-auto">
            <button type="button" onclick="shareCampaign()" class="flex items-center justify-center w-14 h-14 bg-white text-slate-600 rounded-2xl border-2 border-slate-200 shrink-0">
                <i class="ph ph-share-network text-2xl"></i>
            </button>
            <div class="flex-1 hidden sm:block">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Terkumpul</p>
                <p class="font-black text-emerald-600">Rp <?php echo e(number_format((int) $campaign->collected, 0, ',', '.')); ?></p>
            </div>
            <a href="<?php echo e(route('donation.form', ['campaign' => $campaign->id])); ?>" class="flex-1 text-center bg-emerald-500 text-white font-black px-8 py-4 rounded-2xl text-sm shadow-lg shadow-emerald-500/30">
                Donasi Sekarang
            </a>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    async function shareCampaign() {
        const shareData = {
            title: '<?php echo e($campaign->title); ?>',
            text: 'Mari ikut berdonasi untuk program <?php echo e($campaign->title); ?> di FundUnity.',
            url: window.location.href
        };

        if (navigator.share) {
            try {
                await navigator.share(shareData);
            } catch (err) {
                console.log('Error sharing:', err);
            }
        } else {
            try {
                await navigator.clipboard.writeText(shareData.url);
                alert('Tautan campaign berhasil disalin ke clipboard!');
            } catch (err) {
                alert('Gagal menyalin tautan.');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.dataset.tab;

                // Update Button Styles
                tabBtns.forEach(b => {
                    b.classList.remove('text-emerald-600', 'border-b-2', 'border-emerald-600');
                    b.classList.add('text-slate-400', 'font-bold');
                    b.classList.remove('font-black');
                });
                btn.classList.add('text-emerald-600', 'border-b-2', 'border-emerald-600', 'font-black');
                btn.classList.remove('text-slate-400', 'font-bold');

                // Switch Content
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('block');
                });
                document.getElementById(`tab-${target}`).classList.remove('hidden');
                document.getElementById(`tab-${target}`).classList.add('block');
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/landing/campaign-detail.blade.php ENDPATH**/ ?>