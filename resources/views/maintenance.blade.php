<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemeliharaan Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-6">
    <main class="w-full max-w-2xl rounded-3xl border border-slate-800 bg-slate-900/70 p-10 text-center shadow-2xl">
        <p class="inline-flex items-center gap-2 rounded-full border border-amber-400/30 bg-amber-400/10 px-4 py-1 text-xs font-bold uppercase tracking-wider text-amber-300">
            Status Sistem
        </p>

        <h1 class="mt-6 text-3xl sm:text-4xl font-black">Website Sedang Dalam Pemeliharaan</h1>

        <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed">
            {{ $message ?? 'Website sedang dalam pemeliharaan. Silakan kembali lagi nanti.' }}
        </p>

        <p class="mt-8 text-xs text-slate-400">FundUnity akan segera kembali online.</p>
    </main>
</body>
</html>
