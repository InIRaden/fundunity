# Dokumentasi Project Fundunity

Dokumen ini dibuat untuk menjelaskan project Fundunity dengan bahasa yang lebih sederhana, supaya orang yang belum familiar dengan Laravel atau pengembangan web tetap bisa memahami isi project ini, fungsi tiap folder, dan alur kerjanya.

## 1. Gambaran Umum Project

Fundunity adalah aplikasi web berbasis Laravel yang dipakai untuk kebutuhan organisasi/komunitas. Dari struktur yang ada, project ini memiliki dua bagian besar:

1. Bagian publik, yaitu halaman yang bisa dilihat oleh semua pengunjung.
2. Bagian admin, yaitu halaman khusus untuk mengelola isi website seperti program, galeri, FAQ, partner, pesan masuk, dan data lain.

Secara sederhana, website ini berfungsi seperti etalase digital untuk menampilkan informasi organisasi sekaligus panel pengelolaan di belakang layar.

## 2. Teknologi yang Dipakai

Project ini dibangun dengan teknologi berikut:

- Laravel 12 sebagai kerangka utama backend.
- PHP 8.2 untuk menjalankan logic server.
- Blade template untuk tampilan halaman web.
- Tailwind CSS untuk styling dan pengaturan tampilan.
- Vite untuk proses build asset frontend.
- Laravel Breeze untuk fitur login, register, reset password, dan autentikasi dasar.

## 3. Cara Kerja Sederhana

Alur kerjanya kurang lebih seperti ini:

1. Pengunjung membuka website.
2. Browser meminta halaman ke Laravel lewat route yang ada di folder `routes/`.
3. Laravel mengarahkan request ke controller yang sesuai.
4. Controller mengambil data dari model atau database jika diperlukan.
5. Data diteruskan ke file view di `resources/views/` untuk ditampilkan ke pengguna.
6. Jika user login sebagai admin, ia bisa masuk ke halaman admin untuk mengubah isi website.

Jadi, singkatnya:

- Route = jalan masuk.
- Controller = pengatur logika.
- Model = penghubung ke database.
- View = tampilan yang dilihat pengguna.

## 4. Struktur Folder Utama

Berikut penjelasan folder yang paling penting di project ini.

### 4.1 `app/`

Folder ini berisi inti logika aplikasi.

#### `app/Http/Controllers/`
Berisi file pengendali halaman dan proses data.

- `LandingController.php` mengatur halaman publik seperti home, about, team, programs, focus areas, gallery, partners, contact, FAQ, donation, dan get involved.
- `LegalController.php` mengatur halaman kebijakan privasi dan syarat penggunaan.
- `Admin/` berisi controller untuk halaman admin, misalnya pengelolaan campaign, gallery, focus area, partner, FAQ, members, messages, settings, dan lain-lain.

#### `app/Models/`
Berisi model, yaitu representasi data dari database.

Beberapa model penting di project ini:

- `User.php` untuk data pengguna.
- `Campaign.php` untuk data kampanye donasi.
- `Program.php` untuk daftar program.
- `FocusArea.php` untuk bidang fokus kegiatan.
- `GalleryItem.php` untuk isi galeri.
- `Faq.php` untuk pertanyaan yang sering diajukan.
- `Partner.php` untuk data mitra.
- `TeamMember.php` untuk data tim.
- `Message.php` untuk pesan dari pengunjung.
- `SiteSetting.php` untuk pengaturan website.
- `AboutUsItem.php` untuk isi bagian tentang kami.
- `ImageSlider.php` untuk gambar slider/banner.
- `Donor.php`, `Beneficiary.php`, dan `Volunteer.php` untuk data pihak yang terlibat.
- `AdminActivityLog.php` untuk catatan aktivitas admin.

#### `app/Providers/`
Berisi file untuk mendaftarkan layanan atau konfigurasi aplikasi.

### 4.2 `bootstrap/`

Folder ini dipakai Laravel saat aplikasi mulai berjalan. Isinya mendukung proses booting aplikasi.

### 4.3 `config/`

Berisi konfigurasi aplikasi, misalnya:

- `app.php` untuk pengaturan umum aplikasi.
- `auth.php` untuk autentikasi.
- `database.php` untuk koneksi database.
- `mail.php` untuk email.
- `queue.php` untuk antrian proses.
- `session.php` untuk sesi login pengguna.
- `logging.php` untuk pencatatan log.

### 4.4 `database/`

Folder ini berisi semua hal yang berhubungan dengan database.

