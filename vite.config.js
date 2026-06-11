import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePWA({
            // Strategy: injectManifest → kita buat sw.js sendiri agar lebih kontrol
            // Strategy: generateSW → Workbox auto-generate, lebih simpel
            strategies: 'generateSW',
            registerType: 'autoUpdate',
            injectRegister: false, // kita daftarkan manual di pwa.js
            includeAssets: [
                'favicon.ico',
                'images/icon-192.png',
                'images/icon-512.png',
                'images/Logo.png',
            ],
            manifest: false, // manifest dihandle oleh Laravel route (/manifest.json)
            workbox: {
                // Prekache semua Vite build assets (CSS, JS yang hashed)
                globPatterns: ['**/*.{js,css,html,ico,png,svg,webp,woff,woff2}'],
                globDirectory: 'public/build',
                swDest: 'public/sw.js',

                // Tidak gunakan navigation preload agar lebih aman di Laravel
                navigationPreload: false,

                // Routing rules (Runtime Caching)
                runtimeCaching: [
                    // 1. Vite build assets — CacheFirst (1 tahun, hash-based)
                    {
                        urlPattern: /\/build\/assets\/.*/i,
                        handler: 'CacheFirst',
                        options: {
                            cacheName: 'vite-assets-cache',
                            expiration: {
                                maxEntries: 100,
                                maxAgeSeconds: 365 * 24 * 60 * 60, // 1 tahun
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },

                    // 2. Google Fonts & CDN icons — StaleWhileRevalidate
                    {
                        urlPattern: /^https:\/\/fonts\.bunny\.net\/.*/i,
                        handler: 'StaleWhileRevalidate',
                        options: {
                            cacheName: 'google-fonts-cache',
                            expiration: {
                                maxEntries: 20,
                                maxAgeSeconds: 30 * 24 * 60 * 60, // 30 hari
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },
                    {
                        urlPattern: /^https:\/\/cdn\.jsdelivr\.net\/.*/i,
                        handler: 'StaleWhileRevalidate',
                        options: {
                            cacheName: 'cdn-icons-cache',
                            expiration: {
                                maxEntries: 10,
                                maxAgeSeconds: 7 * 24 * 60 * 60, // 7 hari
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },

                    // 3. Gambar lokal — StaleWhileRevalidate
                    {
                        urlPattern: /\/(images|storage)\/.+\.(png|jpg|jpeg|svg|gif|webp)$/i,
                        handler: 'StaleWhileRevalidate',
                        options: {
                            cacheName: 'images-cache',
                            expiration: {
                                maxEntries: 100,
                                maxAgeSeconds: 7 * 24 * 60 * 60, // 7 hari
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },

                    // 4. Halaman landing — NetworkFirst dengan fallback offline
                    {
                        urlPattern: ({ request, url }) => {
                            // Hanya GET request ke halaman landing (bukan admin, bukan API)
                            const isAdmin = url.pathname.startsWith('/admin');
                            const isAuth = url.pathname.startsWith('/login') ||
                                           url.pathname.startsWith('/register') ||
                                           url.pathname.startsWith('/forgot-password') ||
                                           url.pathname.startsWith('/reset-password');
                            const isApi = url.pathname.startsWith('/api');
                            const isManifest = url.pathname === '/manifest.json';
                            const isNavigation = request.mode === 'navigate';

                            return isNavigation && !isAdmin && !isAuth && !isApi && !isManifest;
                        },
                        handler: 'NetworkFirst',
                        options: {
                            cacheName: 'landing-pages-cache',
                            networkTimeoutSeconds: 5,
                            expiration: {
                                maxEntries: 20,
                                maxAgeSeconds: 24 * 60 * 60, // 1 hari
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },
                ],

                // Halaman fallback jika offline dan konten tidak ter-cache
                offlineGoogleAnalytics: false,

                // Skip waiting agar SW langsung aktif setelah install
                skipWaiting: true,
                clientsClaim: true,
            },
        }),
    ],
});
