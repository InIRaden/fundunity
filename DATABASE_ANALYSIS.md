# Analisis Struktur Database untuk Admin CMS
## Proyek: Komunitas Ruang Berbagi (Fundunity)
**Tanggal:** 9 Maret 2026  
**Tujuan:** Memungkinkan semua teks di tampilan publik (termasuk footer, navbar, dan setiap halaman) dapat diedit dari halaman admin.

---

## Ringkasan Kebutuhan

Berdasarkan analisis seluruh file view di `resources/views/`, konten dibagi menjadi:
- **Konten Global** — muncul di semua halaman (navbar, footer, kontak, sosial media)
- **Konten Per-Halaman** — hero section, body text, dan konten spesifik tiap halaman
- **Konten Dinamis** — data berulang seperti program, mitra, FAQ, galeri, tim

---

## Tabel Database

### 1. `site_settings` — Pengaturan Global Situs

Digunakan untuk konten yang tampil di **semua halaman** (nama organisasi, kontak, footer, sosial media, newsletter).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | Auto increment |
| `key` | VARCHAR(100) UNIQUE | Kunci unik pengaturan |
| `value` | TEXT NULL | Nilai konten |
| `type` | ENUM | `text`, `textarea`, `url`, `image` |
| `group` | VARCHAR(50) | `general`, `contact`, `footer`, `social`, `newsletter` |
| `label` | VARCHAR(100) | Label tampil di halaman admin |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Daftar Key yang Diperlukan:**

| Key | Group | Nilai Awal |
|---|---|---|
| `site_name` | general | Komunitas Ruang Berbagi |
| `site_logo` | general | *(URL logo)* |
| `site_tagline` | general | Bersama Ciptakan Perubahan |
| `phone` | contact | 0821 - 1677 - 1146 |
| `email` | contact | komunitasruangberbagi@gmail.com |
| `address` | contact | Bandung, Jawa Barat, Indonesia |
| `instagram_url` | social | https://instagram.com/komunitasruangberbagi |
| `whatsapp_url` | social | https://whatsapp.com/channel/0029VazY3qSFXUuUlnV5VQ0q |
| `footer_tagline` | footer | Membantu individu dan organisasi mendukung berbagai aksi nyata... |
| `footer_copyright` | footer | Komunitas Ruang Berbagi. Semua hak dilindungi. |
| `newsletter_title` | newsletter | Bergabunglah Bersama Kami |
| `newsletter_description` | newsletter | Dapatkan pembaruan terbaru seputar program... |
| `newsletter_cta_text` | newsletter | Berlangganan |
| `newsletter_placeholder` | newsletter | Masukkan email Anda |

**Referensi View:**
- `resources/views/components/landing/navbar.blade.php`
- `resources/views/components/landing/footer.blade.php`

---

### 2. `pages` — Konten Hero & Meta Per Halaman

Digunakan untuk mengatur teks **hero section**, **meta title**, dan **konten panjang** (seperti Kebijakan Privasi dan Syarat & Ketentuan) di setiap halaman.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | Auto increment |
| `slug` | VARCHAR(100) UNIQUE | Identifier halaman |
| `meta_title` | VARCHAR(200) | Judul tab browser |
| `hero_title` | VARCHAR(255) NULL | Judul besar di hero section |
| `hero_subtitle` | TEXT NULL | Sub-judul hero |
| `hero_image` | VARCHAR(500) NULL | URL gambar background hero |
| `hero_btn_primary_text` | VARCHAR(100) NULL | Teks tombol CTA utama |
| `hero_btn_primary_url` | VARCHAR(300) NULL | URL tombol CTA utama |
| `hero_btn_secondary_text` | VARCHAR(100) NULL | Teks tombol CTA kedua |
| `hero_btn_secondary_url` | VARCHAR(300) NULL | URL tombol CTA kedua |
| `section_title` | VARCHAR(255) NULL | Judul section utama halaman |
| `section_subtitle` | TEXT NULL | Sub-judul section utama |
| `cta_title` | VARCHAR(255) NULL | Judul CTA bawah halaman |
| `cta_description` | TEXT NULL | Deskripsi CTA |
| `cta_btn_text` | VARCHAR(100) NULL | Teks tombol CTA |
| `body_content` | LONGTEXT NULL | Konten HTML panjang (privacy, terms, cerita, dll) |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Daftar Slug:**

