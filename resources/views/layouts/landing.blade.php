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

        /* Splash Screen Preloader */
        #splash-screen {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease-in-out, visibility 0.6s;
        }
        #splash-screen.hidden-splash {
            opacity: 0;
            visibility: hidden;
        }
        .splash-logo {
            width: 80px;
            height: 80px;
            animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .splash-text {
            margin-top: 1rem;
            font-weight: 800;
            font-size: 1.25rem;
            color: #059669; /* emerald-600 */
            letter-spacing: 0.05em;
            animation: fadePulse 1.5s ease-in-out infinite alternate;
        }
        @keyframes fadePulse {
            0% { opacity: 0.5; }
            100% { opacity: 1; }
        }

    </style>

    @stack('head')
</head>
<body data-page="@yield('body-data','')">
    <!-- Splash Screen Preloader -->
    <div id="splash-screen">
        @if(!empty($siteSettings['site_logo']))
            <img src="{{ $siteSettings['site_logo'] }}" alt="Logo" class="splash-logo object-contain">
        @else
            <div class="splash-logo bg-emerald-600 rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                {{ substr(config('app.name', 'FundUnity'), 0, 1) }}
            </div>
        @endif
        <div class="splash-text">{{ $siteSettings['site_name'] ?? config('app.name', 'FundUnity') }}</div>
    </div>

    <div class="bg-white text-slate-900 font-sans min-h-screen flex flex-col">
        <x-landing.navbar />

        <main class="flex-1">
            @yield('content')
        </main>

        <x-landing.footer />
    </div>
    @stack('scripts')
    <script>
        // Remove splash screen on page load
        window.addEventListener('load', () => {
            const splash = document.getElementById('splash-screen');
            if(splash) {
                splash.classList.add('hidden-splash');
                setTimeout(() => splash.remove(), 600);
            }
        });
    </script>
</body>
</html>
