/**
 * PWA Service Worker Registration & Install Prompt
 * Fundunity — resources/js/pwa.js
 *
 * Menangani:
 * 1. Registrasi Service Worker (/sw.js)
 * 2. Custom "Add to Home Screen" install banner
 * 3. Deteksi offline/online untuk notifikasi user
 * 4. Background sync placeholder untuk form kontak
 */

// ─── 1. SERVICE WORKER REGISTRATION ─────────────────────────────────────────

export function registerServiceWorker() {
    if (!('serviceWorker' in navigator)) {
        console.info('[PWA] Service Worker tidak didukung browser ini.');
        return;
    }

    // Hanya register SW di halaman landing (bukan admin panel)
    const isAdminPath = window.location.pathname.startsWith('/admin');
    if (isAdminPath) return;

    window.addEventListener('load', async () => {
        try {
            const registration = await navigator.serviceWorker.register('/sw.js', {
                scope: '/',
            });

            console.info('[PWA] Service Worker terdaftar:', registration.scope);

            // Cek update SW secara periodik (setiap 1 jam)
            setInterval(() => {
                registration.update();
            }, 60 * 60 * 1000);

            // Jika ada SW baru yang menunggu, reload halaman otomatis setelah delay
            registration.addEventListener('updatefound', () => {
                const newWorker = registration.installing;
                if (!newWorker) return;

                newWorker.addEventListener('statechange', () => {
                    if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                        console.info('[PWA] Update tersedia. Memuat ulang...');
                        // Tampilkan notifikasi update ke user
                        showUpdateBanner();
                    }
                });
            });
        } catch (error) {
            console.warn('[PWA] Registrasi Service Worker gagal:', error);
        }
    });
}

// ─── 2. INSTALL PROMPT (ADD TO HOME SCREEN) ──────────────────────────────────

let deferredInstallPrompt = null;

export function initInstallPrompt() {
    // Jangan tampilkan di admin panel
    if (window.location.pathname.startsWith('/admin')) return;

    // Jangan tampilkan jika user sudah dismiss atau sudah install
    if (localStorage.getItem('pwaInstallDismissed') === '1') return;

    // Tangkap event beforeinstallprompt dari browser
    window.addEventListener('beforeinstallprompt', (event) => {
        event.preventDefault();
        deferredInstallPrompt = event;

        // Tampilkan banner install setelah 3 detik (agar tidak mengganggu)
        setTimeout(() => {
            showInstallBanner();
        }, 3000);
    });

    // Deteksi apakah sudah diinstall
    window.addEventListener('appinstalled', () => {
        deferredInstallPrompt = null;
        hideInstallBanner();
        localStorage.setItem('pwaInstallDismissed', '1');
        console.info('[PWA] Aplikasi berhasil diinstall.');
    });
}

function showInstallBanner() {
    // Jangan tampilkan jika sudah ada banner
    if (document.getElementById('pwaInstallBanner')) return;

    const banner = document.createElement('div');
    banner.id = 'pwaInstallBanner';
    banner.setAttribute('role', 'alert');
    banner.setAttribute('aria-live', 'polite');
    banner.style.cssText = `
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        z-index: 99999;
        width: calc(100% - 48px);
        max-width: 420px;
        background: #fff;
        border: 1.5px solid #d1fae5;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 4px 16px rgba(5,150,105,0.1);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        font-family: 'Open Sans', 'Montserrat', sans-serif;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s ease;
        opacity: 0;
    `;

    banner.innerHTML = `
        <div style="width:44px;height:44px;border-radius:12px;background:#ecfdf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" viewBox="0 0 256 256" fill="#059669">
                <path d="M240,102c0,70-103.79,126.66-108.21,129a8,8,0,0,1-7.58,0C119.79,228.66,16,172,16,102A62.07,62.07,0,0,1,78,40c20.65,0,38.73,8.88,50,23.89C139.27,48.88,157.35,40,178,40A62.07,62.07,0,0,1,240,102Z"/>
            </svg>
        </div>
        <div style="flex:1;min-width:0;">
            <p style="margin:0 0 2px;font-size:13px;font-weight:800;color:#0f172a;line-height:1.3;">Install Aplikasi Fundunity</p>
            <p style="margin:0;font-size:11px;color:#64748b;line-height:1.4;">Akses cepat & bisa digunakan saat offline</p>
        </div>
        <div style="display:flex;flex-direction:column;gap:6px;flex-shrink:0;">
            <button id="pwaInstallBtn" style="padding:7px 14px;background:#059669;color:#fff;border:none;border-radius:10px;font-size:11px;font-weight:700;cursor:pointer;white-space:nowrap;transition:background 0.2s;">
                Install
            </button>
            <button id="pwaInstallDismiss" style="padding:4px 14px;background:transparent;color:#94a3b8;border:none;border-radius:10px;font-size:10px;font-weight:600;cursor:pointer;white-space:nowrap;">
                Nanti
            </button>
        </div>
    `;

    document.body.appendChild(banner);

    // Animate in
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            banner.style.transform = 'translateX(-50%) translateY(0)';
            banner.style.opacity = '1';
        });
    });

    // Event: Install
    document.getElementById('pwaInstallBtn')?.addEventListener('click', async () => {
        if (!deferredInstallPrompt) return;
        deferredInstallPrompt.prompt();
        const { outcome } = await deferredInstallPrompt.userChoice;
        if (outcome === 'accepted') {
            console.info('[PWA] User menerima install prompt.');
        } else {
            localStorage.setItem('pwaInstallDismissed', '1');
        }
        deferredInstallPrompt = null;
        hideInstallBanner();
    });

    // Event: Dismiss
    document.getElementById('pwaInstallDismiss')?.addEventListener('click', () => {
        localStorage.setItem('pwaInstallDismissed', '1');
        hideInstallBanner();
    });
}

