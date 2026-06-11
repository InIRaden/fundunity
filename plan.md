# Rencana Implementasi: Super Admin, Manajemen Akun & Keamanan

Berdasarkan diskusi kita, berikut adalah pembaruan *Implementation Plan* yang memasukkan penggunaan Google reCAPTCHA, strategi *deployment* Railway yang efisien, beserta Skenario Pengujian (Testing Scenarios) secara mendetail.

## 1. Keamanan Autentikasi (Google reCAPTCHA)
Alih-alih menggunakan *Math Captcha*, kita akan menggunakan **Google reCAPTCHA v2 (Checkbox)** menggunakan kredensial pengujian (*dummy*) resmi dari Google.

- **Kredensial Dummy Google (Anti-Error di Lokal/Production):**
  - `NOCAPTCHA_SITEKEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI`
  - `NOCAPTCHA_SECRET=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe`
- **Penerapan Teknis:**
  - Membuat *Custom Validation Rule* di Laravel (`RecaptchaRule.php`) yang akan menembak API Google (`https://www.google.com/recaptcha/api/siteverify`) untuk mengecek validitas token tanpa perlu menginstal *library/package* pihak ketiga yang rawan *error* di Laravel 12.
  - Memasang *widget* reCAPTCHA di halaman `/login` dan form di `/forgot-password`.
  - Jika *toggle* Lupa Sandi dinonaktifkan di *Dashboard Admin*, form Lupa Sandi tidak bisa diakses sama sekali.

---

## 2. Struktur Database & Manajemen Akun

### Tabel & Seeder
- Menambahkan kolom `role` (enum/string) dan `must_change_password` (boolean) di tabel `users`.
- Menghapus semua *routes* & *controllers* terkait `/register`.
- Membuat `SuperAdminSeeder` yang mengambil data dari `.env`.

### Alur Fitur (Manajemen Admin & Force Change Password)
1. **Tambah Admin**: Super Admin membuka panel "Manajemen Admin" -> Input Nama & Email.
2. **Auto-Generate**: Sistem membuat sandi acak. Calon admin otomatis tersimpan dengan `must_change_password = true`.
3. **Pop-up Kredensial**: Muncul sebuah *modal* berisi teks Email & Sandi yang dilengkapi tombol "Copy" agar Super Admin bisa mengirimkannya via WhatsApp.
4. **Reset Sementara**: Jika *pop-up* terlanjur tertutup, Super Admin bisa menekan "Reset Sandi" di tabel. Sistem membuat sandi acak baru dan memunculkan *pop-up* kembali.
5. **Login Pertama (Force Change)**: Admin baru *login*. *Middleware* `ForceChangePassword` mendeteksi status mereka. Mereka diblokir dari semua akses *dashboard* dan dialihkan paksa ke `/admin/force-change-password`.
6. **Kunci Otomatis**: Setelah Admin tersebut mengganti sandi barunya, status `must_change_password` berubah menjadi `false`. Tombol "Reset Sandi" di panel Super Admin otomatis hilang/terkunci secara permanen.

---

## 3. Strategi Pembaruan Railway (Easy Update Workflow)
Mengingat aplikasi sudah terlanjur di-*hosting* di Railway, kita harus memastikan setiap pembaruan (*push* kode) dapat berjalan otomatis tanpa harus melakukan konfigurasi manual berulang.

**Analisis & Solusi untuk Railway:**
Railway menggunakan *Nixpacks* secara *default* untuk membangun aplikasi PHP/Laravel. Agar sinkronisasi *database* (migrasi & seeder) dan konfigurasi berjalan mulus setelah Anda menekan tombol *Deploy*:

