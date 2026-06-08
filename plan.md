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
