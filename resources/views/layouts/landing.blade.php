<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fundunity') }} - @yield('title', 'Bersama Ciptakan Perubahan')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|poppins:400,500,600,700,800&display=swap" rel="stylesheet" />

    {{-- Tailwind CSS CDN (untuk development) --}}
    {{-- Untuk production, jalankan: npm run build dan uncomment @vite directive dibawah --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="font-sans antialiased bg-white">
    {{-- Navbar --}}
    <x-landing.navbar />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-landing.footer />

    @stack('scripts')
</body>
</html>
