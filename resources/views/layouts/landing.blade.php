<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['site_name'] ?? config('app.name', 'Fundunity') }} - @yield('title', 'Wujudkan Dampak Nyata')</title>

    @if(!empty($siteSettings['site_logo']))
        <link rel="icon" href="{{ $siteSettings['site_logo'] }}" type="image/png">
    @else
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=open-sans:300,400,500,600,700,800|montserrat:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background: #ffffff;
            color: #0f172a;
        }

        .landing-fade-up {
            animation: landing-fade-up 0.7s ease-out both;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out both;
        }

        .animate-slide-up {
            animation: slide-up 0.7s ease-out both;
        }

        @keyframes landing-fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('head')
</head>
<body data-page="@yield('body-data','')">
    <div class="bg-white text-slate-900 font-sans min-h-screen flex flex-col">
        <x-landing.navbar />

        <main class="flex-1">
            @yield('content')
        </main>

        <x-landing.footer />
    </div>

    @stack('scripts')
</body>
</html>