1. **Konfigurasi Variabel di Railway**:
   Anda hanya perlu sekali saja menambahkan variabel berikut di tab *Variables* Railway Anda:
   
   *Variabel Super Admin:*
   - `SUPER_ADMIN_EMAIL=super@fundunity.id`
   - `SUPER_ADMIN_PASSWORD=fundunity@super123`
   
   *Variabel Google reCAPTCHA:*
   - `NOCAPTCHA_SITEKEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI`
   - `NOCAPTCHA_SECRET=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe`

   *Variabel Email (Untuk Fitur Lupa Sandi)*:
   - `MAIL_MAILER=smtp`
   - `MAIL_HOST=smtp.gmail.com`
   - `MAIL_PORT=465`
   - `MAIL_USERNAME=fundunitytesting@gmail.com`
   - `MAIL_PASSWORD="qbxm gftu zhgy bmoi"`
   - `MAIL_ENCRYPTION=tls`
   - `MAIL_FROM_ADDRESS=fundunitytesting@gmail.com`
   - `MAIL_FROM_NAME="FundUnity"`
2. **Start Command Kustom**:
   Di tab *Settings* -> *Service* -> *Start Command* di Railway, kita bisa mengatur perintah gabungan agar migrasi selalu dicek saat web di-*restart*:
   ```bash
   php artisan config:cache && php artisan route:cache && php artisan migrate --force && php artisan db:seed --class=SuperAdminSeeder --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
   *Dengan perintah ini, setiap kali Anda mem-push kode revisi terbaru dari lokal ke GitHub (yang terhubung ke Railway), Railway akan otomatis me-restart web, menanam struktur database baru (migrate), memastikan akun Super Admin eksis (seeder), dan menjalankan aplikasinya secara mandiri tanpa campur tangan Anda.*

---

## 4. Skenario Pengujian (Testing Scenarios)

Berikut adalah daftar uji coba (*checklist*) yang akan kita lakukan setelah fitur selesai dibuat:

### A. Skenario Keamanan Pendaftaran
- `[ ]` **Test A1:** Buka `http://127.0.0.1:8000/register`. Hasil yang diharapkan: Muncul *Error 404* atau dikembalikan ke halaman *Login*.
- `[ ]` **Test A2:** Di halaman Login, jangan centang Captcha. Tekan *Login*. Hasil yang diharapkan: Ditolak dengan pesan "Tolong verifikasi bahwa Anda bukan robot".

### B. Skenario *Super Admin* & Manajemen
- `[ ]` **Test B1:** Jalankan `php artisan db:seed --class=SuperAdminSeeder`. Pastikan data masuk ke *database* dan bisa *login*.
- `[ ]` **Test B2:** Login sebagai Super Admin, buka menu Manajemen Admin. Buat satu akun Admin baru (Misal: admin1@test.com).
- `[ ]` **Test B3:** Pastikan *Pop-up Modal* muncul, dan tombol "Copy" berfungsi dengan baik menyalin sandi acak.
- `[ ]` **Test B4:** Tutup *pop-up*, tekan tombol "Reset Sandi Sementara" pada tabel untuk Admin tersebut. Pastikan *pop-up* muncul lagi dengan kata sandi acak yang **berbeda** dari yang pertama.

### C. Skenario *Force Change Password*
- `[ ]` **Test C1:** *Logout* dari Super Admin, lalu *Login* menggunakan akun Admin baru (admin1@test.com) beserta kata sandi hasil *copy* tadi. Pastikan Captcha dicentang.
- `[ ]` **Test C2:** Saat berhasil masuk, cobalah secara paksa mengakses `http://127.0.0.1:8000/admin/settings` lewat *URL bar*. Hasil yang diharapkan: Secara paksa dialihkan kembali ke halaman `/admin/force-change-password`.
- `[ ]` **Test C3:** Ganti kata sandi. Masukkan konfirmasi yang salah. Hasil yang diharapkan: Gagal disimpan dengan notifikasi error.
- `[ ]` **Test C4:** Masukkan kata sandi dan konfirmasi yang benar, lalu Simpan. Hasil yang diharapkan: Dialihkan ke Dashboard Utama Admin.

### D. Skenario Kunci Privasi Kredensial
- `[ ]` **Test D1:** Setelah Admin (admin1@test.com) berhasil mengganti sandinya secara mandiri, *Logout*.
- `[ ]` **Test D2:** *Login* kembali sebagai **Super Admin**. Buka halaman Manajemen Admin.
- `[ ]` **Test D3:** Cek tabel pada baris Admin (admin1@test.com). Hasil yang diharapkan: Tombol "Reset Sandi" **TIDAK ADA / TERKUNCI**, membuktikan bahwa Super Admin tidak bisa lagi mengubah sandi admin yang sudah aktif.

