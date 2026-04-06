<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - FundUnity</title>

    <!-- CSS Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* ════════════════════════════════════════════════════════════════════════
           FUNDUNITY ADMIN LAYOUT - CLEANLY ORGANIZED CSS STYLESHEET
           ════════════════════════════════════════════════════════════════════════ */

        /* ─────────────────────────────────────────────────────────────────────────
           1. RESET & GLOBAL STYLES
           ───────────────────────────────────────────────────────────────────────── */

        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* ─────────────────────────────────────────────────────────────────────────
           2. SIDEBAR SECTION
           ───────────────────────────────────────────────────────────────────────── */

        /* Sidebar Main Container */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-radius: 0 24px 24px 0;
            transition: width 0.3s ease-in-out;
            z-index: 40;
        }

        #sidebar.open {
            width: 224px;
        }

        #sidebar.closed {
            width: 72px;
        }

        /* Logo Section */
        .sidebar-logo {
            flex-shrink: 0;
            margin-top: 24px;
            margin-bottom: 32px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease-in-out;
        }

        #sidebar.closed .sidebar-logo {
            padding: 0;
            justify-content: center;
        }

        .sidebar-logo img {
            height: 36px;
            width: auto;
            object-fit: contain;
            transition: all 0.3s ease-in-out;
        }

        #sidebar.closed .sidebar-logo img {
            width: 36px;
            height: 36px;
            border-radius: 8px;
        }

        .sidebar-logo span {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            white-space: nowrap;
            opacity: 0.95;
            transition: opacity 0.3s ease-in-out;
        }

        #sidebar.closed .sidebar-logo span {
            display: none;
        }

        /* Navigation Container */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 4px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Navigation Item */
        .nav-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 16px;
            border: none;
            background: transparent;
            color: rgba(226, 232, 240, 0.9);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .nav-item:hover {
            background-color: rgba(5, 150, 105, 0.4);
            color: white;
        }

        /* Icon sizing - Consistent 19px (matches React PiHouse, PiMegaphone, etc.) */
        .nav-item i {
            flex-shrink: 0;
            font-size: 19px;
            width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-item span:not(.nav-item-tooltip) {
            transition: opacity 0.3s ease-in-out;
        }

        #sidebar.closed .nav-item {
            justify-content: center;
            padding: 10px 0;
            gap: 0;
        }

        #sidebar.closed .nav-item span:not(.nav-item-tooltip) {
            display: none;
        }

        /* Active Navigation State */
        .nav-item.active {
            background-color: rgb(248, 250, 252);
            color: #10b981;
            border-radius: 0 24px 24px 0;
            margin-right: -12px;
            padding-right: 28px;
        }

        #sidebar.closed .nav-item.active {
            border-radius: 16px;
            margin-right: 0;
            padding-right: 16px;
        }

        /* Curved corners decoration for active item (only on expanded) */
        .nav-item.active::before {
            content: "";
            position: absolute;
            top: -16px;
            right: 0;
            width: 16px;
            height: 16px;
            background: transparent;
            border-bottom-right-radius: 16px;
            box-shadow: 4px 4px 0 4px rgb(248, 250, 252);
            pointer-events: none;
        }

        .nav-item.active::after {
            content: "";
            position: absolute;
            bottom: -16px;
            right: 0;
            width: 16px;
            height: 16px;
            background: transparent;
            border-top-right-radius: 16px;
            box-shadow: 4px -4px 0 4px rgb(248, 250, 252);
            pointer-events: none;
        }

        #sidebar.closed .nav-item.active::before,
        #sidebar.closed .nav-item.active::after {
            display: none;
        }

        /* Tooltip for collapsed sidebar */
        .nav-item-tooltip {
            position: absolute;
            left: 100%;
            margin-left: 12px;
            padding: 6px 12px;
            background-color: rgb(55, 65, 81);
            color: white;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
        }

        #sidebar.closed .nav-item:hover .nav-item-tooltip {
            opacity: 1;
            visibility: visible;
        }

        /* Sidebar Scrollbar */
        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Logout Section */
        .sidebar-logout {
            padding: 24px 12px;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border: none;
            border-radius: 12px;
            background: transparent;
            color: rgba(226, 232, 240, 0.9);
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            white-space: nowrap;
            transition: all 0.15s ease-in-out;
        }

        .logout-btn:hover {
            background-color: rgba(220, 38, 38, 0.15);
            color: rgb(248, 113, 113);
        }

        /* Icon sizing - Consistent 19px (matches React PiDoorOpen) */
        .logout-btn i {
            flex-shrink: 0;
            font-size: 19px;
            width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn span {
            transition: opacity 0.3s ease-in-out;
        }

        #sidebar.closed .logout-btn {
            justify-content: center;
            padding: 10px 0;
            gap: 0;
        }

        #sidebar.closed .logout-btn span {
            display: none;
        }

        /* Toggle Sidebar Button */
        #toggleSidebar {
            position: absolute;
            top: 32px;
            right: -12px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            color: rgb(71, 85, 105);
            transition: all 0.15s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        #toggleSidebar:hover {
            color: #10b981;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Icon sizing - Consistent 13px (matches React PiCaretLeft/Right) */
        #toggleSidebar i {
            font-size: 13px;
            width: 13px;
            height: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ─────────────────────────────────────────────────────────────────────────
           3. MAIN CONTENT SECTION
           ───────────────────────────────────────────────────────────────────────── */

        /* Main Content Container */
        #mainContent {
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
            margin-left: 224px;
            width: calc(100% - 224px);
        }

        #mainContent.sidebar-closed {
            margin-left: 72px;
            width: calc(100% - 72px);
        }

        .main-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: rgb(241, 245, 249);
        }

        /* Header */
        #header {
            background-color: white;
            border-bottom: 1px solid rgb(226, 232, 240);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 30;
            width: 100%;
        }

        .header-title h1 {
            font-size: 16px;
            font-weight: 700;
            color: rgb(15, 23, 42);
            line-height: 1.5;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .header-title p {
            font-size: 12px;
            color: rgb(148, 163, 184);
            margin: 2px 0 0 0;
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .user-profile:hover .user-name {
            color: #10b981;
        }

        .user-name {
            font-size: 12px;
            font-weight: 700;
            color: rgb(55, 65, 81);
            transition: color 0.15s ease-in-out;
            display: none;
        }

        @media (min-width: 640px) {
            .user-name {
                display: block;
            }
        }

        /* User Avatar */
        .user-avatar {
            position: relative;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(240, 253, 250);
            border: 1px solid rgb(204, 251, 241);
            border-radius: 50%;
            color: #10b981;
            transition: all 0.15s ease-in-out;
        }

        .user-profile:hover .user-avatar {
            background-color: rgb(204, 251, 241);
        }

        /* Icon sizing - Consistent 16px (matches React User icon) */
        .user-avatar i {
            font-size: 16px;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Settings Badge */
        .user-settings-badge {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: 1px solid rgb(226, 232, 240);
            border-radius: 50%;
        }

        /* Icon sizing - Consistent 8px (matches React Settings icon) */
        .user-settings-badge i {
            font-size: 8px;
            width: 8px;
            height: 8px;
            color: rgb(148, 163, 184);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile:hover .user-settings-badge i {
            color: #10b981;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 32px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
            margin-bottom: 40px;
        }

        /* ─────────────────────────────────────────────────────────────────────────
           4. MODAL SECTION
           ───────────────────────────────────────────────────────────────────────── */

        .modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(2px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            z-index: 60;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 16px;
            border: 1px solid rgb(226, 232, 240);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 448px;
            overflow: hidden;
            animation: modal-scale-in 0.18s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modal-scale-in {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-8px);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-header {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .modal-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(254, 242, 242);
            color: rgb(220, 38, 38);
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Icon sizing - Consistent 20px (matches React icons in modal) */
        .modal-icon i {
            font-size: 20px;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-text h2 {
            font-size: 16px;
            font-weight: 700;
            color: rgb(30, 41, 59);
            margin: 0 0 2px 0;
        }

        .modal-text p {
            font-size: 14px;
            color: rgb(100, 116, 139);
            margin: 2px 0 0 0;
        }

        .modal-footer {
            padding: 0 24px 24px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .modal-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .modal-btn.cancel {
            background-color: white;
            border: 1px solid rgb(226, 232, 240);
            color: rgb(55, 65, 81);
        }

        .modal-btn.cancel:hover {
            background-color: rgb(241, 245, 249);
        }

        .modal-btn.confirm {
            background-color: rgb(220, 38, 38);
            color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .modal-btn.confirm:hover {
            background-color: rgb(185, 28, 28);
        }

        /* ─────────────────────────────────────────────────────────────────────────
           5. RESPONSIVE DESIGN
           ───────────────────────────────────────────────────────────────────────── */

        @media (max-width: 768px) {
            #sidebar {
                width: 72px;
            }

            #mainContent {
                margin-left: 72px;
                width: calc(100% - 72px);
            }

            .sidebar-logo span {
                display: none;
            }

            .nav-item span:not(.nav-item-tooltip) {
                display: none;
            }

            .logout-btn span {
                display: none;
            }

            #header {
                padding: 16px;
            }

            .user-name {
                display: none !important;
            }

            .content-area {
                padding: 16px;
            }
        }
    </style>
</head>
<body class="bg-slate-50 font-sans">
    <!-- =====================================================================
         SIDEBAR
         ===================================================================== -->
    <div id="sidebar" class="open">
        <!-- Logo Area -->
        <div class="sidebar-logo">
            <img alt="FundUnity" src="{{ asset('src/assets/images/Logo.png') }}" />
            <span>FundUnity</span>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
                <span class="nav-item-tooltip">Dashboard</span>
            </a>

            <a href="{{ route('admin.programs.index') }}" class="nav-item{{ request()->routeIs('admin.programs.*') ? ' active' : '' }}">
                <i class="fas fa-megaphone"></i>
                <span>Campaign</span>
                <span class="nav-item-tooltip">Campaign</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Keuangan</span>
                <span class="nav-item-tooltip">Keuangan & Audit</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Relasi</span>
                <span class="nav-item-tooltip">Data Relasi</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-envelope-open"></i>
                <span>Kotak Masuk</span>
                <span class="nav-item-tooltip">Kotak Masuk</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-building"></i>
                <span>Profil Lembaga</span>
                <span class="nav-item-tooltip">Profil Lembaga</span>
            </a>

            <a href="{{ route('admin.focus-areas.index') }}" class="nav-item{{ request()->routeIs('admin.focus-areas.*') ? ' active' : '' }}">
                <i class="fas fa-bullseye"></i>
                <span>Fokus Area</span>
                <span class="nav-item-tooltip">Fokus Area</span>
            </a>

            <a href="{{ route('admin.gallery-items.index') }}" class="nav-item{{ request()->routeIs('admin.gallery-items.*') ? ' active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Banner Slider</span>
                <span class="nav-item-tooltip">Banner Slider</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-handshake"></i>
                <span>Mitra Kami</span>
                <span class="nav-item-tooltip">Mitra Kami</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-comments"></i>
                <span>Tanya Jawab</span>
                <span class="nav-item-tooltip">Tanya Jawab</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                <span>Akun & Sistem</span>
                <span class="nav-item-tooltip">Akun & Sistem</span>
            </a>
        </nav>

        <!-- Logout Section -->
        <div class="sidebar-logout">
            <button class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
                <span class="nav-item-tooltip">Keluar</span>
            </button>
        </div>

        <!-- Toggle Sidebar Button -->
        <button id="toggleSidebar">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <!-- =====================================================================
         MAIN CONTENT
         ===================================================================== -->
    <div id="mainContent">
        <div class="main-container">
            <!-- Header -->
            <div id="header">
                <div class="header-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-subtitle', 'Statistik performa dan ringkasan pergerakan organisasi.')</p>
                </div>
                <div class="header-actions">
                    <div class="user-profile" id="userProfile">
                        <span class="user-name">Admin</span>
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                            <div class="user-settings-badge">
                                <i class="fas fa-cog"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- =====================================================================
         LOGOUT CONFIRMATION MODAL
         ===================================================================== -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="modal-text">
                    <h2>Akhiri Sesi?</h2>
                    <p>Anda akan keluar dari panel admin.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn cancel" id="cancelLogout">Batal</button>
                <button class="modal-btn confirm" id="confirmLogout">Ya, Keluar</button>
            </div>
        </div>
    </div>

    <!-- =====================================================================
         JAVASCRIPT
         ===================================================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleButton = document.getElementById('toggleSidebar');
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');
            const userProfile = document.getElementById('userProfile');

            let isSidebarOpen = true;

            // ─────────────────────────────────────────────────────────────
            // Sidebar Toggle Handler
            // ─────────────────────────────────────────────────────────────
            toggleButton.addEventListener('click', function() {
                isSidebarOpen = !isSidebarOpen;

                if (isSidebarOpen) {
                    sidebar.classList.remove('closed');
                    sidebar.classList.add('open');
                    mainContent.classList.remove('sidebar-closed');
                    toggleButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
                } else {
                    sidebar.classList.remove('open');
                    sidebar.classList.add('closed');
                    mainContent.classList.add('sidebar-closed');
                    toggleButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
                }
            });

            // ─────────────────────────────────────────────────────────────
            // Logout Modal Handlers
            // ─────────────────────────────────────────────────────────────
            logoutBtn.addEventListener('click', function() {
                logoutModal.classList.add('active');
            });

            cancelLogout.addEventListener('click', function() {
                logoutModal.classList.remove('active');
            });

            // Close modal when clicking outside
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    logoutModal.classList.remove('active');
                }
            });

            confirmLogout.addEventListener('click', function() {
                // Redirect to logout route
                window.location.href = '{{ route('logout') }}';
            });

            // ─────────────────────────────────────────────────────────────
            // User Profile Settings Click
            // ─────────────────────────────────────────────────────────────
            // userProfile.addEventListener('click', function() {
            //     // Update dengan route settings yang sesuai
            //     // window.location.href = '';
            // });
        });
    </script>
</body>
</html>
