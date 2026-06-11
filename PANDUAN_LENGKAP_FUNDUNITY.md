# 📚 MASTER DOKUMEN: Referensi Lengkap Sistem Fundunity

> [!NOTE]
> **Dokumen Induk (Master Document)** ini merangkum seluruh aspek dari platform Fundunity. Di dalamnya terdapat Alur Global, Detail Alur untuk SEMUA Modul Admin, **Penjelasan Teknis Lengkap**, serta ditutup dengan **Script Video Tutorial / Manual Book** (Bab 6) untuk panduan operasional.

---

## 1. 📖 Gambaran Umum Platform (Apa Itu Fundunity?)

**Fundunity (Komunitas Ruang Berbagi)** adalah aplikasi web yang menjembatani donatur, relawan, dan institusi dengan masyarakat yang membutuhkan bantuan. 

Sistem ini memiliki dua peran utama:
1. **Sisi User / Publik:** Berfokus pada visual yang menarik, transparan, dan persuasif agar masyarakat tergerak menyumbang atau menjadi relawan.
2. **Sisi Admin / CMS:** Panel kontrol pengurus untuk mengubah gambar, teks, dan laporan donasi secara instan (real-time) tanpa *coding*.

---

## 2. 🧑 Alur Pengguna: Bagaimana Masyarakat Menggunakan Website Ini?

```mermaid
graph TD
    U["🧑 Pengunjung / Masyarakat"] --> Home["1. Tiba di Beranda (Homepage)"]
    
    Home --> Explore{"Navigasi Eksplorasi"}
    
    Explore -->|"Validasi Kepercayaan"| About["2. Buka Halaman Tentang Kami"]
    About --> Visi["Melihat Tim Pengurus, Sejarah, dan Visi"]
    
    Explore -->|"Melihat Bukti Nyata"| Program["3. Buka Program dan Area Fokus"]
    Program --> Dampak["Membaca Rincian Kegiatan dan Statistik Dampak"]
    
    Explore -->|"Pengambilan Keputusan"| Action["4. Klik Tombol Get Involved"]
    Action --> PilihForm{"Pilih Cara Berkontribusi"}
    PilihForm -->|"Donasi Uang"| Donasi["Formulir Donasi dan Pembayaran"]
    PilihForm -->|"Donasi Tenaga"| Relawan["Formulir Pendaftaran Relawan"]
    PilihForm -->|"Kerja Sama B2B"| Mitra["Formulir Kemitraan Instansi"]
```

---

## 3. 👨‍💼 Alur Administrator Utama (Admin Global Flow)

Berikut adalah ringkasan gambaran besar panel admin secara keseluruhan. (Detail setiap cabangnya dibedah di Bab 4).

```mermaid
graph TD
    A["👨‍💼 Admin / Super Admin"] --> B["Akses /admin dan Login"]
    
    B --> C["Dashboard Utama CMS"]
    
    C --> F["1. Konfigurasi Sistem (Settings, Legal)"]
    C --> G["2. Modul Kampanye (Program Bantuan)"]
    C --> H["3. Data Publik (Keuangan, Donatur, Pesan)"]
    C --> I["4. Profil Organisasi (Tentang Kami, Tim)"]
    C --> J["5. Media dan PR (Banner, Galeri, Mitra)"]
    
    F --> Z["Simpan Perubahan Data"]
    G --> Z
    H --> Z
    I --> Z
    J --> Z
    
    Z --> Final["Sistem Hapus Cache dan Tampil di Publik"]
```

---

## 4. 🔍 DETAIL ALUR SEMUA MODUL ADMIN

### A. Alur Modul Keuangan dan Transparansi
Di sini admin membuktikan ke publik ke mana uang donasi disalurkan.

```mermaid
graph TD
    A["Buka Menu 'Keuangan dan Transparansi'"] --> B{"Sistem Menampilkan 2 Tab Utama"}
    
    %% Tab Pemasukan
    B -->|"Tab 1: Pemasukan"| C["Data Donasi Masuk"]
    C --> C1["Klik Tombol 'Input Manual'"]
    C1 --> C2["Masukkan Nama Donatur, Nominal Tunai, dan Target Program"]
    C2 --> C3["Simpan -> Total Saldo Sistem Langsung Bertambah"]
    
    %% Tab Penyaluran
    B -->|"Tab 2: Penyaluran"| D["Laporan Penyaluran (Transparansi)"]
    D --> D1["Klik Tombol 'Detail' pada suatu Program yang Berjalan"]
    
    D1 --> D3{"Modal Detail Terbuka"}
    D3 -->|"Tab: Dokumentasi Publik"| D6["Klik Form Posting Laporan Penyaluran Baru"]
    D6 --> D7["Isi Judul, Cerita, Foto Bukti, dan NOMINAL DISALURKAN"]
    D7 --> D8["Publikasikan Laporan"]
    
    D8 --> Z["Sistem Mencatat Pengeluaran -> Angka Sisa Dana Berkurang -> Laporan Langsung Tampil di Web Publik"]
```