---

---

# Rencana Implementasi: Progressive Web App (PWA) — Fundunity

## Analisis Website: Inputan & Mekanisme yang Ada

### 📋 Form Input (Public / Landing)

| Halaman | Form | Field Input | Mekanisme |
|---|---|---|---|
| **Home** (`/`) | Form Kontak (inline) | Nama, Email, Pesan | `POST /contact` → throttle 5x/menit |
| **Contact** (`/contact`) | Form Kontak (dedicated) | Nama, Email, Pesan | `POST /contact` → throttle 5x/menit |
| **Donation** (`/donasi`) | Form Donasi 3-langkah | Nominal (preset/manual), Nama, Email/WA, Catatan Doa, Checkbox Anonim | `POST /donasi` → throttle 5x/menit. State disimpan sementara di `localStorage` (pending donation dengan countdown 15 menit). Pembayaran via QRIS. |
| **Get Involved** (`/get-involved`) | Form Pendaftaran Relawan | Nama Lengkap, Email, No. WhatsApp, Bidang Kolaborasi (select dari DB), Pesan Tambahan | `POST /get-involved` → throttle 5x/menit |
| **Newsletter** (Footer) | Subscribe | Email | `POST /newsletter/subscribe` |
| **Login** (`/login`) | Login Admin | Email, Password, Google reCAPTCHA v2 | `POST /login` + validasi CAPTCHA |
| **Forgot Password** | Reset Password | Email | `POST /forgot-password` |
| **Force Change Password** | Ganti Sandi Paksa | Password Baru, Konfirmasi | Admin baru wajib ganti sandi |

### 🛡️ Form Input (Admin Panel — Authenticated)

| Modul Admin | Aksi | Mekanisme |
|---|---|---|
| **Settings > Profil** | Upload foto, ganti nama & email | `POST /admin/settings/profile` (multipart) |
| **Settings > Identitas** | Upload logo, isi nama org, tagline, hero, footer | `POST /admin/settings/identity` (multipart) |
| **Settings > QRIS** | Upload gambar QRIS | `POST /admin/settings/payment` (multipart) |
| **Settings > SEO** | Meta description, toggle maintenance | `POST /admin/settings/seo` (JSON via fetch) |
| **Settings > Keamanan** | Ganti password | `POST /admin/settings/security` (JSON via fetch) |
| **Settings > Menu** | Toggle menu sidebar & landing, pilih tema warna | `POST /admin/settings/menu` (JSON via fetch) |
| **Campaign** | CRUD kampanye + tambah update | `POST/PUT/DELETE /admin/campaign` |
| **Gallery** | CRUD galeri | `POST/PUT/DELETE /admin/gallery` |
| **Members** | CRUD anggota tim | `POST/PUT/DELETE /admin/members` |
| **Focus Areas** | CRUD pilar fokus | `POST/PUT/DELETE /admin/focus-areas` |
| **FAQs** | CRUD FAQ | `POST/PUT/DELETE /admin/faqs` |
| **Partners** | CRUD mitra | `POST/PUT/DELETE /admin/partners` |
| **Image Slider** | CRUD banner slider | `POST/PUT/DELETE /admin/image-slider` |
| **Messages** | CRUD pesan masuk (dari form kontak) | `POST/PUT/DELETE /admin/messages` |
| **Stakeholder DB** | CRUD data stakeholder | `POST/PUT/DELETE /admin/database-stakeholder/{type}` |
| **Keuangan** | Kelola transparansi keuangan | Panel dedicated |
| **Admin Management** | Tambah/hapus/reset-password admin | `POST/DELETE /admin/management` (Super Admin only) |

### ⚙️ Mekanisme Teknis yang Sudah Ada
- **Splash Screen** sudah diimplementasikan di `layouts/landing.blade.php` (overlay putih saat load)
- **localStorage** digunakan untuk menyimpan state donasi tertunda (pending donation)
- **sidebar state** tersimpan di localStorage (`sidebarState: collapsed/expanded`)
- **Throttling** di form publik (5 request per 1 menit)
- **Vite** sebagai bundler asset (CSS + JS)
- **TailwindCSS** untuk styling

