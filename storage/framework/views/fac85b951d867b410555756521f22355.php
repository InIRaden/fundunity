<?php $__env->startSection('title', optional($page)->meta_title ?? 'Wujudkan Dampak Nyata'); ?>

<?php $__env->startPush('head'); ?>
<style>
    .landing-clamp-2,
    .landing-clamp-3 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
    }

    .landing-clamp-2 {
        -webkit-line-clamp: 2;
    }

    .landing-clamp-3 {
        -webkit-line-clamp: 3;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $sliderItems = collect($sliderItems ?? []);
    $homeCampaigns = collect($homeCampaigns ?? []);
    $homeFocusAreas = collect($homeFocusAreas ?? []);
    $homePartners = collect($homePartners ?? []);
    $impactStats = $impactStats ?? [];

    $heroImage = optional($sliderItems->first())->image_url
        ?: optional($page)->hero_image
        ?: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2670&auto=format&fit=crop';

    $focusStyles = [
        'bg-blue-50 text-blue-600 border-blue-200',
        'bg-rose-50 text-rose-600 border-rose-200',
        'bg-emerald-50 text-emerald-600 border-emerald-200',
        'bg-amber-50 text-amber-600 border-amber-200',
    ];

    $campaignFallbackImages = [
        'Bencana Alam' => 'https://images.unsplash.com/photo-1547683905-f30e6113824f?auto=format&fit=crop&q=80&w=800',
        'Pendidikan' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=800',
        'Kesehatan' => 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?auto=format&fit=crop&q=80&w=800',
        'Infrastruktur' => 'https://plus.unsplash.com/premium_photo-1664302152996-03fcb2220d9e?auto=format&fit=crop&q=80&w=800',
        'Komunitas' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&q=80&w=800',
        'default' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&q=80&w=800',
    ];

    $formatCurrency = static fn ($value) => 'Rp '.number_format((int) $value, 0, ',', '.');

    $formatCompactRupiah = static function (int $value): string {
        if ($value >= 1_000_000_000) {
            $amount = rtrim(rtrim(number_format($value / 1_000_000_000, 1, ',', '.'), '0'), ',');
            return 'Rp '.$amount.'M';
        }

        if ($value >= 1_000_000) {
            $amount = rtrim(rtrim(number_format($value / 1_000_000, 1, ',', '.'), '0'), ',');
            return 'Rp '.$amount.'Jt';
        }

        return 'Rp '.number_format($value, 0, ',', '.');
    };

    $heroDonorCount = (int) ($impactStats['donor_count'] ?? 0);
    $heroDistributedAmount = (int) ($impactStats['distributed_amount'] ?? 0);
    $heroCompletedPrograms = (int) ($impactStats['completed_programs'] ?? 0);

    $heroDonorLabel = $heroDonorCount > 0 ? number_format($heroDonorCount, 0, ',', '.').'+' : '45K+';
    $heroAmountLabel = $heroDistributedAmount > 0 ? $formatCompactRupiah($heroDistributedAmount) : 'Rp 12M';
    $heroProgramLabel = $heroCompletedPrograms > 0 ? number_format($heroCompletedPrograms, 0, ',', '.').'+' : '128';
?>

<section class="relative flex min-h-screen items-center overflow-hidden bg-slate-900 pb-20 pt-24">
    <div class="absolute inset-0">
        <img src="<?php echo e($heroImage); ?>" alt="Hero FundUnity" class="h-full w-full object-cover object-top opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
    </div>

    <div class="relative z-10 mx-auto flex max-w-7xl flex-col items-center px-6 text-center">
        <span class="mb-6 rounded-full border border-emerald-500/30 bg-emerald-500/20 px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-emerald-300 backdrop-blur-md">
            Official Organization Platform
        </span>

        <h1 class="font-display mb-8 max-w-4xl text-5xl font-extrabold leading-tight tracking-tight text-white md:text-7xl">
            Wujudkan Dampak Nyata,
            <br>
            <span class="bg-gradient-to-r from-emerald-400 to-teal-200 bg-clip-text text-transparent">Sinergi Membangun Negeri.</span>
        </h1>

        <p class="mb-10 max-w-2xl text-lg leading-relaxed text-slate-300 md:text-xl">
            Lebih dari sekadar platform donasi. Bersama kita menggalang solidaritas, transparansi, dan gerakan nyata untuk perubahan sosial yang berkelanjutan.
        </p>

        <div class="flex w-full flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="<?php echo e(route('programs')); ?>" class="flex w-full items-center justify-center gap-3 rounded-2xl bg-emerald-500 px-8 py-4 text-center text-base font-extrabold text-slate-900 shadow-xl shadow-emerald-500/30 transition-all hover:bg-emerald-400 sm:w-auto">
                Pilih Program Bantuan
                <i class="ph ph-heart-straight text-xl text-rose-500"></i>
            </a>
            <a href="<?php echo e(route('about')); ?>" class="flex w-full items-center justify-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-8 py-4 text-center text-base font-bold text-white backdrop-blur-md transition-all hover:bg-white/20 sm:w-auto">
                <i class="ph ph-play-circle text-2xl"></i>
                Lihat Profil Kami
            </a>
        </div>

        <div class="mt-16 flex flex-wrap justify-center gap-8 border-t border-white/10 pt-8 md:gap-16">
            <div class="text-left">
                <p class="text-4xl font-extrabold text-white"><?php echo e($heroDonorLabel); ?></p>
                <p class="mt-1 text-sm font-bold uppercase tracking-[0.2em] text-emerald-400">Donatur Aktif</p>
            </div>
            <div class="text-left">
                <p class="text-4xl font-extrabold text-white"><?php echo e($heroAmountLabel); ?></p>
                <p class="mt-1 text-sm font-bold uppercase tracking-[0.2em] text-emerald-400">Telah Disalurkan</p>
            </div>
            <div class="text-left">
                <p class="text-4xl font-extrabold text-white"><?php echo e($heroProgramLabel); ?></p>
                <p class="mt-1 text-sm font-bold uppercase tracking-[0.2em] text-emerald-400">Program Selesai</p>
            </div>
        </div>
    </div>
</section>

<section id="pilar" class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-16 md:flex md:items-end md:justify-between md:gap-10">
            <div class="max-w-2xl">
                <span class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">Pilar Program</span>
                <h2 class="font-display mb-4 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Fokus Area <span class="text-emerald-500">Kebaikan.</span>
                </h2>
                <p class="text-lg text-slate-500">Setiap kontribusi Anda disalurkan secara spesifik sesuai pilar pergerakan utama kami untuk menciptakan dampak terukur.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <?php $__empty_1 = true; $__currentLoopData = $homeFocusAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $focusArea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group rounded-[2rem] border p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl <?php echo e($focusStyles[$index % count($focusStyles)]); ?>">
                    <div class="mb-6 text-3xl">
                        <i class="<?php echo e($focusArea->icon ?: 'ph ph-target'); ?>"></i>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-slate-900"><?php echo e($focusArea->title); ?></h3>
                    <p class="text-sm leading-relaxed text-slate-500"><?php echo e($focusArea->description); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-[2rem] border border-dashed border-slate-200 bg-slate-50 p-8 text-sm text-slate-500 lg:col-span-4">
                    Belum ada fokus area yang aktif dari halaman admin.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="program" class="relative overflow-hidden bg-slate-50 py-24">
    <div class="pointer-events-none absolute right-0 top-0 h-[800px] w-[800px] translate-x-1/3 -translate-y-1/2 rounded-full bg-emerald-100 opacity-50 blur-[100px]"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-6">
        <div class="mb-16 flex flex-col justify-between gap-6 md:flex-row md:items-end">
            <div class="max-w-2xl">
                <span class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">Donasi Mendesak</span>
                <h2 class="font-display mb-4 text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Salurkan Kebaikan Anda <span class="text-emerald-500">Hari Ini</span>
                </h2>
                <p class="text-lg leading-relaxed text-slate-500">
                    Pilih program galang dana yang sedang berjalan. Bantuan sekecil apapun dari Anda sangat berarti bagi yang membutuhkan.
                </p>
            </div>
            <a href="<?php echo e(route('programs')); ?>" class="flex items-center gap-2 whitespace-nowrap font-bold text-emerald-600 transition-colors hover:text-emerald-700">
                Lihat Semua Program
                <i class="ph ph-arrow-right text-xl"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $homeCampaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $daysLeft = max(0, now()->diffInDays($campaign->deadline, false));
                    $progress = (int) min(100, round(((int) $campaign->collected / max((int) $campaign->target, 1)) * 100));
                    $isUrgent = $campaign->status === 'aktif' && $daysLeft <= 7;
                    $campaignImage = $campaignFallbackImages[$campaign->category] ?? $campaignFallbackImages['default'];
                ?>

                <article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50 transition-transform duration-300 hover:-translate-y-2">
                    <div class="relative h-56 overflow-hidden">
                        <img src="<?php echo e($campaignImage); ?>" alt="<?php echo e($campaign->title); ?>" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        <div class="absolute left-4 top-4 rounded-lg bg-white/90 px-3 py-1.5 text-xs font-bold text-slate-700 shadow-sm backdrop-blur-sm">
                            <?php echo e($campaign->category ?? 'Umum'); ?>

                        </div>
                        <?php if($isUrgent): ?>
                            <div class="absolute right-4 top-4 rounded-lg bg-rose-500 px-3 py-1.5 text-xs font-bold text-white shadow-sm">
                                Mendesak
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="landing-clamp-2 mb-4 text-xl font-bold leading-snug text-slate-900 transition-colors group-hover:text-emerald-600">
                            <?php echo e($campaign->title); ?>

                        </h3>

                        <div class="mt-auto">
                            <div class="mb-2 flex items-end justify-between">
                                <div>
                                    <p class="mb-1 text-xs font-medium text-slate-500">Terkumpul</p>
                                    <p class="text-lg font-bold leading-none text-emerald-600"><?php echo e($formatCurrency($campaign->collected)); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="mb-1 text-[10px] font-medium uppercase tracking-wider text-slate-400">Target</p>
                                    <p class="text-sm font-bold leading-none text-slate-600"><?php echo e($formatCurrency($campaign->target)); ?></p>
                                </div>
                            </div>

                            <div class="relative mb-4 h-2.5 w-full overflow-hidden rounded-full bg-slate-100">
                                <div class="absolute left-0 top-0 h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-500" style="width: <?php echo e($progress); ?>%"></div>
                            </div>

                            <div class="flex items-center justify-between rounded-xl bg-slate-50 p-3 text-xs font-bold text-slate-500">
                                <div class="flex items-center gap-1.5">
                                    <i class="ph ph-users text-base text-slate-400"></i>
                                    <?php echo e(number_format(max(1, (int) floor(((int) $campaign->collected) / 100000)), 0, ',', '.')); ?> Donatur
                                </div>
                                <div class="flex items-center gap-1.5 text-amber-600">
                                    <i class="ph ph-heartbeat text-base"></i>
                                    Sisa <?php echo e($daysLeft); ?> Hari
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo e(route('donation.form', ['campaign' => $campaign->id])); ?>" class="mt-6 block w-full rounded-xl bg-emerald-500 py-3.5 text-center text-sm font-bold text-white shadow-lg shadow-emerald-500/30 transition-colors hover:bg-emerald-600">
                            Donasi Sekarang
                        </a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-[2rem] border border-dashed border-slate-200 bg-white p-8 text-sm text-slate-500 lg:col-span-3">
                    Belum ada campaign aktif yang siap ditampilkan dari admin.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="mitra" class="overflow-hidden border-t border-slate-100 bg-white py-20">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-12 text-center">
            <p class="mb-2 text-sm font-bold uppercase tracking-[0.25em] text-slate-400">Didukung Oleh</p>
            <h2 class="font-display text-3xl font-extrabold text-slate-900">Kolaborator Kebaikan</h2>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-8 opacity-60 transition-opacity duration-500 hover:opacity-100 md:gap-16">
            <?php $__empty_1 = true; $__currentLoopData = $homePartners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group relative flex flex-col items-center justify-center transition-all duration-300 hover:grayscale-0">
                    <img src="<?php echo e($partner->logo); ?>" alt="<?php echo e($partner->name); ?>" class="h-10 object-contain transition-transform duration-300 group-hover:scale-110 md:h-12">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-500">Belum ada logo partner aktif yang ditampilkan.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="bg-white px-6 py-20">
    <div class="container mx-auto max-w-4xl overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-emerald-800 p-8 text-center text-white shadow-xl md:p-12">
        <div class="relative z-10 mx-auto flex max-w-xl flex-col items-center space-y-4">
            <div class="mb-2 rounded-2xl bg-white/10 p-3 text-white backdrop-blur-sm">
                <i class="ph ph-handshake text-3xl"></i>
            </div>
            <h2 class="text-2xl font-black leading-snug md:text-3xl">Menyalurkan Kebaikan Secara Langsung</h2>
            <p class="text-sm leading-relaxed text-white/80">
                Kami membutuhkan tenaga Anda untuk membantu operasional lapangan, mulai dari pengepakan logistik hingga penyaluran bantuan langsung ke tangan penerima manfaat.
            </p>
            <div class="flex w-full flex-col justify-center gap-4 pt-4 sm:flex-row">
                <a href="<?php echo e(route('get-involved')); ?>" class="rounded-xl bg-white px-6 py-3 text-center text-sm font-bold text-emerald-800 shadow-md transition hover:bg-slate-50">Gabung Jadi Relawan</a>
                <a href="<?php echo e(route('faq')); ?>" class="rounded-xl border border-white/40 px-6 py-3 text-center text-sm font-bold text-white transition hover:bg-white/10">Tanya Jawab (FAQ)</a>
            </div>
        </div>
    </div>
</section>

<section id="kontak" class="relative overflow-hidden border-t border-slate-100 bg-white py-24">
    <div class="absolute right-0 top-0 -z-10 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/2 rounded-full bg-slate-50 blur-3xl"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-16 px-6 md:grid-cols-2">
        <div class="max-w-lg">
            <span class="mb-4 flex items-center gap-2 text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">
                <i class="ph ph-chat-text text-xl"></i>
                Hubungi Kami
            </span>
            <h2 class="font-display mb-6 text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                Punya Pertanyaan atau <span class="text-emerald-500">Inisiasi Kolaborasi?</span>
            </h2>
            <p class="mb-8 text-lg leading-relaxed text-slate-500">
                Pesan yang dikirim melalui formulir ini akan langsung diterima oleh kotak masuk admin organisasi.
            </p>
            <div class="flex gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i class="ph ph-envelope-open text-2xl"></i>
                </div>
                <div>
                    <p class="text-lg font-bold text-slate-800">Respon Cepat 1x24 Jam</p>
                    <p class="text-sm text-slate-500">Tim humas kami terpantau aktif di hari kerja.</p>
                </div>
            </div>
        </div>

        <div class="relative rounded-3xl border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50 md:p-10">
            <?php if(session('success')): ?>
                <div class="animate-fade-in py-16 text-center">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <i class="ph ph-check-circle text-[40px]"></i>
                    </div>
                    <h3 class="mb-3 text-2xl font-extrabold text-slate-900">Pesan Terkirim!</h3>
                    <p class="mx-auto mb-8 max-w-sm text-slate-500">
                        <?php echo e(session('success')); ?>

                    </p>
                    <a href="<?php echo e(route('home')); ?>#kontak" class="border-b-2 border-emerald-600/30 pb-1 font-bold text-emerald-600 transition-colors hover:text-emerald-700">
                        Kirim Pesan Lainnya
                    </a>
                </div>
            <?php else: ?>
                <?php if($errors->any()): ?>
                    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <ul class="list-inside list-disc space-y-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="flex flex-col gap-6">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nama Pengirim</label>
                        <div class="relative">
                            <i class="ph ph-user absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Nama Anda atau Organisasi" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                        </div>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Email Balasan</label>
                        <div class="relative">
                            <i class="ph ph-envelope-open absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>
                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="alamat@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                        </div>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Isi Pesan</label>
                        <textarea name="message" rows="4" required placeholder="Tuliskan tujuan / masalah yang ingin didiskusikan..." class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20"><?php echo e(old('message')); ?></textarea>
                    </div>
                    <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-xl bg-emerald-600 py-4 font-bold text-white shadow-lg transition-all hover:bg-emerald-700">
                        Kirim Pesan
                        <i class="ph ph-paper-plane-tilt text-xl"></i>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\home.blade.php ENDPATH**/ ?>