### B. Alur Konfigurasi Identitas Website (Settings & Legal)

```mermaid
graph TD
    A["Buka Menu 'Settings'"] --> B{"Pilih Kategori Pengaturan"}
    
    B -->|"Tab: Identity"| C["Ubah Nama Web, Tagline, dan Logo"]
    B -->|"Tab: Contact"| D["Ubah Telepon, Email, Alamat, dan Peta Google Maps"]
    B -->|"Tab: Social Media"| E["Ubah Link Instagram, WhatsApp, YouTube"]
    
    C --> Z["Klik Simpan Perubahan"]
    D --> Z
    E --> Z
    
    Z --> Y["Sistem Mengganti Variabel Master"]
    Y --> Final1["Perubahan Otomatis Terjadi di Header, Footer, dan Semua Halaman Sekaligus"]
    
    %% Alur Legal
    A2["Buka Menu 'Legal Pages'"] --> L1["Edit Teks Kebijakan Privasi (Privacy Policy)"]
    L1 --> LZ["Klik Simpan -> Halaman Legal Publik Berubah Tanpa Coding"]
```

### C. Alur Manajemen Kampanye (Programs)

```mermaid
graph TD
    A["Buka Menu 'Campaigns'"] --> B{"Pilih Tindakan"}
    
    B -->|"Tambah Baru"| C["Klik 'Buat Campaign Baru'"]
    C --> C1["Isi Judul, Deskripsi Lengkap, Target Dana, dan Upload Banner"]
    C1 --> C2["Klik Simpan -> Program Baru Terbit di Halaman Publik"]
    
    B -->|"Tutup Program"| E["Klik Toggle 'Active' Menjadi 'Inactive'"]
    E --> E1["Program Disembunyikan dari Publik, Namun Arsip Tetap Aman di Database"]
```

### D. Alur Profil Organisasi (About Us, Tim, Focus Areas)

```mermaid
graph TD
    A["Buka Modul Profil"] --> B{"Pilih Menu Spesifik"}
    
    B -->|"About Us"| C["Ubah Paragraf Sejarah, Visi, atau Misi Organisasi"]
    
    B -->|"Members (Tim)"| D["Klik 'Tambah Anggota Tim'"]
    D --> D1["Upload Foto, Ketik Nama dan Jabatan Pengurus"]
    
    B -->|"Focus Areas"| E["Klik 'Tambah Area Fokus'"]
    E --> E1["Masukkan Judul Kategori (Misal: Pendidikan Bencana) dan Ikon"]
    
    C --> Z["Simpan"]
    D1 --> Z
    E1 --> Z
    
    Z --> Final["Halaman 'Tentang Kami' dan Daftar Kategori Otomatis Diperbarui"]
```

### E. Alur Media & Relasi Publik (Banner, Galeri, Partner, FAQ)

```mermaid
graph TD
    A["Buka Modul Media/PR"] --> B{"Pilih Menu Spesifik"}
    
    B -->|"Image Slider"| C["Upload Gambar Kualitas Tinggi untuk Spanduk Depan (Beranda)"]
    B -->|"Gallery"| D["Upload Foto Kegiatan Lapangan atau Masukkan Link Video YouTube"]
    B -->|"Partners"| E["Upload Logo Sponsor/Perusahaan B2B"]
    B -->|"FAQs"| F["Ketik Pertanyaan Baru dari Masyarakat Beserta Jawabannya"]
    
    C --> Z["Klik Simpan"]
    D --> Z
    E --> Z
    F --> Z
    
    Z --> Final["Elemen Visual dan Bantuan Publik Otomatis Tayang"]
```

### F. Alur Interaksi Publik (Inbox Pesan)