#### `database/migrations/`
Migrations adalah file yang menjelaskan struktur tabel database.

Contoh tabel penting di project ini:

- `users` untuk akun pengguna.
- `pages` untuk halaman konten.
- `site_settings` untuk pengaturan website.
- `mission_items` untuk item misi.
- `organization_values` untuk nilai-nilai organisasi.
- `programs` untuk program kegiatan.
- `partners` untuk data partner.
- `faqs` untuk FAQ.
- `gallery_items` untuk galeri.
- `focus_areas` untuk area fokus.
- `impact_stats` untuk statistik dampak.
- `team_members` untuk anggota tim.
- `newsletter_subscribers` untuk langganan newsletter.
- `involvement_types` dan `involvement_benefits` untuk kebutuhan halaman keterlibatan.
- `campaigns`, `donors`, `beneficiaries`, dan `volunteers` untuk fitur donasi dan relasi terkait.
- `messages` untuk pesan masuk.
- `about_us_items` untuk konten tentang kami.
- `image_sliders` untuk slider homepage.
- `admin_activity_logs` untuk log aktivitas admin.

#### `database/seeders/`
Seeder adalah file yang mengisi data awal ke database.

File yang ada di project ini antara lain:

- `DatabaseSeeder.php` sebagai seeder utama.
- `ProgramSeeder.php` untuk data program awal.
- `FocusAreaSeeder.php` untuk data focus area awal.
- `GalleryItemSeeder.php` untuk data galeri awal.
- `LandingContentSeeder.php` untuk isi awal halaman landing.

#### `database/factories/`
Berisi pabrik data dummy untuk keperluan testing atau pengisian data otomatis.

### 4.5 `public/`

Folder ini adalah pintu masuk yang bisa diakses browser.

- `index.php` adalah file utama yang dijalankan server.
- `storage/` biasanya berisi akses ke file upload yang dipublikasikan.
- `images/` berisi asset gambar statis.

### 4.6 `resources/`

Folder ini berisi file tampilan dan asset frontend.

#### `resources/views/`
Semua halaman Blade ada di sini.

Subfolder penting di dalamnya:

- `landing/` untuk halaman publik.
- `admin/` untuk halaman admin.
- `auth/` untuk halaman login dan registrasi.
- `layouts/` untuk template dasar halaman.
- `components/` untuk komponen kecil yang dipakai ulang.
- `profile/` untuk pengaturan profil user.

#### `resources/css/`
Berisi file CSS utama.

#### `resources/js/`
Berisi file JavaScript utama untuk interaksi frontend.

### 4.7 `routes/`

Folder ini mengatur alamat URL di website.

- `web.php` berisi route utama untuk halaman publik dan admin.
- `auth.php` berisi route autentikasi seperti login dan register.
- `api.php` dipakai untuk endpoint API jika dibutuhkan.

### 4.8 `storage/`

Folder ini dipakai untuk menyimpan file hasil upload, cache, log, dan file sementara dari Laravel.

### 4.9 `tests/`

Folder untuk pengujian aplikasi agar perubahan kode tidak merusak fitur yang sudah ada.

### 4.10 `vendor/`

Folder ini berisi library pihak ketiga yang dipasang lewat Composer. Folder ini biasanya dibuat otomatis dan tidak ditulis manual.

## 5. Daftar Halaman Utama Website

Bagian publik dari project ini memiliki beberapa halaman utama.

- `/` halaman utama.
- `/about` halaman tentang organisasi.
- `/team` halaman tim.
- `/allprograms` daftar program.
- `/focusareas` daftar area fokus.
- `/moregallery` galeri tambahan.
- `/partners` halaman partner.
- `/contact` halaman kontak.
- `/faqs` halaman FAQ.
- `/getinvolved` halaman ajakan untuk ikut terlibat.
- `/donasi/{campaign?}` halaman donasi.
- `/privacy` halaman kebijakan privasi.
- `/terms` halaman syarat dan ketentuan.

Bagian admin berada di bawah prefix `/admin` dan dipakai untuk mengelola isi website.

## 6. Penjelasan Route dan Logika

File paling penting untuk memahami alur website adalah `routes/web.php`.

Di sana Laravel menentukan bahwa:

- URL `/` mengarah ke `LandingController@index`.
- URL `/about` mengarah ke halaman about.
- URL `/allprograms` menampilkan daftar program.
- URL `/focusareas` menampilkan area fokus.
- URL `/moregallery` menampilkan galeri.
- URL `/contact` dan `/getinvolved` punya proses submit form melalui method `POST`.
- URL admin membutuhkan login terlebih dahulu.

