@props(['class' => 'h-10 w-10', 'iconClass' => 'text-xl', 'containerClass' => 'bg-emerald-100/80 text-emerald-600 rounded-xl'])

@php
    $rawLogo = $siteSettings['site_logo'] ?? null;
    $logoUrl = filled($rawLogo) ? (str_starts_with($rawLogo, 'http') ? $rawLogo : asset($rawLogo)) : null;
    $hasLogo = filled($logoUrl);
@endphp

@if($hasLogo)
    <img src="{{ $logoUrl }}" alt="Logo" {{ $attributes->merge(['class' => 'object-contain ' . $class]) }}>
@else
    <div {{ $attributes->merge(['class' => 'flex items-center justify-center ' . $containerClass . ' ' . $class]) }}>
        <i class="ph ph-image {{ $iconClass }}"></i>
    </div>
@endif
