# Admin Programs CRUD

Dokumentasi ini menjelaskan cara menggunakan panel admin sederhana untuk CRUD data program halaman `/allprograms`.

## 1. Route yang Ditambahkan

- `GET /admin/programs` -> daftar program
- `GET /admin/programs/create` -> form tambah program
- `POST /admin/programs` -> simpan program baru
- `GET /admin/programs/{program}/edit` -> form edit program
- `PUT /admin/programs/{program}` -> update program
- `DELETE /admin/programs/{program}` -> hapus program

## 2. Menjalankan Migration

Kalau belum migrate:

```bash
php artisan migrate
```

## 3. Menjalankan Seeder Program

### Opsi A: Seeder khusus program

```bash
php artisan db:seed --class=ProgramSeeder
```

### Opsi B: Seeder global (DatabaseSeeder)

```bash
php artisan db:seed
```

## 4. Urutan Praktis dari Nol

```bash
php artisan migrate:fresh --seed
```

Perintah di atas akan:
- menghapus semua tabel,
- menjalankan semua migration,
- menjalankan `DatabaseSeeder` (termasuk `ProgramSeeder`).

## 5. Akses Admin dan Frontend

- Admin sederhana: `/admin/programs`
- Halaman publik program: `/allprograms`

## 6. Logika Fallback Gambar

Di halaman `/allprograms`, card program akan:
- menampilkan gambar jika kolom `image` terisi,
- menampilkan simbol (ikon SVG) jika `image` kosong.

Kolom `icon` disediakan sebagai informasi ikon di admin, tetapi fallback visual yang dipakai saat ini adalah ikon SVG default agar tampilan tetap konsisten.

## 7. Opsi Input Gambar (URL atau Upload File)

Di form admin create/edit program sekarang ada 2 opsi:

- `Link Gambar`: isi URL gambar langsung (contoh `https://...`)
- `Upload File Gambar`: upload file dari komputer (jpg/png/webp, max 2MB)

Aturan prioritas:

- jika upload file diisi, sistem pakai file upload,
- jika upload file kosong dan link diisi, sistem pakai link,
- jika dua-duanya kosong, nilai gambar tetap kosong (frontend tampilkan simbol fallback).

Pada halaman edit, ada juga opsi `Hapus gambar saat ini`.

## 8. Catatan untuk Frontend

Nilai kolom `programs.image` bisa berisi 2 format:

- URL eksternal, contoh: `https://images.unsplash.com/...`
- URL storage lokal dari Laravel, contoh: `/storage/programs/nama-file.webp`

Frontend tidak perlu membedakan keduanya, cukup pakai langsung sebagai `src` gambar.

Pseudo logic di blade:

```blade
@if($program->image)
	<img src="{{ $program->image }}" alt="{{ $program->title }}">
@else
	{{-- tampilkan ikon default --}}
@endif
```

## 9. Setup Wajib untuk Upload File

Agar file upload bisa diakses publik, jalankan sekali:

```bash
php artisan storage:link
```

Perintah ini membuat symlink dari `public/storage` ke `storage/app/public`.