```mermaid
graph TD
    A["Masyarakat Mengisi Form 'Contact Us' di Web Publik"] --> B["Pesan Terekam ke Database"]
    
    B --> C["Admin Buka Menu 'Messages' di Dashboard"]
    C --> D["Sistem Menampilkan Daftar Pesan Masuk (Urut dari Terbaru)"]
    D --> E["Admin Klik Pesan untuk Membaca Detail (Email, No. HP, Isi Pesan)"]
    E --> F["Admin Menghubungi Balik Pengirim (via WhatsApp/Email Eksternal)"]
    F --> G["Admin Menghapus Pesan Jika Sudah Diselesaikan"]
```

---

## 5. ⚙️ Penjelasan Teknis dan Arsitektur Sistem (Developer Section)

Sistem Fundunity dibangun di atas pondasi **Framework Laravel 12**. Pendekatan arsitekturnya menggunakan **Model-View-Controller (MVC)** yang memisahkan logika data dengan tampilan layar.

```mermaid
graph TD
    subgraph "1. Client Layer (Frontend / Browser)"
        Browser["Komputer / HP Pengunjung"]
    end
    
    subgraph "2. Routing dan Middleware"
        Router["routes/web.php (Peta Jalan Sistem)"]
        Auth["Middleware (Pelindung Rute Admin)"]
    end
    
    subgraph "3. Application Logic (Controllers)"
        LandingCtrl["LandingController (Melayani Halaman Publik)"]
        AdminCtrl["Admin Controllers (Mengurus Logika CMS)"]
    end
    
    subgraph "4. Data Layer (Models dan MySQL Database)"
        DB[("Database MySQL (Flat CMS Architecture)")]
        Models["Models (Campaign, Stakeholder, Settings, dll)"]
    end
    
    subgraph "5. Presentation Layer (Views)"
        Blade["Blade Templates dan Tailwind CSS (Merakit HTML + Data)"]
    end

    %% Flow Alur MVC
    Browser -->|1. HTTP Request Ketik URL| Router
    Router -->|2A. Akses Publik| LandingCtrl
    Router -->|2B. Akses Admin| Auth
    Auth -->|Jika Valid| AdminCtrl
    
    LandingCtrl <-->|3. Ambil Data| Models
    AdminCtrl <-->|3. Simpan atau Ambil Data| Models
    Models <--> DB
    
    LandingCtrl -->|4. Kirim Data| Blade
    AdminCtrl -->|4. Kirim Data| Blade
    
    Blade -->|5. Kembalikan HTML Jadi| Browser
```

### A. Alat dan Teknologi Pendukung (Tech Stack):
1. **Laravel 12 (PHP 8.2):** *Backend framework* yang mengatur logika, keamanan (login/reset sandi), dan rute.
2. **Tailwind CSS:** *Framework* desain (CSS) modern yang membuat web responsif di HP maupun Laptop.
3. **Blade Template Engine:** Mesin perakit tampilan milik Laravel.
4. **Vite:** *Asset bundler* yang mempercepat pemuatan halaman web.
5. **Laravel Breeze:** Menangani sistem otentikasi.

### B. Konsep "Flat CMS" (Kunci Keamanan Database)
Struktur database Fundunity sengaja dibuat **tanpa relasi yang mengikat ketat (No Foreign Keys)**. 
- **Keuntungan (Cascade Safe):** Jika admin salah menghapus data di menu `FAQs`, halaman `About Us` atau `Programs` tidak akan ikut rusak secara beruntun (*cascade error*).
- **Zero Downtime:** Karena sistem CMS tidak mengandalkan relasi tabel yang berat, website memuat data jauh lebih cepat dibantu dengan pembersihan memori (*Auto-Clear Cache*) saat admin menekan tombol Simpan.

---

## 6. 🎬 SCRIPT VIDEO: Manual Book Panduan Penggunaan Fundunity

> [!TIP]
> Script di bawah ini dirancang murni sebagai **Video Tutorial (Buku Manual Visual)**. Nada penyampaian harus jelas, informatif, dan tahap-demi-tahap (Step-by-Step). Narator mengarahkan penonton langsung ke tombol yang harus diklik.

