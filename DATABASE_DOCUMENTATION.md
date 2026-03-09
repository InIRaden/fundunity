# Dokumentasi Database — Admin CMS
## Proyek: Komunitas Ruang Berbagi (Fundunity)
**Tanggal:** 9 Maret 2026

---

## Daftar Isi

1. [Gambaran Umum Arsitektur](#1-gambaran-umum-arsitektur)
2. [Tabel `site_settings`](#2-tabel-site_settings)
3. [Tabel `pages`](#3-tabel-pages)
4. [Tabel `mission_items`](#4-tabel-mission_items)
5. [Tabel `organization_values`](#5-tabel-organization_values)
6. [Tabel `programs`](#6-tabel-programs)
7. [Tabel `partners`](#7-tabel-partners)
8. [Tabel `faqs`](#8-tabel-faqs)
9. [Tabel `gallery_items`](#9-tabel-gallery_items)
10. [Tabel `focus_areas`](#10-tabel-focus_areas)
11. [Tabel `impact_stats`](#11-tabel-impact_stats)
12. [Tabel `team_members`](#12-tabel-team_members)
13. [Tabel `involvement_types`](#13-tabel-involvement_types)
14. [Tabel `involvement_benefits`](#14-tabel-involvement_benefits)
15. [Tabel `newsletter_subscribers`](#15-tabel-newsletter_subscribers)
16. [Relasi Antar Tabel](#16-relasi-antar-tabel)
17. [Cara Kerja di View (Blade)](#17-cara-kerja-di-view-blade)

---

## 1. Gambaran Umum Arsitektur

Sistem CMS ini menggunakan pendekatan **"flat CMS"** — setiap tabel berdiri sendiri (standalone) tanpa foreign key antar tabel CMS. Pendekatan ini dipilih karena:

- **Mudah dikelola**: Admin bisa edit satu tabel tanpa takut merusak tabel lain
- **Sederhana**: Tidak ada join query yang rumit
- **Fleksibel**: Setiap tabel bisa dikembangkan secara independen

### Dua Jenis Konten

| Jenis | Tabel | Penjelasan |
|---|---|---|
| **Konten Global** | `site_settings` | Tampil di semua halaman — nama organisasi, kontak, footer, sosmed |
| **Konten Per-Halaman** | `pages` + tabel pendukung | Khusus untuk satu halaman tertentu |
| **Konten Dinamis (List)** | Semua tabel lainnya | Data berulang yang bisa ditambah/hapus |

### Peta Halaman → Tabel

```
Halaman /              → pages(home), site_settings, programs, partners, gallery_items
Halaman /about         → pages(about), mission_items, organization_values, team_members
Halaman /allprograms   → pages(programs), programs
Halaman /focusareas    → pages(focus-areas), focus_areas, impact_stats
Halaman /moregallery   → pages(gallery), gallery_items
Halaman /partners      → pages(partners), partners
Halaman /contact       → pages(contact), site_settings
Halaman /faqs          → pages(faq), faqs
Halaman /getinvolved   → pages(get-involved), involvement_types, involvement_benefits
Halaman /privacy       → pages(privacy)
Halaman /terms         → pages(terms)
Navbar (semua)         → site_settings
Footer (semua)         → site_settings, newsletter_subscribers
```

---

## 2. Tabel `site_settings`

### Kegunaan
Menyimpan semua teks dan URL yang tampil di **setiap halaman** — navbar, footer, kontak, sosial media, dan newsletter. Karena konten ini dipakai berulang di semua halaman, cukup disimpan sekali di sini dan dipanggil dari mana saja via `setting('key')`.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key, auto increment |
| `key` | VARCHAR(100) | Tidak | **Kunci unik** — digunakan di kode blade untuk memanggil nilai, contoh: `setting('phone')`. Harus unik, tidak boleh ada duplikat. Gunakan format `snake_case`. |
| `value` | TEXT | Ya | **Nilai konten** yang ditampilkan ke pengunjung. Bisa berupa teks biasa, URL, atau path gambar tergantung kolom `type`. |
| `type` | ENUM | Tidak | Menentukan **jenis input** di halaman admin: `text` = input teks satu baris, `textarea` = input teks panjang, `url` = input URL dengan validasi, `image` = upload gambar |
| `group` | VARCHAR(50) | Tidak | **Pengelompokan** di halaman admin agar tampil rapi: `general`, `contact`, `footer`, `social`, `newsletter` |
| `label` | VARCHAR(100) | Tidak | **Nama tampilan** di halaman admin, contoh: "Nomor Telepon". Ini yang admin lihat saat mengedit. |
| `created_at` | TIMESTAMP | Ya | Waktu baris dibuat (otomatis oleh Laravel) |
| `updated_at` | TIMESTAMP | Ya | Waktu terakhir baris diperbarui (otomatis oleh Laravel) |

### Daftar Baris (Data)

| key | group | label | Dipakai di |
|---|---|---|---|
| `site_name` | general | Nama Organisasi | Navbar (teks logo), Footer (judul), `<title>` browser |
| `site_logo` | general | URL Logo | Navbar (gambar logo) |
| `site_tagline` | general | Tagline Utama | Hero beranda, meta description |
| `phone` | contact | Nomor Telepon | Footer, halaman /contact |
| `email` | contact | Alamat Email | Footer, halaman /contact |
| `address` | contact | Alamat Fisik | Footer, halaman /contact |
| `operating_hours_weekday` | contact | Jam Operasional (Senin-Jumat) | Halaman /contact |
| `operating_hours_saturday` | contact | Jam Operasional (Sabtu) | Halaman /contact |
| `contact_map_title` | contact | Judul Section Peta | Halaman /contact |
| `contact_map_embed_url` | contact | URL Embed Google Maps | Halaman /contact |
| `contact_map_label` | contact | Label Peta | Halaman /contact |
| `instagram_url` | social | URL Instagram | Footer |
| `whatsapp_url` | social | URL WhatsApp Channel | Footer |
| `footer_tagline` | footer | Deskripsi Singkat di Footer | Footer (bawah nama organisasi) |
| `footer_copyright` | footer | Teks Copyright | Footer (paling bawah) |
| `newsletter_title` | newsletter | Judul Form Newsletter | Footer (section subscribe) |
| `newsletter_description` | newsletter | Deskripsi Newsletter | Footer (section subscribe) |
| `newsletter_cta_text` | newsletter | Teks Tombol Subscribe | Footer (tombol berlangganan) |
| `newsletter_placeholder` | newsletter | Placeholder Input Email | Footer (input email) |

### Contoh Cara Baca di Blade
```blade
{{ setting('phone') }}
{{ setting('site_name') }}
<img src="{{ setting('site_logo') }}" alt="Logo">
```

---

## 3. Tabel `pages`

### Kegunaan
Menyimpan konten **hero section dan bagian utama** setiap halaman. Setiap baris mewakili satu halaman. Kolom-kolomnya dirancang agar bisa mengisi semua teks yang biasa ada di halaman: judul besar, subjudul, tombol CTA, konten panjang, dll.

Khusus halaman `/about`, ada kolom tambahan untuk visi, misi, cerita, dan tim.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `slug` | VARCHAR(100) | Tidak | **Identifier halaman** — digunakan di kode untuk memanggil data halaman tertentu, contoh: `Page::where('slug', 'about')->first()`. Harus unik dan sesuai nama halaman. |
| `meta_title` | VARCHAR(200) | Tidak | **Judul tab browser** (`<title>`). Tampil di tab browser dan hasil pencarian Google. |
| `hero_title` | VARCHAR(255) | Ya | **Judul besar** di hero section (teks paling mencolok di bagian atas halaman) |
| `hero_subtitle` | TEXT | Ya | **Sub-judul** di bawah hero_title, biasanya teks deskriptif lebih pendek |
| `hero_image` | VARCHAR(500) | Ya | **URL gambar background** hero section. Jika kosong, pakai warna gradient dari CSS. |
| `hero_btn_primary_text` | VARCHAR(100) | Ya | **Teks tombol utama** di hero, contoh: "Ayo Mulai Bergerak" |
| `hero_btn_primary_url` | VARCHAR(300) | Ya | **URL tombol utama** — bisa path relatif `/getinvolved` atau URL eksternal |
| `hero_btn_secondary_text` | VARCHAR(100) | Ya | **Teks tombol kedua** di hero, contoh: "Donasi Sekarang" |
| `hero_btn_secondary_url` | VARCHAR(300) | Ya | **URL tombol kedua** |
| `section_title` | VARCHAR(255) | Ya | **Judul section konten utama** halaman, contoh: "Bagaimana Anda Bisa Berkontribusi" |
| `section_subtitle` | TEXT | Ya | **Sub-judul section** di bawah section_title |
| `cta_title` | VARCHAR(255) | Ya | **Judul section CTA** di bagian bawah halaman, contoh: "Bergabunglah dengan Gerakan Kami" |
| `cta_description` | TEXT | Ya | **Deskripsi CTA**, contoh: "Bersama kita bisa membuat perbedaan yang nyata" |
| `cta_btn_text` | VARCHAR(100) | Ya | **Teks tombol CTA**, contoh: "Mulai Berkontribusi" |
| `body_content` | LONGTEXT | Ya | **Konten HTML panjang** — khusus untuk halaman privacy dan terms yang isinya banyak teks. Bisa diisi dengan rich text editor di admin. |
| `vision_title` | VARCHAR(200) | Ya | *(Khusus about)* Judul section visi, contoh: "Visi Kami" |
| `vision_content` | TEXT | Ya | *(Khusus about)* Teks panjang visi organisasi |
| `mission_title` | VARCHAR(200) | Ya | *(Khusus about)* Judul section misi, contoh: "Misi Kami" |
| `story_title` | VARCHAR(200) | Ya | *(Khusus about)* Judul section cerita, contoh: "Cerita Kami" |
| `story_content` | LONGTEXT | Ya | *(Khusus about)* Isi paragraf cerita/sejarah organisasi (HTML) |
| `team_section_title` | VARCHAR(200) | Ya | *(Khusus about)* Judul section tim, contoh: "Tim Kami" |
| `team_section_subtitle` | TEXT | Ya | *(Khusus about)* Sub-judul section tim, contoh: "Digerakkan oleh individu-individu yang berdedikasi..." |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Daftar Baris (Satu Baris = Satu Halaman)

| slug | Halaman | Kolom yang Dipakai |
|---|---|---|
| `home` | Beranda `/` | hero_title, hero_subtitle, hero_image, hero_btn_primary_text/url, hero_btn_secondary_text/url |
| `about` | Tentang Kami `/about` | hero_title, hero_subtitle, vision_*, mission_title, story_*, team_section_*, cta_* |
| `programs` | Program `/allprograms` | hero_title, hero_subtitle, cta_title, cta_description, cta_btn_text |
| `focus-areas` | Fokus Utama `/focusareas` | hero_title, hero_subtitle, cta_* |
| `gallery` | Galeri `/moregallery` | hero_title, hero_subtitle |
| `partners` | Mitra `/partners` | hero_title, hero_subtitle, section_title, section_subtitle, cta_* |
| `contact` | Hubungi Kami `/contact` | hero_title, hero_subtitle, section_title |
| `faq` | FAQ `/faqs` | hero_title, hero_subtitle, cta_title, cta_description |
| `get-involved` | Bergabung `/getinvolved` | hero_title, hero_subtitle, section_title, section_subtitle |
| `privacy` | Kebijakan Privasi `/privacy` | meta_title, body_content |
| `terms` | Syarat & Ketentuan `/terms` | meta_title, body_content |

### Contoh Cara Baca di Blade
```blade
@php $page = \App\Models\Page::where('slug', 'about')->first(); @endphp

<h1>{{ $page->hero_title }}</h1>
<p>{{ $page->hero_subtitle }}</p>
<h2>{{ $page->vision_title }}</h2>
<p>{{ $page->vision_content }}</p>
{!! $page->story_content !!}  {{-- HTML panjang, gunakan {!! !!} --}}
```

---

## 4. Tabel `mission_items`

### Kegunaan
Menyimpan **item-item daftar misi** yang tampil sebagai list dengan ikon centang di halaman `/about`. Karena jumlah misi bisa berubah (tambah/kurang), dibuat tabel tersendiri agar admin bisa mengelolanya secara fleksibel.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `text` | TEXT | Tidak | **Teks satu item misi**, contoh: "Menyediakan bantuan pangan berkualitas untuk yang membutuhkan" |
| `sort_order` | INT | Tidak, default 0 | **Urutan tampil** — angka kecil tampil lebih dulu. Admin bisa mengubah urutan dengan mengubah angka ini. |
| `is_active` | BOOLEAN | Tidak, default true | **Aktif/nonaktif** — jika false, item tidak tampil di halaman publik tanpa perlu dihapus permanen. |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Contoh Data

| id | text | sort_order | is_active |
|---|---|---|---|
| 1 | Menyediakan bantuan pangan berkualitas untuk yang membutuhkan | 1 | true |
| 2 | Memberdayakan masyarakat melalui edukasi dan pelatihan | 2 | true |
| 3 | Membangun jaringan kolaborasi untuk dampak yang berkelanjutan | 3 | true |

### Contoh Cara Baca di Blade
```blade
@foreach(\App\Models\MissionItem::where('is_active', true)->orderBy('sort_order')->get() as $item)
<li class="flex items-start">
    <svg><!-- ikon centang --></svg>
    {{ $item->text }}
</li>
@endforeach
```

---

## 5. Tabel `organization_values`

### Kegunaan
Menyimpan **kartu nilai-nilai organisasi** yang tampil di halaman `/about` (seksi "Nilai-Nilai Kami"). Setiap baris = satu kartu dengan ikon, judul, dan deskripsi.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `title` | VARCHAR(200) | Tidak | **Nama nilai**, contoh: "Kepedulian", "Integritas", "Kolaborasi" |
| `description` | TEXT | Tidak | **Deskripsi nilai** — teks yang tampil di bawah judul pada kartu |
| `icon` | VARCHAR(100) | Ya | **Kode SVG path atau nama ikon** — digunakan renderer di blade untuk menampilkan ikon yang sesuai |
| `color` | VARCHAR(50) | Ya | **Kelas warna Tailwind** atau hex color untuk warna tema kartu, contoh: `green-600`, `blue-500` |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil kartu |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Contoh Data

| id | title | description | sort_order |
|---|---|---|---|
| 1 | Kepedulian | Kami peduli pada sesama dan berkomitmen untuk memberikan bantuan dengan sepenuh hati. | 1 |
| 2 | Integritas | Transparansi dan akuntabilitas dalam setiap tindakan adalah prioritas kami. | 2 |
| 3 | Kolaborasi | Bersama-sama kita lebih kuat dalam menciptakan perubahan yang berkelanjutan. | 3 |

---

## 6. Tabel `programs`

### Kegunaan
Menyimpan **daftar program kegiatan** organisasi. Data ini dipakai di dua tempat: halaman `/allprograms` (tampil semua) dan `/` beranda (tampil sebagian). Setiap baris = satu program.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `title` | VARCHAR(200) | Tidak | **Nama program**, contoh: "Program Pangan Darurat" |
| `short_description` | VARCHAR(500) | Tidak | **Deskripsi singkat** untuk tampilan kartu (card) di grid |
| `full_description` | TEXT | Ya | **Deskripsi panjang** — dipakai jika ada halaman detail program |
| `image` | VARCHAR(500) | Ya | **URL gambar** program yang tampil di kartu |
| `icon` | VARCHAR(100) | Ya | Nama ikon opsional sebagai alternatif gambar |
| `category` | VARCHAR(100) | Ya | **Kategori program** — untuk filter atau pengelompokan, contoh: `pangan`, `pendidikan`, `kesehatan` |
| `target_audience` | VARCHAR(200) | Ya | **Sasaran penerima manfaat**, contoh: "Lansia tidak mampu", "Anak-anak putus sekolah" |
| `location` | VARCHAR(200) | Ya | **Lokasi pelaksanaan program**, contoh: "Bandung Timur", "Jawa Barat" |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil — program dengan sort_order kecil muncul lebih dulu |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif — program nonaktif tidak tampil ke publik |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Logika di Controller
- Beranda: `Program::where('is_active', true)->orderBy('sort_order')->take(3)->get()`
- Halaman program: `Program::where('is_active', true)->orderBy('sort_order')->get()`

---

## 7. Tabel `partners`

### Kegunaan
Menyimpan **daftar mitra/partner** organisasi. Dipakai di halaman `/partners` (tampil semua dengan detail) dan slider di beranda (tampil logo saja secara bergantian).

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `name` | VARCHAR(200) | Tidak | **Nama mitra/perusahaan**, contoh: "PT. Sinar Mas", "UNICEF Indonesia" |
| `logo` | VARCHAR(500) | Tidak | **URL logo mitra** — wajib ada karena ini yang tampil paling menonjol |
| `website_url` | VARCHAR(500) | Ya | **Link website mitra** — logo di halaman mitra bisa diklik menuju website ini |
| `type` | ENUM | Tidak | **Jenis mitra**: `corporate` = perusahaan swasta, `ngo` = LSM/organisasi nirlaba, `government` = instansi pemerintah, `other` = lainnya. Dipakai untuk pengelompokan di halaman mitra. |
| `description` | TEXT | Ya | **Deskripsi singkat** tentang mitra — tampil di kartu mitra pada halaman /partners |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil di slider beranda |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Pengelompokan di Halaman /partners
```blade
{{-- Corporate --}}
@foreach(\App\Models\Partner::where('type', 'corporate')->where('is_active', true)->get() as $partner)

{{-- NGO --}}
@foreach(\App\Models\Partner::where('type', 'ngo')->where('is_active', true)->get() as $partner)
```

---

## 8. Tabel `faqs`

### Kegunaan
Menyimpan **daftar pertanyaan dan jawaban** yang tampil di halaman `/faqs`. Setiap baris = satu pasang pertanyaan-jawaban dengan efek accordion (klik pertanyaan → jawaban muncul/sembunyi).

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key — dipakai juga sebagai ID elemen HTML untuk accordion `id="faq-{{ $faq->id }}"` |
| `question` | VARCHAR(500) | Tidak | **Teks pertanyaan** yang tampil sebagai judul accordion |
| `answer` | TEXT | Tidak | **Jawaban lengkap** yang muncul saat pertanyaan diklik. Bisa berisi HTML. |
| `category` | VARCHAR(100) | Ya | **Kategori** untuk pengelompokan: `umum`, `donasi`, `relawan`, `kemitraan` — bisa dipakai filter tab di masa depan |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil FAQ |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

---

## 9. Tabel `gallery_items`

### Kegunaan
Menyimpan **semua item galeri**: foto dan video. Dipakai di halaman `/moregallery` dan juga di **gallery section beranda** (hanya item yang `is_featured = true`).

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `title` | VARCHAR(200) | Tidak | **Judul foto/video**, contoh: "Pembagian Sembako Ramadan 2025" |
| `type` | ENUM | Tidak | `image` = file foto, `video` = embed YouTube/Vimeo |
| `url` | VARCHAR(500) | Tidak | Jika `type=image`: URL gambar. Jika `type=video`: URL embed YouTube, contoh: `https://www.youtube.com/embed/xxxx` |
| `thumbnail` | VARCHAR(500) | Ya | **URL gambar thumbnail** — wajib diisi untuk video agar ada preview gambar sebelum diputar |
| `caption` | TEXT | Ya | **Keterangan** foto/video — tampil di bawah item atau saat hover |
| `category` | VARCHAR(100) | Ya | **Kategori** untuk tombol filter di halaman galeri, contoh: `kegiatan`, `dokumentasi`, `event` |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil |
| `is_featured` | BOOLEAN | Tidak, default false | **Tampil di beranda** — hanya item dengan `is_featured=true` yang muncul di gallery section homepage |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Logika di Controller
```php
// Beranda — hanya featured
$featuredItems = GalleryItem::where('is_active', true)
    ->where('is_featured', true)
    ->orderBy('sort_order')->get();

// Halaman galeri — semua
$galleryItems = GalleryItem::where('is_active', true)
    ->orderBy('sort_order')->get();
```

---

## 10. Tabel `focus_areas`

### Kegunaan
Menyimpan **area fokus utama** organisasi yang tampil di halaman `/focusareas`. Setiap baris = satu area fokus dengan penjelasan panjang, gambar ilustrasi, dan ikon.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `title` | VARCHAR(200) | Tidak | **Judul area fokus**, contoh: "Ketahanan Pangan", "Pendidikan Komunitas" |
| `description` | TEXT | Tidak | **Penjelasan panjang** tentang area fokus ini |
| `image` | VARCHAR(500) | Ya | **URL gambar ilustrasi** yang mewakili area fokus |
| `icon` | VARCHAR(100) | Ya | Nama ikon SVG atau kelas ikon untuk tampilan alternatif |
| `color` | VARCHAR(50) | Ya | Warna tema untuk elemen dekoratif, contoh: `green-600`, `blue-500` |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

---

## 11. Tabel `impact_stats`

### Kegunaan
Menyimpan **angka-angka statistik dampak** yang tampil di section "Impact Stats" halaman `/focusareas` (dan bisa di beranda). Contoh: "10.000+ Keluarga Terbantu", "500+ Relawan Aktif". Setiap baris = satu statistik.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `label` | VARCHAR(200) | Tidak | **Keterangan statistik**, contoh: "Keluarga Terbantu", "Relawan Aktif", "Kota Terjangkau" |
| `value` | VARCHAR(50) | Tidak | **Angka atau nilai** statistik, contoh: `10.000+`, `500+`, `15+`. Bertipe string karena bisa ada karakter `+`, `%`, dll. |
| `icon` | VARCHAR(100) | Ya | Ikon pendukung untuk mempercantik tampilan statistik |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Contoh Data

| label | value |
|---|---|
| Keluarga Terbantu | 10.000+ |
| Relawan Aktif | 500+ |
| Kota Terjangkau | 15+ |
| Program Berjalan | 8 |

---

## 12. Tabel `team_members`

### Kegunaan
Menyimpan **data anggota tim** yang tampil di halaman `/about` (seksi "Tim Kami"). Setiap baris = satu kartu anggota tim dengan foto, nama, dan jabatan.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `name` | VARCHAR(200) | Tidak | **Nama lengkap** anggota tim |
| `position` | VARCHAR(200) | Tidak | **Jabatan/peran**, contoh: "Ketua", "Koordinator Program", "Relawan Senior" |
| `bio` | TEXT | Ya | **Biografi singkat** — tampil jika ada halaman detail atau tooltip |
| `photo` | VARCHAR(500) | Ya | **URL foto** anggota. Jika kosong, tampilkan avatar default (ikon silhouette). |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil kartu tim |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif — anggota yang sudah tidak aktif bisa dinonaktifkan tanpa dihapus |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

---

## 13. Tabel `involvement_types`

### Kegunaan
Menyimpan **kartu cara berkontribusi** yang tampil di halaman `/getinvolved` (seksi "Bagaimana Anda Bisa Berkontribusi"). Setiap baris = satu kartu (Relawan, Donasi, Mitra). Kolom `form_type` penting karena dipakai oleh JavaScript untuk menampilkan form yang sesuai saat tombol diklik.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `title` | VARCHAR(200) | Tidak | **Judul kartu**, contoh: "Jadi Relawan", "Berdonasi", "Bermitra" |
| `description` | TEXT | Tidak | **Deskripsi** cara berkontribusi yang tampil di bawah judul kartu |
| `icon` | VARCHAR(100) | Ya | Path SVG ikon yang tampil di bagian atas kartu |
| `button_text` | VARCHAR(100) | Tidak | **Teks tombol** di kartu, contoh: "Daftar Sekarang", "Donasi Sekarang", "Ajukan Kemitraan" |
| `form_type` | VARCHAR(50) | Tidak | **Nilai kunci untuk JavaScript** — harus cocok dengan ID form di blade: `volunteer`, `donate`, `partner`. Saat admin mengubah nilai ini, pastikan ID di blade juga disesuaikan. |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil kartu |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Contoh Data

| title | description | button_text | form_type |
|---|---|---|---|
| Jadi Relawan | Berikan waktu dan tenaga Anda untuk membantu kegiatan langsung di lapangan. | Daftar Sekarang | volunteer |
| Berdonasi | Kontribusi finansial Anda membantu membiayai program-program kami. | Donasi Sekarang | donate |
| Bermitra | Organisasi atau perusahaan Anda dapat bermitra dengan kami. | Ajukan Kemitraan | partner |

### Perhatian Penting
Kolom `form_type` terhubung dengan ID elemen HTML di blade:
```blade
{{-- Kartu --}}
<button onclick="showForm('{{ $type->form_type }}')">{{ $type->button_text }}</button>

{{-- Form (harus punya ID yang cocok) --}}
<div id="{{ $type->form_type }}-form" class="hidden">...</div>
```

---

## 14. Tabel `involvement_benefits`

### Kegunaan
Menyimpan **kartu manfaat bergabung** yang tampil di halaman `/getinvolved` (seksi "Manfaat Bergabung"). Setiap baris = satu kartu manfaat dengan ikon, judul, dan deskripsi singkat.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `title` | VARCHAR(200) | Tidak | **Judul manfaat**, contoh: "Dampak Nyata", "Komunitas", "Pengembangan Diri", "Pengalaman Bermakna" |
| `description` | TEXT | Tidak | **Deskripsi singkat** manfaat yang tampil di bawah judul |
| `icon` | VARCHAR(100) | Ya | Path SVG ikon yang tampil di atas judul |
| `sort_order` | INT | Tidak, default 0 | Urutan tampil kartu |
| `is_active` | BOOLEAN | Tidak, default true | Aktif/nonaktif |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Contoh Data

| title | description |
|---|---|
| Dampak Nyata | Berkontribusi langsung pada perubahan positif |
| Komunitas | Bertemu orang-orang yang peduli |
| Pengembangan Diri | Belajar keterampilan baru |
| Pengalaman Bermakna | Kenangan yang tak terlupakan |

---

## 15. Tabel `newsletter_subscribers`

### Kegunaan
Menyimpan **data email pengunjung** yang mendaftar via form newsletter di footer. Ini adalah tabel **operasional** (bukan CMS) — admin tidak mengedit isinya, melainkan hanya membaca/mengeksport data subscriber untuk dikirim newsletter.

### Struktur Kolom

| Kolom | Tipe | Nullable | Penjelasan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Tidak | Primary key |
| `email` | VARCHAR(255) | Tidak, UNIQUE | **Alamat email subscriber** — harus unik, tidak bisa daftar dua kali dengan email sama. Validasi UNIQUE di database mencegah data duplikat. |
| `name` | VARCHAR(200) | Ya | **Nama subscriber** — opsional karena form hanya meminta email. Bisa diisi jika form diupdate. |
| `subscribed_at` | TIMESTAMP | Tidak | **Waktu pertama mendaftar** — diisi manual saat insert, bukan `created_at` agar tidak berubah jika baris diupdate. |
| `is_active` | BOOLEAN | Tidak, default true | **Status langganan** — jika false berarti sudah unsubscribe. Data tetap tersimpan untuk arsip, hanya tidak dikirim newsletter. |
| `created_at` | TIMESTAMP | Ya | Waktu dibuat |
| `updated_at` | TIMESTAMP | Ya | Waktu diperbarui |

### Catatan Keamanan
- Email yang masuk harus divalidasi format dengan `rule: email` di Laravel
- Endpoint `/newsletter/subscribe` harus dilindungi dari spam (rate limiting)
- Data email termasuk data pribadi — harus ada opsi unsubscribe sesuai UU PDP

---

## 16. Relasi Antar Tabel

### Jenis Relasi: Semua Standalone (Tidak Ada Foreign Key)

Semua tabel CMS berdiri **sendiri-sendiri** tanpa foreign key ke tabel lain. Ini adalah desain yang disengaja.

```
┌─────────────────────────────────────────────────────────────────┐
│                      KONTEN GLOBAL                              │
│  site_settings  ──────────────────────────────────────────────► │
│  (dipakai di semua halaman via helper function setting())       │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                   KONTEN PER-HALAMAN                            │
│                                                                 │
│  pages(slug=home)          ──► beranda /                        │
│  pages(slug=about)         ──► /about                           │
│  pages(slug=programs)      ──► /allprograms                     │
│  pages(slug=focus-areas)   ──► /focusareas                      │
│  pages(slug=gallery)       ──► /moregallery                     │
│  pages(slug=partners)      ──► /partners                        │
│  pages(slug=contact)       ──► /contact                         │
│  pages(slug=faq)           ──► /faqs                            │
│  pages(slug=get-involved)  ──► /getinvolved                     │
│  pages(slug=privacy)       ──► /privacy                         │
│  pages(slug=terms)         ──► /terms                           │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                    KONTEN DINAMIS                               │
│                                                                 │
│  mission_items       ──► /about (list misi)                     │
│  organization_values ──► /about (kartu nilai)                   │
│  team_members        ──► /about (kartu tim)                     │
│                                                                 │
│  programs            ──► / (beranda) + /allprograms             │
│                                                                 │
│  partners            ──► / (slider) + /partners                 │
│                                                                 │
│  faqs                ──► /faqs                                  │
│                                                                 │
│  gallery_items       ──► / (featured) + /moregallery            │
│                                                                 │
│  focus_areas         ──► /focusareas                            │
│  impact_stats        ──► /focusareas (statistik)                │
│                                                                 │
│  involvement_types   ──► /getinvolved (kartu cara)              │
│  involvement_benefits──► /getinvolved (kartu manfaat)           │
│                                                                 │
│  newsletter_subscribers ──► footer (data operasional)           │
└─────────────────────────────────────────────────────────────────┘
```

### Mengapa Tidak Ada Foreign Key?

| Alasan | Penjelasan |
|---|---|
| **Independen** | Admin bisa hapus satu baris tanpa risiko cascade delete ke tabel lain |
| **Sederhana** | Query tidak perlu JOIN — performa lebih baik untuk konten statis |
| **Mudah dikembangkan** | Tabel baru bisa ditambah tanpa mengubah schema tabel yang ada |
| **Sesuai pola CMS** | Hampir semua CMS flat (WordPress options table, dll) menggunakan pola ini |

---

## 17. Cara Kerja di View (Blade)

### Alur Data

```
Database → Model → Controller → View (Blade) → Browser
```

### 1. Konten Global (site_settings)

Cara paling nyaman adalah membuat **helper function** `setting()`:

```php
// app/helpers.php
function setting(string $key, string $default = ''): string
{
    return \App\Models\SiteSetting::where('key', $key)->value('value') ?? $default;
}
```

Kemudian di blade cukup:
```blade
{{ setting('site_name') }}
{{ setting('phone') }}
{{ setting('instagram_url') }}
```

### 2. Konten Per-Halaman (pages)

Di controller, kirim data page ke view:
```php
// LandingController.php
public function about()
{
    $page = \App\Models\Page::where('slug', 'about')->firstOrFail();
    $missionItems = \App\Models\MissionItem::where('is_active', true)->orderBy('sort_order')->get();
    $values = \App\Models\OrganizationValue::where('is_active', true)->orderBy('sort_order')->get();
    $team = \App\Models\TeamMember::where('is_active', true)->orderBy('sort_order')->get();

    return view('landing.about', compact('page', 'missionItems', 'values', 'team'));
}
```

Di blade:
```blade
<h1>{{ $page->hero_title }}</h1>
<h2>{{ $page->vision_title }}</h2>
<p>{{ $page->vision_content }}</p>
{!! $page->story_content !!}

@foreach($missionItems as $item)
    <li>{{ $item->text }}</li>
@endforeach

@foreach($values as $value)
    <h3>{{ $value->title }}</h3>
    <p>{{ $value->description }}</p>
@endforeach

@foreach($team as $member)
    <img src="{{ $member->photo ?? '/img/avatar-default.png' }}" alt="{{ $member->name }}">
    <h3>{{ $member->name }}</h3>
    <p>{{ $member->position }}</p>
@endforeach
```

### 3. Caching (Rekomendasi)

Karena konten ini jarang berubah, gunakan **cache** agar tidak query database setiap request:
```php
// Contoh cache site_settings selama 1 jam
$settings = Cache::remember('site_settings', 3600, function () {
    return SiteSetting::all()->pluck('value', 'key');
});
```

Saat admin menyimpan perubahan, **hapus cache** agar data terbaru segera tampil:
```php
Cache::forget('site_settings');
```

---

*Dokumentasi ini dibuat pada 9 Maret 2026. Update sesuai perubahan struktur database.*