| Slug | Meta Title | Hero Title |
|---|---|---|
| `home` | Bersama Ciptakan Perubahan | Bersama, Ciptakan Perubahan bersama Komunitas Ruang Berbagi |
| `about` | Tentang Kami | Tentang Komunitas Ruang Berbagi |
| `programs` | Program Kami | Program Kami |
| `focus-areas` | Fokus Utama | Fokus Utama Kami |
| `gallery` | Galeri | Galeri Momen Kami |
| `partners` | Mitra Kami | Mitra Kami |
| `contact` | Hubungi Kami | Hubungi Kami |
| `faq` | FAQ | Pertanyaan yang Sering Diajukan |
| `get-involved` | Bergabung Bersama Kami | Bergabung & Berdampak Bersama Kami |
| `privacy` | Kebijakan Privasi | *(isi via body_content)* |
| `terms` | Syarat & Ketentuan | *(isi via body_content)* |

**Referensi View:**
- `resources/views/landing/*.blade.php`

---

### 3. `programs` — Program Kegiatan Organisasi

Digunakan di halaman **Program** dan **section Programs di Home**.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `title` | VARCHAR(200) | Nama program |
| `short_description` | VARCHAR(500) | Deskripsi singkat (untuk card) |
| `full_description` | TEXT NULL | Deskripsi panjang |
| `image` | VARCHAR(500) NULL | URL gambar program |
| `icon` | VARCHAR(100) NULL | Nama ikon (opsional) |
| `category` | VARCHAR(100) NULL | Kategori program |
| `target_audience` | VARCHAR(200) NULL | Sasaran penerima manfaat |
| `location` | VARCHAR(200) NULL | Lokasi pelaksanaan |
| `sort_order` | INT DEFAULT 0 | Urutan tampil |
| `is_active` | BOOLEAN DEFAULT TRUE | Aktif/nonaktif |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/programs.blade.php`
- `resources/views/landing/home.blade.php` *(Programs Section)*

---

### 4. `partners` — Mitra Organisasi

Digunakan di halaman **Mitra** dan **slider partners di Home**.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `name` | VARCHAR(200) | Nama mitra |
| `logo` | VARCHAR(500) | URL logo |
| `website_url` | VARCHAR(500) NULL | Link website mitra |
| `type` | ENUM | `corporate`, `ngo`, `government`, `other` |
| `description` | TEXT NULL | Deskripsi singkat tentang mitra |
| `sort_order` | INT DEFAULT 0 | Urutan tampil di slider |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/partners.blade.php`
- `resources/views/landing/home.blade.php` *(Partners Section)*

---

### 5. `faqs` — Pertanyaan yang Sering Diajukan

Digunakan di halaman **FAQ**.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `question` | VARCHAR(500) | Teks pertanyaan |
| `answer` | TEXT | Jawaban lengkap |
| `category` | VARCHAR(100) NULL | Kelompok: `umum`, `donasi`, `relawan`, dll |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/faq.blade.php`

---

### 6. `gallery_items` — Foto dan Video Galeri

Digunakan di halaman **Galeri** dan **Gallery Section di Home** (termasuk slider).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `title` | VARCHAR(200) | Judul foto/video |
| `type` | ENUM | `image`, `video` |
| `url` | VARCHAR(500) | URL foto atau embed YouTube |
| `thumbnail` | VARCHAR(500) NULL | Thumbnail (wajib untuk video) |
| `caption` | TEXT NULL | Keterangan/deskripsi |
| `category` | VARCHAR(100) NULL | Kategori untuk filter tab |
| `sort_order` | INT DEFAULT 0 | |
| `is_featured` | BOOLEAN DEFAULT FALSE | Tampil di Home |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/gallery.blade.php`
- `resources/views/landing/home.blade.php` *(Gallery Section & Slider)*

---

### 7. `focus_areas` — Area Fokus Utama