Artinya, file route ini seperti peta besar yang menghubungkan alamat halaman dengan proses yang mengerjakannya.

## 7. Folder `uifix_fundunity/`

Di dalam workspace juga ada folder `uifix_fundunity/`.

Folder ini terlihat seperti project frontend terpisah yang digunakan untuk pekerjaan UI atau eksperimen tampilan. Di dalamnya ada:

- `src/` untuk kode frontend.
- `public/` untuk asset statis.
- `index.html` sebagai entry point Vite.
- `vite.config.ts` untuk konfigurasi build.
- `tailwind.config.js` untuk styling.
- `package.json` untuk dependensi frontend.

Kalau dijelaskan sederhana, folder ini adalah area kerja frontend yang lebih mandiri, sedangkan folder utama `fundunity/` adalah aplikasi Laravel utamanya.

## 8. Komponen Tampilan yang Sering Dipakai

Beberapa komponen yang sering dipakai ulang ada di `resources/views/components/`.

Contohnya:

- `components/landing/navbar.blade.php` untuk navbar halaman publik.
- `components/landing/footer.blade.php` untuk footer.
- `components/landing/cta.blade.php` untuk tombol ajakan bertindak.
- `components/icons/` untuk kumpulan ikon kecil.
- `components/admin-modals.blade.php` untuk modal admin.

Komponen dipakai agar tampilan tetap konsisten dan tidak perlu menulis ulang elemen yang sama di banyak halaman.

## 9. Struktur Admin Secara Umum

Halaman admin di project ini dipakai untuk mengelola isi website tanpa harus mengubah kode.

Beberapa area yang dikelola admin:

- Campaign.
- Focus areas.
- Gallery.
- FAQ.
- Partners.
- Messages.
- Team members.
- About us content.
- Image sliders.
- Site settings.
- Legal pages.
- Database stakeholder.
- Keuangan transparansi.

Jadi kalau ada konten website yang ingin diubah, biasanya admin melakukan perubahan dari sini.

## 10. File Penting Lainnya

Berikut beberapa file yang juga penting dipahami:

- `composer.json` untuk dependency backend PHP/Laravel.
- `package.json` untuk dependency frontend seperti Vite dan Tailwind.
- `vite.config.js` untuk proses build asset.
- `tailwind.config.js` untuk pengaturan desain Tailwind.
- `phpunit.xml` untuk konfigurasi testing.
- `README.md` untuk pengantar dasar project.

## 11. Cara Project Ini Dijalankan

Secara umum, langkah menjalankan project Laravel ini adalah:

1. Install dependency PHP dengan Composer.
2. Install dependency frontend dengan npm.
3. Siapkan file `.env`.
4. Jalankan migration untuk membuat tabel database.
5. Jalankan server Laravel dan Vite jika sedang development.

Di `composer.json` juga sudah ada script bantu seperti:

- `composer run dev` untuk menjalankan server, queue, dan Vite secara bersamaan.
- `composer run test` untuk menjalankan test.

## 12. Ringkasan Mudah Dipahami

Kalau dijelaskan sesingkat mungkin, project Fundunity ini adalah:

- Website organisasi berbasis Laravel.
- Memiliki halaman publik untuk pengunjung umum.
- Memiliki panel admin untuk mengelola isi website.
- Menyimpan data di database dan menampilkannya lewat halaman Blade.
- Dipisahkan rapi antara route, controller, model, view, migrasi, dan seeder.

## 13. Kesimpulan

Struktur project ini sudah dibagi dengan cara yang cukup standar untuk aplikasi Laravel. Itu membuat project lebih mudah dirawat, lebih mudah dikembangkan, dan lebih gampang dipahami oleh orang baru setelah mereka tahu fungsi tiap folder.

Kalau seseorang hanya ingin memahami alurnya tanpa masuk ke kode, urutan paling gampang adalah:

1. Lihat `routes/web.php` untuk memahami alamat halaman.
2. Lihat controller di `app/Http/Controllers/` untuk memahami logika.
3. Lihat model di `app/Models/` untuk memahami data.
4. Lihat view di `resources/views/` untuk memahami tampilan.
5. Lihat migration dan seeder di `database/` untuk memahami database.

Dokumen ini bisa dijadikan panduan awal untuk orang awam yang ingin mengenal project Fundunity.
