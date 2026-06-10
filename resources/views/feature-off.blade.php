<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oops! Fitur sedang istirahat 🛠️</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            background: #ffffff;
            color: #0f172a;
        }

        .bg-blur {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 0;
        }

        .wrap {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 560px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(2, 6, 23, 0.12);
        }

        .title {
            font-weight: 900;
            letter-spacing: -0.02em;
            font-size: 22px;
            margin: 0;
        }

        .subtitle {
            margin-top: 10px;
            color: rgba(15, 23, 42, 0.76);
            font-weight: 700;
            font-size: 14px;
            line-height: 1.55;
        }

        .btn {
            margin-top: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px 16px;
            border-radius: 14px;
            background: #065f46;
            color: #ffffff;
            font-weight: 900;
            border: 0;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover { background: #064e3b; }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(6, 95, 70, 0.10);
            border: 1px solid rgba(6, 95, 70, 0.20);
            color: #065f46;
            font-weight: 900;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="bg-blur"></div>

    <div class="wrap">
        <div class="card">
            <div class="pill"><i class="ph ph-wrench"></i> Offline Feature</div>
            <h1 class="title">Oops! Fitur sedang istirahat</h1>
            <div class="subtitle">{{ $message ?? 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!' }}</div>

            <a class="btn" href="{{ route('landing.home') }}">
                <i class="ph ph-arrow-left"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>

