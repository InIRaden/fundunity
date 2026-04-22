<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['site_name'] ?? config('app.name', 'Fundunity') }} - @yield('title', 'Wujudkan Dampak Nyata')</title>

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
                    boxShadow: {
                        soft: '0 24px 60px rgba(15, 23, 42, 0.12)',
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">

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
    </style>

    @stack('head')
</head>
<body class="font-sans antialiased">
    <x-landing.navbar />

    <main>
        @yield('content')
    </main>

    <x-landing.footer />

    @stack('scripts')
</body>
</html>
