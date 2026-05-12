@extends('layouts.landing')

@section('title', 'FAQ')

@section('content')
@php
    $faqItems = collect($faqs ?? []);
@endphp

<div class="relative min-h-[70vh] bg-slate-50 pb-12 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <section class="py-24 bg-slate-50 border-t border-slate-100">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-16 text-center">
                <h1 class="text-2xl md:text-4xl font-bold text-emerald-600 leading-tight mb-4">
                    Pertanyaan yang Sering Diajukan</span>
                </h1>
                <p class="text-slate-500 text-md">Kami kumpulkan pertanyaan yang paling sering ditanyakan oleh donatur dan relawan untuk memudahkan Anda memahami cara kerja platform kami.</p>
            </div>

            <div class="space-y-4">
                @forelse($faqItems as $index => $faq)
                    <article class="faq-item {{ $index === 0 ? 'bg-white rounded-2xl border-none shadow-xl shadow-slate-200/50 p-2 md:p-6 mb-4 -mx-2 md:-mx-6' : 'border-b border-slate-200 py-4' }}" data-open="{{ $index === 0 ? 'true' : 'false' }}">
                        <button type="button" class="faq-trigger flex items-center justify-between w-full text-left font-bold text-slate-900 hover:text-emerald-600 transition-colors">
                            <span class="{{ $index === 0 ? 'text-xl' : 'text-lg' }}">{{ $faq->question }}</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors {{ $index === 0 ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg data-icon="plus" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="{{ $index === 0 ? 'hidden' : '' }}"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
                                <svg data-icon="minus" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="{{ $index === 0 ? '' : 'hidden' }}"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128Z"></path></svg>
                            </span>
                        </button>

                        <div class="faq-body overflow-hidden transition-all duration-300 {{ $index === 0 ? 'max-h-96 mt-4 opacity-100' : 'max-h-0 opacity-0' }}">
                            <p class="text-slate-500 leading-relaxed pr-8">{{ $faq->answer }}</p>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-500">
                        Belum ada pertanyaan yang tersedia. Silakan <a href="{{ $siteSettings['whatsapp_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-emerald-600 font-bold hover:underline">hubungi kami via WhatsApp</a>.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    <x-landing.cta />
</div>
@endsection

@push('scripts')
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
@endpush