function hideInstallBanner() {
    const banner = document.getElementById('pwaInstallBanner');
    if (!banner) return;
    banner.style.transform = 'translateX(-50%) translateY(120px)';
    banner.style.opacity = '0';
    setTimeout(() => banner.remove(), 400);
}

// ─── 3. UPDATE BANNER ────────────────────────────────────────────────────────

function showUpdateBanner() {
    if (document.getElementById('pwaUpdateBanner')) return;

    const banner = document.createElement('div');
    banner.id = 'pwaUpdateBanner';
    banner.style.cssText = `
        position: fixed;
        top: 16px;
        right: 16px;
        z-index: 99999;
        background: #0f172a;
        color: #fff;
        border-radius: 14px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: 'Open Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        animation: slideInRight 0.4s ease-out;
        max-width: 300px;
    `;

    banner.innerHTML = `
        <span style="flex:1">Versi terbaru tersedia!</span>
        <button onclick="window.location.reload()" style="padding:5px 12px;background:#059669;color:#fff;border:none;border-radius:8px;font-size:11px;font-weight:700;cursor:pointer;">
            Muat Ulang
        </button>
    `;

    document.body.appendChild(banner);
    setTimeout(() => banner.remove(), 15000);
}

// ─── 4. OFFLINE / ONLINE DETECTOR ────────────────────────────────────────────

export function initOfflineDetector() {
    // Jangan pasang di admin panel
    if (window.location.pathname.startsWith('/admin')) return;

    let offlineBanner = null;

    function showOfflineBanner() {
        if (offlineBanner) return;

        offlineBanner = document.createElement('div');
        offlineBanner.id = 'pwaOfflineBanner';
        offlineBanner.style.cssText = `
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 99998;
            background: #1e293b;
            color: #f8fafc;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Open Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
            animation: slideUp 0.3s ease-out;
        `;

        offlineBanner.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 256 256" fill="#f59e0b">
                <path d="M236.8,188.09,149.35,36.22a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM120,104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm8,88a12,12,0,1,1,12-12A12,12,0,0,1,128,192Z"/>
            </svg>
            <span>Anda sedang offline. Beberapa fitur mungkin tidak tersedia.</span>
        `;

        document.body.appendChild(offlineBanner);
    }

    function hideOfflineBanner() {
        if (offlineBanner) {
            offlineBanner.remove();
            offlineBanner = null;
        }
    }

    // Cek saat load
    if (!navigator.onLine) {
        showOfflineBanner();
    }

    window.addEventListener('offline', showOfflineBanner);
    window.addEventListener('online', () => {
        hideOfflineBanner();
        // Jika ada pending contact form submission, coba kirim ulang
        retrySavedContactForm();
    });
}

// ─── 5. BACKGROUND SYNC — FORM KONTAK ────────────────────────────────────────

const CONTACT_PENDING_KEY = 'pendingContactForm';

export function saveContactFormForSync(payload) {
    localStorage.setItem(CONTACT_PENDING_KEY, JSON.stringify({
        ...payload,
        savedAt: Date.now(),
    }));
}

async function retrySavedContactForm() {
    const raw = localStorage.getItem(CONTACT_PENDING_KEY);
    if (!raw) return;

    try {
        const payload = JSON.parse(raw);

        // Jangan coba kirim jika sudah lebih dari 24 jam
        if (Date.now() - payload.savedAt > 24 * 60 * 60 * 1000) {
            localStorage.removeItem(CONTACT_PENDING_KEY);
            return;
        }

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) return;

        const formData = new FormData();
        formData.append('name', payload.name || '');
        formData.append('email', payload.email || '');
        formData.append('message', payload.message || '');
        formData.append('_token', csrfMeta.getAttribute('content'));

        const response = await fetch(payload.action || '/contact', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            localStorage.removeItem(CONTACT_PENDING_KEY);
            console.info('[PWA] Pesan kontak tertunda berhasil dikirim.');
        }
    } catch (err) {
        console.warn('[PWA] Gagal mengirim pesan tertunda:', err);
    }
}

// ─── 6. INIT ALL ─────────────────────────────────────────────────────────────

export function initPWA() {
    registerServiceWorker();
    initInstallPrompt();
    initOfflineDetector();
}
