@php
    $isAuthStandalonePage = request()->routeIs('login') || request()->routeIs('logout.confirm');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['site_name'] ?? 'FundUnity' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|sora:600,700,800&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Sora"', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">

    @stack('head')
</head>
<body class="font-sans antialiased text-slate-900">
    @if ($isAuthStandalonePage)
        {{ $slot }}
    @else
        <div class="flex min-h-screen flex-col items-center justify-center bg-slate-100 px-4 py-6">
            <div class="w-full max-w-md overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl">
                <div class="border-b border-slate-100 px-8 py-6 text-center">
                    <a href="{{ route('landing.home') }}" class="font-display text-2xl font-extrabold tracking-tight text-slate-900">
                        {{ $siteSettings['site_name'] ?? 'FundUnity' }}<span class="text-emerald-500">.</span>
                    </a>
                </div>

                <div class="px-6 py-8 sm:px-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    @endif

    @stack('scripts')
</body>
</html>
