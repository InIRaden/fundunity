# Frontend Handoff - Struktur & Route (Programs, Focus Areas, More Gallery)

Dokumen ini merangkum hasil implementasi backend terbaru agar tim frontend bisa lanjut fokus perbaikan UI.

## 1. Scope Fitur yang Sudah Dibuat

Fitur yang sudah aktif:
- Admin CRUD Programs (`/allprograms`)
- Admin CRUD Focus Areas (`/focusareas`)
- Admin CRUD More Gallery (`/moregallery`)

## 2. Struktur File yang Perlu Diketahui Frontend

### 2.1 Controller
- `app/Http/Controllers/LandingController.php`
  - Menyediakan data ke halaman publik:
    - programs
    - focusAreas
    - gallery

- `app/Http/Controllers/Admin/ProgramController.php`
- `app/Http/Controllers/Admin/FocusAreaController.php`
- `app/Http/Controllers/Admin/GalleryItemController.php`
  - Controller admin CRUD untuk panel sederhana.

### 2.2 Model
- `app/Models/Program.php`
- `app/Models/FocusArea.php`
- `app/Models/GalleryItem.php`

### 2.3 View Publik (yang perlu diperbaiki tampilannya oleh frontend)
- `resources/views/landing/programs.blade.php`
- `resources/views/landing/focus-areas.blade.php`
- `resources/views/landing/gallery.blade.php`

### 2.4 View Admin (sederhana, fokus backend)
- `resources/views/admin/programs/index.blade.php`
- `resources/views/admin/programs/create.blade.php`
- `resources/views/admin/programs/edit.blade.php`

- `resources/views/admin/focus-areas/index.blade.php`
- `resources/views/admin/focus-areas/create.blade.php`
- `resources/views/admin/focus-areas/edit.blade.php`

- `resources/views/admin/gallery-items/index.blade.php`
- `resources/views/admin/gallery-items/create.blade.php`
- `resources/views/admin/gallery-items/edit.blade.php`

### 2.5 Route
- `routes/web.php`

### 2.6 Seeder
- `database/seeders/ProgramSeeder.php`
- `database/seeders/FocusAreaSeeder.php`
- `database/seeders/GalleryItemSeeder.php`

## 3. Route Publik

- `GET /allprograms`
- `GET /focusareas`
- `GET /moregallery`

## 4. Route Admin

### 4.1 Programs
- `GET /admin/programs`
- `GET /admin/programs/create`
- `POST /admin/programs`
- `GET /admin/programs/{program}/edit`
- `PUT|PATCH /admin/programs/{program}`
- `DELETE /admin/programs/{program}`

### 4.2 Focus Areas
- `GET /admin/focus-areas`
- `GET /admin/focus-areas/create`
- `POST /admin/focus-areas`
- `GET /admin/focus-areas/{focus_area}/edit`
- `PUT|PATCH /admin/focus-areas/{focus_area}`
- `DELETE /admin/focus-areas/{focus_area}`

### 4.3 More Gallery
- `GET /admin/gallery-items`
- `GET /admin/gallery-items/create`
- `POST /admin/gallery-items`
- `GET /admin/gallery-items/{gallery_item}/edit`
- `PUT|PATCH /admin/gallery-items/{gallery_item}`
- `DELETE /admin/gallery-items/{gallery_item}`

## 5. Kontrak Data untuk Frontend

### 5.1 Programs (`/allprograms`)
Sumber data: tabel `programs`

Field utama yang dipakai di card:
- `title`
- `short_description`
- `full_description` (opsional)
- `image` (opsional)
- `category` (opsional)
- `location` (opsional)

Catatan rendering:
- jika `image` ada -> tampilkan gambar
- jika `image` kosong -> tampilkan fallback icon/simbol

### 5.2 Focus Areas (`/focusareas`)
Sumber data: tabel `focus_areas`

Field utama:
- `title`
- `description`
- `image` (opsional)
- `icon` (opsional)
- `color` (opsional)

Catatan rendering:
- jika `image` ada -> tampilkan gambar card
- jika `image` kosong -> tampilkan fallback visual

### 5.3 More Gallery (`/moregallery`)
Sumber data: tabel `gallery_items`

Field utama:
- `title`
- `type` (`image` atau `video`)
- `url` (wajib)
- `thumbnail` (opsional)
- `caption` (opsional)
- `category` (opsional)

Catatan rendering:
- jika `type=image` -> render `<img src="url">`
- jika `type=video` -> render `<iframe src="url">`
- `thumbnail` disiapkan untuk kebutuhan preview custom jika frontend ingin dipakai.

## 6. Format Nilai Gambar/File

Kolom gambar bisa berisi:
- URL eksternal (contoh: `https://...`)
- URL local storage Laravel (contoh: `/storage/...`)

Frontend cukup treat keduanya sebagai string URL biasa untuk atribut `src`.

## 7. Catatan Penting untuk Lingkungan Lokal

Agar file upload dan file seeder dari storage bisa tampil:

```bash
php artisan storage:link
```

## 8. Referensi Dokumentasi Internal

- `docs/ADMIN_PROGRAMS_CRUD.md`
- `docs/ADMIN_FOCUSAREA_GALLERY_CRUD.md`

---

Dokumen ini khusus handoff frontend untuk mempercepat redesign tampilan tanpa mengubah kontrak data backend.