| Bagian | Layar / Rekaman Kursor (Screen Record) | Panduan Suara (Voice Over Narator) |
| :--- | :--- | :--- |
| **I. Pendahuluan & Sisi Publik** (00:00 - 00:30) | Buka halaman *Home*. Kursor mengarah ke menu *About Us*, lalu ke halaman *Programs*. <br><br>Kursor mengklik salah satu program yang sedang berjalan. <br><br>Kursor menekan tombol **Get Involved** dan menyorot tiga form: Donasi, Relawan, dan Kemitraan. | "Halo, selamat datang di panduan sistem Fundunity. <br><br>Bagi pengunjung publik, website ini sangat mudah diakses. Menu 'Tentang Kami' memuat profil lembaga, sementara menu 'Program' menampilkan daftar kegiatan yang sedang berjalan. <br><br>Untuk bergabung, pengunjung cukup menekan tombol 'Get Involved' lalu memilih ingin berdonasi uang, mendaftar sebagai relawan, atau mengajukan kemitraan B2B." |
| **II. Login ke Panel Admin** (00:30 - 01:00) | Buka tab baru, ketik URL `website.com/admin`. <br><br>Masukkan email dan kata sandi. Tekan 'Login'. <br><br>Layar menampilkan *Dashboard* utama dengan statistik Donasi. | "Sekarang mari beralih ke sisi Administrator. <br><br>Untuk mengelola website, tambahkan kata garis miring 'admin' di akhir alamat website Anda. Masukkan email dan sandi yang telah didaftarkan. <br><br>Setelah berhasil masuk, Anda akan disambut oleh Dashboard yang menampilkan ringkasan data donasi dan status sistem." |
| **III. Mengatur Identitas Website** (01:00 - 01:30) | Di *sidebar* kiri, klik menu **Settings**. <br><br>Pilih tab **Contact**, ubah nomor WhatsApp. <br><br>Pilih tab **Identity**, ubah nama web. Klik tombol **Save**. <br><br>Buka kembali tab web publik untuk melihat perubahannya. | "Untuk mengganti informasi kontak, buka menu 'Settings' di bilah sisi kiri. <br><br>Di dalam menu ini, Anda bisa mengubah Nomor WhatsApp, Email, Link Sosial Media, hingga Logo Lembaga. Masukkan informasi baru, lalu tekan tombol 'Simpan'. <br><br>Sistem otomatis memperbarui seluruh informasi ini di halaman depan, header, dan footer." |
| **IV. Mengelola Program Kampanye** (01:30 - 02:00) | Klik menu **Campaigns** di *sidebar*. <br><br>Klik tombol **Buat Baru**. Isi form: Judul, Target Rupiah, Deskripsi, dan unggah *cover image*. <br><br>Klik tombol *Toggle Active* di salah satu tabel program untuk mematikannya. | "Selanjutnya, menu 'Campaigns'. Ini adalah tempat Anda membuat program penggalangan dana baru. <br><br>Cukup klik 'Buat Baru', isi judul program, target pengumpulan dana, dan unggah fotonya. <br><br>Jika program sudah selesai, Anda cukup menekan tombol saklar 'Aktif' agar statusnya nonaktif dan menghilang dari beranda publik." |
| **V. Pelaporan Keuangan (Transparansi)** (02:00 - 02:40) | Klik menu **Keuangan & Transparansi**. <br><br>Masuk ke Tab **Laporan Penyaluran**, klik tombol **Detail** pada salah satu program. <br><br>Pindah ke tab **Dokumentasi Publik**, isi judul laporan, unggah foto, dan masukkan **nominal uang**. Tekan Simpan. | "Fitur terpenting ada di menu 'Keuangan dan Transparansi'. <br><br>Untuk melaporkan uang yang sudah dipakai, masuk ke Tab Laporan Penyaluran, lalu klik 'Detail' pada program yang Anda tuju. <br><br>Pilih tab Dokumentasi Publik. Di sini, masukkan judul kegiatan, unggah bukti foto, dan ketik nominal uang yang telah disalurkan. Saat Anda klik publikasikan, saldo sisa donasi di halaman depan akan otomatis terpotong." |
| **VI. Mengelola Interaksi Publik** (02:40 - 03:00) | Klik menu **Messages**. Kursor menyorot tabel berisi daftar pertanyaan pengunjung. <br><br>Klik tombol 'Hapus' pada pesan yang sudah dibalas. | "Terakhir, fitur 'Messages'. <br><br>Semua pertanyaan dari form kontak di website akan tersimpan dengan aman di menu ini. Anda bisa melihat nomor telepon pengunjung dan menghubungi mereka secara eksternal. <br><br>Sistem ini memastikan tidak ada keluhan yang terlewatkan. Sekian panduan operasional Fundunity." |
