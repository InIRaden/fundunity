@extends('layouts.landing')

@section('title', 'FAQ')

@section('content')
@php
    $faqItems = collect($faqs ?? []);
@endphp

<div class="relative min-h-[70vh] bg-slate-50 pb-12 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <section class="border-t border-slate-100 bg-slate-50 py-24">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-16 text-center">
                <h1 class="font-display mb-4 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Pertanyaan yang Sering <span class="text-emerald-500">Diajukan</span>
                </h1>
                <p class="text-lg text-slate-500">Kami merangkum jawaban dari pertanyaan yang paling sering muncul agar pengunjung lebih yakin sebelum berkontribusi.</p>
            </div>

            <div class="space-y-4">
                @forelse($faqItems as $index => $faq)
                    <article class="faq-item {{ $index === 0 ? 'rounded-2xl bg-white p-2 shadow-xl shadow-slate-200/50 md:-mx-6 md:p-6' : 'border-b border-slate-200 py-4' }}" data-open="{{ $index === 0 ? 'true' : 'false' }}">
                        <button type="button" class="faq-trigger flex w-full items-center justify-between text-left font-bold text-slate-900 transition-colors hover:text-emerald-600">
                            <span class="{{ $index === 0 ? 'text-xl' : 'text-lg' }}">{{ $faq->question }}</span>
                            <span class="faq-icon {{ $index === 0 ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }} flex h-8 w-8 shrink-0 items-center justify-center rounded-full transition-colors">
                                <i class="ph {{ $index === 0 ? 'ph-minus' : 'ph-plus' }}"></i>
                            </span>
                        </button>

                        <div class="faq-body {{ $index === 0 ? 'mt-4 block' : 'hidden' }}">
                            <p class="pr-8 leading-relaxed text-slate-500">{{ $faq->answer }}</p>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-500">
                        FAQ belum tersedia dari admin.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.faq-item').forEach(function (item) {
            const trigger = item.querySelector('.faq-trigger');
            const body = item.querySelector('.faq-body');
            const iconWrap = item.querySelector('.faq-icon');
            const icon = iconWrap?.querySelector('i');

            trigger?.addEventListener('click', function () {
                const isOpen = item.dataset.open === 'true';

                document.querySelectorAll('.faq-item').forEach(function (other) {
                    const otherBody = other.querySelector('.faq-body');
                    const otherIconWrap = other.querySelector('.faq-icon');
                    const otherIcon = otherIconWrap?.querySelector('i');
                    const title = other.querySelector('.faq-trigger span');

                    other.dataset.open = 'false';
                    other.classList.remove('rounded-2xl', 'bg-white', 'p-2', 'shadow-xl', 'shadow-slate-200/50', 'md:-mx-6', 'md:p-6');
                    other.classList.add('border-b', 'border-slate-200', 'py-4');
                    otherBody?.classList.add('hidden');
                    otherBody?.classList.remove('mt-4', 'block');
                    otherIconWrap?.classList.remove('bg-emerald-100', 'text-emerald-600');
                    otherIconWrap?.classList.add('bg-slate-100', 'text-slate-500');
                    if (otherIcon) {
                        otherIcon.classList.remove('ph-minus');
                        otherIcon.classList.add('ph-plus');
                    }
                    if (title) {
                        title.classList.remove('text-xl');
                        title.classList.add('text-lg');
                    }
                });

                if (!isOpen) {
                    item.dataset.open = 'true';
                    item.classList.add('rounded-2xl', 'bg-white', 'p-2', 'shadow-xl', 'shadow-slate-200/50', 'md:-mx-6', 'md:p-6');
                    item.classList.remove('border-b', 'border-slate-200', 'py-4');
                    body?.classList.remove('hidden');
                    body?.classList.add('mt-4', 'block');
                    iconWrap?.classList.add('bg-emerald-100', 'text-emerald-600');
                    iconWrap?.classList.remove('bg-slate-100', 'text-slate-500');
                    if (icon) {
                        icon.classList.remove('ph-plus');
                        icon.classList.add('ph-minus');
                    }
                    const title = trigger.querySelector('span');
                    title?.classList.remove('text-lg');
                    title?.classList.add('text-xl');
                }
            });
        });
    });
</script>
@endpush
