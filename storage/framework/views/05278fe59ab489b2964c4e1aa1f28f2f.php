<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anda Sedang Offline - <?php echo e($siteSettings['site_name'] ?? 'FundUnity'); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=open-sans:400,600,700&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 28rem;
            padding: 2rem;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            margin: 1rem;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background-color: #059669;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo img {
            max-width: 60%;
            max-height: 60%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }
        p {
            font-size: 0.95rem;
            line-height: 1.5;
            color: #64748b;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
            cursor: pointer;
            border: none;
        }
        .btn:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="<?php echo e(!empty($siteSettings['site_logo']) ? $siteSettings['site_logo'] : '/images/Logo.png'); ?>" alt="<?php echo e($siteSettings['site_short_name'] ?? 'FundUnity'); ?>">
        </div>
        <h1>Koneksi Terputus</h1>
        <p>Sepertinya Anda sedang tidak terhubung ke internet. Silakan periksa jaringan Anda dan coba lagi.</p>
        <button class="btn" onclick="window.location.reload()">Coba Lagi</button>
    </div>
</body>
</html>
<?php /**PATH D:\coding\fundunity\resources\views/landing/offline.blade.php ENDPATH**/ ?>