<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FundUnity') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 to-teal-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-emerald-600 rounded-full flex items-center justify-center">
                    <span class="text-2xl font-bold text-white">FU</span>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    FundUnity
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Komunitas Ruang Berbagi
                </p>
            </div>

            <!-- Form Container -->
            <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-100">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