---

## Rencana Implementasi PWA

### Pendekatan Teknis

Karena project menggunakan **Laravel + Vite**, pendekatan terbaik adalah:
1. Plugin **`vite-plugin-pwa`** untuk auto-generate Service Worker dan Web Manifest dari Vite.
2. Manifest yang **dinamis** — nama app dan logo diambil dari `siteSettings` (database), digenerate otomatis via route Laravel.
3. Caching strategy yang **selektif** — bukan semua halaman di-cache, hanya asset statis dan halaman read-only landing.

---

## Optimalisasi PWA yang Akan Diimplementasikan

### 1. 📄 Web App Manifest (Installability)
Agar website bisa **diinstall** layaknya aplikasi native di HP/Desktop.

**File baru:** `public/manifest.json` (atau route dinamis `/manifest.json`)

```json
{
  "name": "[Nama Org dari siteSettings]",
  "short_name": "[shortName dari siteSettings]",
  "description": "Platform donasi transparan dan terukur",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#059669",
  "icons": [
    { "src": "/images/icon-192.png", "sizes": "192x192", "type": "image/png" },
    { "src": "/images/icon-512.png", "sizes": "512x512", "type": "image/png", "purpose": "maskable" }
  ]
}
```

**Strategi:** Buat route Laravel `GET /manifest.json` yang mengembalikan JSON dinamis berdasarkan `siteSettings` dari database.

---

### 2. ⚙️ Service Worker (Offline & Performance)
Service Worker mendukung **offline-first** dan **background caching**.

**Strategi caching yang direncanakan:**

| Jenis Konten | Strategi Cache | Alasan |
|---|---|---|
| CSS & JS (Vite build assets `/build/*`) | **CacheFirst** (1 tahun) | Hash-based, tidak pernah berubah |
| Google Fonts / CDN Icons | **StaleWhileRevalidate** | Fallback jika offline |
| Halaman Landing (HTML) | **NetworkFirst** | Konten sering berubah; fallback ke cache |
| Gambar (`/images/*`, `/storage/*`) | **StaleWhileRevalidate** (max 100 items) | Hemat bandwidth, tetap tampil offline |
| API data & form POST | **NetworkOnly** | Tidak boleh di-cache (data sensitif) |
| Halaman Admin (`/admin/*`) | **NetworkOnly** | Panel admin harus selalu live |
| Halaman auth (`/login`, `/register`) | **NetworkOnly** | Keamanan session |

**Offline Fallback Page:** Halaman `/offline` khusus yang tampil ketika user offline dan mengakses konten yang belum ter-cache.

---

### 3. 📲 Add to Home Screen (Install Prompt)
Banner/prompt install yang muncul secara halus di landing page.

- Mendeteksi event `beforeinstallprompt` dari browser
- Menampilkan banner install kustom yang sesuai dengan design Fundunity (hijau emerald)
- Menyimpan state apakah user sudah dismiss/install (`localStorage: pwaInstallDismissed`)
- Banner tidak muncul lagi jika sudah di-dismiss atau sudah diinstall

---

### 4. 🎨 Meta Tags & Theme Color
Agar tampilan di browser mobile lebih terintegrasi.

**Di `layouts/landing.blade.php` & `layouts/admin/app.blade.php`:**
```html
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#059669">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="[site_name]">
<link rel="apple-touch-icon" href="/images/icon-192.png">
```

---

### 5. 📡 Background Sync (Donasi & Form Kontak)
Untuk mendukung **pengiriman form saat koneksi kembali** setelah offline.

Karena form donasi sudah menggunakan `localStorage` untuk pending state, kita dapat memperluas mekanisme ini:

- **Form Kontak:** Jika submit gagal karena offline, simpan payload ke `localStorage` → tampilkan notifikasi "Pesan disimpan, akan dikirim saat online" → saat online kembali, submit otomatis via Background Sync API
- **Donasi:** Sudah ada pending mechanism; cukup tambahkan deteksi offline agar user tidak bingung

---

### 6. 🖼️ Lazy Loading & Image Optimization (Performance)
Optimasi performa yang mendukung PWA score tinggi di Lighthouse.

