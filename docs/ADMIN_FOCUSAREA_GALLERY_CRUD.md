# Admin Focus Areas & More Gallery CRUD

Dokumentasi ini menjelaskan route admin, alur CRUD, dan seeder untuk:
- Focus Areas (`/focusareas`)
- More Gallery (`/moregallery`)

## 1. Route Admin

### Focus Areas
- `GET /admin/focus-areas` -> daftar focus area
- `GET /admin/focus-areas/create` -> form tambah
- `POST /admin/focus-areas` -> simpan baru
- `GET /admin/focus-areas/{focus_area}/edit` -> form edit
- `PUT /admin/focus-areas/{focus_area}` -> update
- `DELETE /admin/focus-areas/{focus_area}` -> hapus

### Gallery Items
- `GET /admin/gallery-items` -> daftar item galeri
- `GET /admin/gallery-items/create` -> form tambah
- `POST /admin/gallery-items` -> simpan baru
- `GET /admin/gallery-items/{gallery_item}/edit` -> form edit
- `PUT /admin/gallery-items/{gallery_item}` -> update
- `DELETE /admin/gallery-items/{gallery_item}` -> hapus

## 2. Input File ke Storage

Kedua CRUD mendukung:
- Input link URL
- Upload file lokal

Jika upload file dipilih, file disimpan ke disk `public` dan path disimpan sebagai URL `/storage/...`.

Jalankan sekali agar file bisa diakses browser:

```bash
php artisan storage:link
```

## 3. Seeder dengan File ke Storage

Seeder membuat file SVG dummy langsung ke `storage/app/public/seed/...` lalu menyimpan URL-nya ke database.

Seeder yang ditambahkan:
- `FocusAreaSeeder`
- `GalleryItemSeeder`

Jalankan salah satu:

```bash
php artisan db:seed --class=FocusAreaSeeder
php artisan db:seed --class=GalleryItemSeeder
```

Atau jalankan semua seeder yang terdaftar di `DatabaseSeeder`:

```bash
php artisan db:seed
```

## 4. Route Frontend

- Focus Areas page: `/focusareas`
- More Gallery page: `/moregallery`

Kedua halaman sekarang membaca data dari database tabel `focus_areas` dan `gallery_items`.