Digunakan di halaman **Fokus Utama**.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `title` | VARCHAR(200) | Judul area fokus |
| `description` | TEXT | Penjelasan panjang |
| `image` | VARCHAR(500) NULL | Gambar ilustrasi |
| `icon` | VARCHAR(100) NULL | Ikon |
| `color` | VARCHAR(50) NULL | Warna tema (hex/class) |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/focus-areas.blade.php`

---

### 8. `impact_stats` — Statistik Dampak

Digunakan di **section Impact Stats** pada halaman Fokus Utama dan beranda.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `label` | VARCHAR(200) | Keterangan: `Keluarga Terbantu`, `Relawan Aktif`, dll |
| `value` | VARCHAR(50) | Nilai: `10.000+`, `500+`, dll |
| `icon` | VARCHAR(100) NULL | Ikon pendukung |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/focus-areas.blade.php` *(Impact Stats Section)*

---

### 9. `team_members` — Anggota Tim

Digunakan di halaman **Tentang Kami** (seksi Team).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `name` | VARCHAR(200) | Nama lengkap |
| `position` | VARCHAR(200) | Jabatan/peran |
| `bio` | TEXT NULL | Biografi singkat |
| `photo` | VARCHAR(500) NULL | URL foto |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/landing/about.blade.php` *(Team Section)*

---

### 10. `newsletter_subscribers` — Pelanggan Newsletter

Data operasional dari form **newsletter di footer**.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `email` | VARCHAR(255) UNIQUE | Alamat email |
| `name` | VARCHAR(200) NULL | Nama (opsional) |
| `subscribed_at` | TIMESTAMP | Waktu pertama daftar |
| `is_active` | BOOLEAN DEFAULT TRUE | Aktif/unsubscribe |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Referensi View:**
- `resources/views/components/landing/footer.blade.php` *(Form Newsletter)*

---

## Analisis Gap: Halaman /contact, /about, /getinvolved

### ❌ Konten yang BELUM Tercakup (Temuan Baru)

Setelah membaca isi file secara penuh, ditemukan beberapa konten yang **tidak bisa diedit** dengan struktur sebelumnya:

---

#### Halaman `/contact` (`contact.blade.php`)

| Bagian | Konten Hardcoded | Status Lama | Solusi |
|---|---|---|---|
| Hero | "Hubungi Kami", "Kami siap mendengar..." | ✅ `pages` | Sudah tercakup |
| Info Alamat | "Bandung, Jawa Barat, Indonesia" | ✅ `site_settings.address` | Sudah tercakup |
| Info Telepon | "0821 - 1677 - 1146" | ✅ `site_settings.phone` | Sudah tercakup |
| Info Email | "komunitasruangberbagi@gmail.com" | ✅ `site_settings.email` | Sudah tercakup |
| **Jam Operasional** | **"Senin - Jumat: 09:00 - 17:00"** | ❌ Tidak ada | Tambah key di `site_settings` |
| **Jam Operasional** | **"Sabtu: 09:00 - 13:00"** | ❌ Tidak ada | Tambah key di `site_settings` |
| **Map Section** | **"Lokasi Kami"**, embed URL Google Maps | ❌ Tidak ada | Tambah key di `site_settings` |
| Judul Form | "Kirim Pesan" | ⚠️ Parsial di `pages` | Perjelas di `pages.section_title` |

---

#### Halaman `/about` (`about.blade.php`)

| Bagian | Konten Hardcoded | Status Lama | Solusi |
|---|---|---|---|
| Hero | "Tentang Komunitas Ruang Berbagi" | ✅ `pages` | Sudah tercakup |
| **Visi** | **Judul "Visi Kami" + teks visi panjang** | ❌ Tidak ada | Tambah kolom di `pages` |
| **Misi** | **Judul "Misi Kami" + 3 item list misi** | ❌ Tidak ada | Tabel baru `mission_items` |
| **Cerita Kami** | **3 paragraf sejarah organisasi** | ❌ Tidak ada | Tambah kolom `story_content` di `pages` |
| **Nilai-Nilai** | **3 kartu: Kepedulian, Integritas, Kolaborasi** | ❌ Tidak ada | Tabel baru `organization_values` |
| Tim section header | "Tim Kami", subtitle deskripsi | ⚠️ Parsial | Tambah kolom di `pages` |
| Data tim | Nama, jabatan per anggota | ✅ `team_members` | Sudah tercakup |
| CTA | "Bergabunglah dengan Gerakan Kami", tombol teks | ✅ `pages.cta_*` | Sudah tercakup |

---

#### Halaman `/getinvolved` (`get-involved.blade.php`)

| Bagian | Konten Hardcoded | Status Lama | Solusi |
|---|---|---|---|
| Hero | "Bergabung Bersama Kami", subtitle | ✅ `pages` | Sudah tercakup |
| Intro Section | "Bagaimana Anda Bisa Berkontribusi", teks deskripsi | ✅ `pages.section_title` | Sudah tercakup |
| **Kartu Kontribusi** | **3 kartu: Jadi Relawan, Berdonasi, Bermitra** (judul, deskripsi, teks tombol) | ❌ Tidak ada | Tabel baru `involvement_types` |
| **Manfaat Bergabung** | **4 kartu: Dampak Nyata, Komunitas, Pengembangan Diri, Pengalaman Bermakna** | ❌ Tidak ada | Tabel baru `involvement_benefits` |

---

### Tabel & Field Tambahan yang Diperlukan

#### Tambahan Key pada `site_settings`

| Key | Group | Nilai Awal |
|---|---|---|
| `operating_hours_weekday` | contact | Senin - Jumat: 09:00 - 17:00 |
| `operating_hours_saturday` | contact | Sabtu: 09:00 - 13:00 |
| `contact_map_title` | contact | Lokasi Kami |
| `contact_map_embed_url` | contact | *(URL Google Maps Embed)* |
| `contact_map_label` | contact | Bandung, Jawa Barat |

#### Tambahan Kolom pada `pages`

Untuk slug `about`, perlu kolom tambahan:

| Kolom Baru | Tipe | Keterangan |
|---|---|---|
| `vision_title` | VARCHAR(200) NULL | Judul section visi, contoh: "Visi Kami" |
| `vision_content` | TEXT NULL | Teks visi organisasi |
| `mission_title` | VARCHAR(200) NULL | Judul section misi, contoh: "Misi Kami" |
| `story_title` | VARCHAR(200) NULL | Judul section cerita, contoh: "Cerita Kami" |
| `story_content` | LONGTEXT NULL | Paragraf-paragraf sejarah organisasi (HTML) |
| `team_section_title` | VARCHAR(200) NULL | Judul section tim, contoh: "Tim Kami" |
| `team_section_subtitle` | TEXT NULL | Sub-judul section tim |

---

### 11. `mission_items` — Item Daftar Misi

Digunakan di halaman **Tentang Kami** (seksi Misi — list item dengan ikon centang).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `text` | TEXT | Teks satu item misi |
| `sort_order` | INT DEFAULT 0 | Urutan tampil |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Data awal:**
1. Menyediakan bantuan pangan berkualitas untuk yang membutuhkan
2. Memberdayakan masyarakat melalui edukasi dan pelatihan
3. Membangun jaringan kolaborasi untuk dampak yang berkelanjutan

**Referensi View:**
- `resources/views/landing/about.blade.php` *(Mission Section)*

---

### 12. `organization_values` — Nilai-Nilai Organisasi

Digunakan di halaman **Tentang Kami** (seksi Nilai-Nilai — 3 kartu ikon).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `title` | VARCHAR(200) | Nama nilai, contoh: "Kepedulian" |
| `description` | TEXT | Deskripsi nilai |
| `icon` | VARCHAR(100) NULL | Nama/kode SVG ikon |
| `color` | VARCHAR(50) NULL | Warna tema |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Data awal:**

| title | description |
|---|---|
| Kepedulian | Kami peduli pada sesama dan berkomitmen untuk memberikan bantuan dengan sepenuh hati. |
| Integritas | Transparansi dan akuntabilitas dalam setiap tindakan adalah prioritas kami. |
| Kolaborasi | Bersama-sama kita lebih kuat dalam menciptakan perubahan yang berkelanjutan. |

**Referensi View:**
- `resources/views/landing/about.blade.php` *(Values Section)*

---

### 13. `involvement_types` — Tipe Cara Berkontribusi

Digunakan di halaman **Bergabung** (seksi 3 kartu cara berkontribusi: Relawan, Donasi, Mitra).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `title` | VARCHAR(200) | Judul kartu, contoh: "Jadi Relawan" |
| `description` | TEXT | Deskripsi cara berkontribusi |
| `icon` | VARCHAR(100) NULL | Ikon SVG |
| `button_text` | VARCHAR(100) | Teks tombol, contoh: "Daftar Sekarang" |
| `form_type` | VARCHAR(50) | Nilai untuk JS: `volunteer`, `donate`, `partner` |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Data awal:**

| title | description | button_text | form_type |
|---|---|---|---|
| Jadi Relawan | Berikan waktu dan tenaga Anda untuk membantu kegiatan langsung di lapangan. | Daftar Sekarang | volunteer |
| Berdonasi | Kontribusi finansial Anda membantu membiayai program-program kami. | Donasi Sekarang | donate |
| Bermitra | Organisasi atau perusahaan Anda dapat bermitra dengan kami. | Ajukan Kemitraan | partner |

**Referensi View:**
- `resources/views/landing/get-involved.blade.php` *(Ways to Get Involved)*

---

### 14. `involvement_benefits` — Manfaat Bergabung

Digunakan di halaman **Bergabung** (seksi 4 kartu manfaat bergabung).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED PK | |
| `title` | VARCHAR(200) | Judul manfaat, contoh: "Dampak Nyata" |
| `description` | TEXT | Deskripsi singkat manfaat |
| `icon` | VARCHAR(100) NULL | Ikon SVG |
| `sort_order` | INT DEFAULT 0 | |
| `is_active` | BOOLEAN DEFAULT TRUE | |
| `created_at` | TIMESTAMP | |
| `updated_at` | TIMESTAMP | |

**Data awal:**

| title | description |
|---|---|
| Dampak Nyata | Berkontribusi langsung pada perubahan positif |
| Komunitas | Bertemu orang-orang yang peduli |
| Pengembangan Diri | Belajar keterampilan baru |
| Pengalaman Bermakna | Kenangan yang tak terlupakan |

**Referensi View:**
- `resources/views/landing/get-involved.blade.php` *(Benefits Section)*

---

## Diagram Relasi Antar Tabel (Diperbarui)

```
site_settings           (standalone - global config + contact info + map + jam operasional)
pages                   (standalone - per-page hero, visi, misi header, cerita, CTA)
  └─ mission_items      (standalone - list item misi di halaman about)
  └─ organization_values(standalone - kartu nilai-nilai di halaman about)