- Semua `<img>` di landing page sudah memiliki `loading="lazy"` dan `decoding="async"` ✅
- Tambahkan **`width` dan `height`** attributes di semua gambar untuk mencegah Cumulative Layout Shift (CLS)
- Konversi ikon partner & gallery ke format **WebP** jika memungkinkan

---

### 7. 🔔 Push Notification (Opsional — Fase 2)
Notifikasi browser ketika ada campaign baru atau batas donasi mendekat.

> ⚠️ **Catatan:** Fitur ini memerlukan infrastruktur tambahan (VAPID keys, server push) dan hanya bisa berjalan di HTTPS. Direncanakan sebagai **fase lanjutan** setelah MVP PWA selesai.

---

## Daftar File yang Akan Dibuat / Dimodifikasi

### File Baru

| File | Deskripsi |
|---|---|
| `public/manifest.json` atau `routes/web.php` (route dinamis) | Web App Manifest |
| `public/sw.js` (di-generate Vite) | Service Worker |
| `public/offline.html` | Halaman fallback saat offline |
| `public/images/icon-192.png` | PWA icon 192x192 |
| `public/images/icon-512.png` | PWA icon 512x512 (maskable) |
| `resources/js/pwa.js` | Script install prompt & SW registration |

### File yang Dimodifikasi

| File | Perubahan |
|---|---|
| `vite.config.js` | Tambah plugin `vite-plugin-pwa` dengan konfigurasi workbox |
| `package.json` | Tambah dependency `vite-plugin-pwa` |
| `resources/views/layouts/landing.blade.php` | Tambah `<link rel="manifest">`, meta tags, include `pwa.js` |
| `resources/views/layouts/admin/app.blade.php` | Tambah meta theme-color |
| `app/Http/Controllers/LandingController.php` | (opsional) route untuk manifest dinamis |

---

## Dependency yang Dibutuhkan

```bash
npm install -D vite-plugin-pwa
```

> **Tidak perlu** package Composer PHP tambahan. Semua PWA logic ada di sisi frontend (JS + Vite).

---

## Checklist Implementasi PWA

### A. Setup Dasar
- `[ ]` **A1:** Install `vite-plugin-pwa` via npm
- `[ ]` **A2:** Konfigurasi plugin di `vite.config.js` dengan workbox strategy
- `[ ]` **A3:** Buat ikon PWA 192px dan 512px (maskable) dari logo Fundunity
- `[ ]` **A4:** Buat route manifest dinamis di Laravel yang membaca `siteSettings`

### B. Service Worker & Caching
- `[ ]` **B1:** Verifikasi Service Worker terdaftar dengan benar di browser DevTools
- `[ ]` **B2:** Test strategi CacheFirst untuk `/build/*` assets
- `[ ]` **B3:** Test strategi NetworkFirst untuk halaman HTML landing
- `[ ]` **B4:** Test halaman offline fallback muncul saat koneksi putus

### C. Installability
- `[ ]` **C1:** Pastikan manifest.json valid (cek di DevTools > Application > Manifest)
- `[ ]` **C2:** Test install prompt muncul di Chrome Android dan desktop
- `[ ]` **C3:** Test app berjalan dalam mode standalone (tanpa address bar browser)
- `[ ]` **C4:** Verifikasi splash screen muncul saat launch dari homescreen

### D. Performance & Lighthouse
- `[ ]` **D1:** Jalankan Lighthouse PWA audit → target skor PWA: 90+
- `[ ]` **D2:** Pastikan tidak ada console error terkait SW atau manifest
- `[ ]` **D3:** Verifikasi CLS score tidak bertambah buruk setelah PWA ditambahkan

### E. Pengujian Offline
- `[ ]` **E1:** Buka landing page → matikan koneksi → refresh → halaman tetap tampil (dari cache)
- `[ ]` **E2:** Akses halaman yang belum pernah dibuka saat offline → muncul halaman `/offline`
- `[ ]` **E3:** Admin panel saat offline → NetworkOnly, browser error normal (tidak crash)
- `[ ]` **E4:** Submit form donasi/kontak saat offline → muncul notifikasi informatif ke user