programs                (standalone - list program kegiatan)
partners                (standalone - list mitra)
faqs                    (standalone - list FAQ)
gallery_items           (standalone - foto & video)
focus_areas             (standalone - area fokus utama)
impact_stats            (standalone - angka statistik dampak)
team_members            (standalone - anggota tim di halaman about)
involvement_types       (standalone - 3 cara berkontribusi di halaman getinvolved)
involvement_benefits    (standalone - 4 manfaat bergabung di halaman getinvolved)
newsletter_subscribers  (standalone - data email subscriber)
```

> Semua tabel bersifat **standalone** (tidak ada foreign key antar tabel CMS), sehingga mudah dikelola secara independen dari admin panel.

---

## Cakupan Konten Per Halaman (Sesudah Diperbarui)

| Halaman | Route | Semua Konten Bisa Diedit? | Tabel yang Dipakai |
|---|---|---|---|
| Beranda | `/` | ✅ Ya | `pages`, `site_settings`, `programs`, `partners`, `gallery_items` |
| **Tentang Kami** | `/about` | ✅ Ya | `pages` (+ kolom baru), `mission_items`, `organization_values`, `team_members` |
| Program | `/allprograms` | ✅ Ya | `pages`, `programs` |
| Fokus Utama | `/focusareas` | ✅ Ya | `pages`, `focus_areas`, `impact_stats` |
| Galeri | `/moregallery` | ✅ Ya | `pages`, `gallery_items` |
| Mitra | `/partners` | ✅ Ya | `pages`, `partners` |
| **Hubungi Kami** | `/contact` | ✅ Ya | `pages`, `site_settings` (+ key baru jam & map) |
| FAQ | `/faqs` | ✅ Ya | `pages`, `faqs` |
| **Bergabung** | `/getinvolved` | ✅ Ya | `pages`, `involvement_types`, `involvement_benefits` |
| Kebijakan Privasi | `/privacy` | ✅ Ya | `pages.body_content` |
| Syarat & Ketentuan | `/terms` | ✅ Ya | `pages.body_content` |
| Footer (semua halaman) | — | ✅ Ya | `site_settings`, `newsletter_subscribers` |
| Navbar (semua halaman) | — | ✅ Ya | `site_settings` |

---

## Prioritas Implementasi (Diperbarui)

| Prioritas | Tabel | Justifikasi |
|---|---|---|
| 🔴 **Tinggi** | `site_settings` | Semua halaman + jam operasional + map baru |
| 🔴 **Tinggi** | `pages` | Hero + visi + cerita + CTA semua halaman |
| 🔴 **Tinggi** | `programs` | Konten inti organisasi |
| 🔴 **Tinggi** | `mission_items` | Bagian penting halaman /about |
| 🔴 **Tinggi** | `involvement_types` | Konten utama halaman /getinvolved |
| 🟡 **Menengah** | `organization_values` | Halaman /about seksi nilai-nilai |
| 🟡 **Menengah** | `involvement_benefits` | Halaman /getinvolved seksi manfaat |
| 🟡 **Menengah** | `faqs` | Sering diperbarui tim |
| 🟡 **Menengah** | `partners` | Slider beranda & halaman mitra |
| 🟡 **Menengah** | `gallery_items` | Foto & video kegiatan |
| 🟡 **Menengah** | `focus_areas` | Halaman fokus utama |
| 🟢 **Rendah** | `team_members` | Jarang berubah |
| 🟢 **Rendah** | `impact_stats` | Update berkala |
| 🟢 **Rendah** | `newsletter_subscribers` | Data operasional |

---

## Langkah Implementasi Selanjutnya

1. **Buat migration files** untuk semua 14 tabel (tambah 4 tabel baru + alter `pages`)
2. **Buat Model Eloquent** beserta `fillable` dan `casts`
3. **Buat Seeder** dengan data awal dari teks hardcoded yang sudah ada di view
4. **Buat Admin Controller & Routes** dengan middleware `auth`
5. **Update blade views** untuk membaca data dari database:
   - `contact.blade.php` → baca `site_settings` untuk jam operasional & map
   - `about.blade.php` → baca `pages`, `mission_items`, `organization_values`, `team_members`
   - `get-involved.blade.php` → baca `involvement_types`, `involvement_benefits`
6. **Buat halaman admin CRUD** untuk setiap tabel

---

## Ringkasan Perubahan dari Versi Sebelumnya

| Perubahan | Detail |
|---|---|
| ➕ 5 key baru di `site_settings` | Jam operasional (2 key), map title, map embed URL, map label |
| ➕ 7 kolom baru di `pages` | vision_title, vision_content, mission_title, story_title, story_content, team_section_title, team_section_subtitle |
| ➕ Tabel baru `mission_items` | Item list misi di halaman About |
| ➕ Tabel baru `organization_values` | Kartu nilai-nilai di halaman About |
| ➕ Tabel baru `involvement_types` | 3 kartu cara berkontribusi di halaman GetInvolved |
| ➕ Tabel baru `involvement_benefits` | 4 kartu manfaat bergabung di halaman GetInvolved |

**Total tabel:** 10 (sebelumnya) → **14 tabel** (setelah diperbarui)

---

*Dokumen ini dibuat berdasarkan analisis file view di `resources/views/` pada tanggal 9 Maret 2026.*
*Diperbarui setelah analisis mendalam pada `/contact`, `/about`, `/getinvolved`.*
