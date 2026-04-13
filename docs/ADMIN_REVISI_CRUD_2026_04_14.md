# Admin Revisi CRUD (14 April 2026)

Dokumentasi ini merangkum semua revisi backend + frontend admin yang sudah dikerjakan pada sesi ini.

## 1. List Fitur Revisi

1. Admin Campaign (`/admin/campaign`)
- Data campaign tidak lagi hardcoded.
- CRUD backend aktif (tambah, ubah, hapus).
- Halaman admin terhubung ke endpoint JSON dan menampilkan loading state saat submit/delete.

2. Admin Messages (`/admin/messages`)
- Data pesan diambil dari database.
- CRUD backend aktif.
- Toggle status baca (`is_read`) terhubung backend, termasuk update cepat dari UI.
- Loading state untuk aksi update/delete.

3. Admin Focus Areas (`/admin/focusareas`)
- Data fokus area diambil dari database.
- CRUD admin-page aktif via JSON.
- Implementasi mengikuti request: memakai `FocusAreaController` yang sama (tanpa file `FocusAreaCrudController`).

4. Admin Gallery (`/admin/gallery`)
- Data galeri diambil dari database (`gallery_items`, type `image`).
- CRUD backend aktif.
- Form gallery kini mendukung 2 mode sumber gambar:
  - URL gambar (`image_url`)
  - Upload file (`image_file`)
- Saat update/hapus, file lokal lama dibersihkan otomatis jika berasal dari `/storage/...`.
- Loading state aktif di submit/delete.

5. Admin About Us (`/admin/aboutus`)
- Sebelumnya berbasis state lokal/hardcoded, sekarang full database.
- Mendukung dua section data sesuai tampilan tab:
  - `general` (Profil Umum)
  - `structure` (Struktur Lembaga)
- CRUD backend aktif.
- Frontend modal add/edit/delete sudah tersambung endpoint JSON + loading state.

6. Admin Image Slider (`/admin/imageslider`)
- Sebelumnya berbasis state lokal/hardcoded, sekarang full database.
- CRUD backend aktif.
- Mendukung 2 mode media banner:
  - URL gambar (`image_url`)
  - Upload file (`image_file`)
- Loading state aktif untuk submit/delete.

7. Data Source AdminUiController
- Method halaman admin kini memetakan data database ke shape data yang dipakai Blade/JS pada:
  - Campaign
  - Messages
  - Focus Areas
  - Gallery
  - About Us
  - Image Slider

## 2. Endpoint yang Ditambahkan/Diaktifkan

### Campaign
- `GET /admin/campaign`
- `POST /admin/campaign`
- `PUT /admin/campaign/{campaign}`
- `DELETE /admin/campaign/{campaign}`

### Messages
- `GET /admin/messages`
- `POST /admin/messages`
- `PUT /admin/messages/{message}`
- `DELETE /admin/messages/{message}`

### Focus Areas
- `GET /admin/focusareas`
- `POST /admin/focusareas`
- `PUT /admin/focusareas/{focusArea}`
- `DELETE /admin/focusareas/{focusArea}`

### Gallery
- `GET /admin/gallery`
- `POST /admin/gallery`
- `PUT /admin/gallery/{galleryItem}`
- `DELETE /admin/gallery/{galleryItem}`

### About Us
- `GET /admin/aboutus`
- `POST /admin/aboutus`
- `PUT /admin/aboutus/{aboutUsItem}`
- `DELETE /admin/aboutus/{aboutUsItem}`

### Image Slider
- `GET /admin/imageslider`
- `POST /admin/imageslider`
- `PUT /admin/imageslider/{imageSlider}`
- `DELETE /admin/imageslider/{imageSlider}`

## 3. File Baru yang Dibuat

### Model
- `app/Models/Campaign.php`
- `app/Models/Message.php`
- `app/Models/AboutUsItem.php`
- `app/Models/ImageSlider.php`

### Controller
- `app/Http/Controllers/Admin/CampaignController.php`
- `app/Http/Controllers/Admin/MessageController.php`
- `app/Http/Controllers/Admin/GalleryController.php`
- `app/Http/Controllers/Admin/AboutUsController.php`
- `app/Http/Controllers/Admin/ImageSliderController.php`

### Migration
- `database/migrations/2026_04_14_000015_create_campaigns_table.php`
- `database/migrations/2026_04_14_000016_create_messages_table.php`
- `database/migrations/2026_04_14_000017_add_activity_date_to_gallery_items_table.php`
- `database/migrations/2026_04_14_000018_create_about_us_items_table.php`
- `database/migrations/2026_04_14_000019_create_image_sliders_table.php`

## 4. File Existing yang Diubah

- `app/Http/Controllers/Admin/AdminUiController.php`
- `app/Http/Controllers/Admin/FocusAreaController.php`
- `app/Models/GalleryItem.php`
- `routes/web.php`
- `resources/views/admin/campaign.blade.php`
- `resources/views/admin/messages.blade.php`
- `resources/views/admin/focusareas.blade.php`
- `resources/views/admin/gallery.blade.php`
- `resources/views/admin/aboutus.blade.php`
- `resources/views/admin/imageslider.blade.php`

## 5. File yang Dihapus (Refactor Sesuai Request)

- `app/Http/Controllers/Admin/FocusAreaCrudController.php`

## 6. Catatan Teknis Penting

1. Untuk request update yang memakai upload file, frontend memakai `FormData` dengan method spoofing (`POST` + `_method=PUT`) agar parsing file stabil di Laravel.
2. Jalankan `php artisan storage:link` bila belum, agar file upload di disk `public` bisa diakses browser.
3. Banyak file di `storage/framework/views` yang muncul saat testing/migrate adalah generated cache Blade, bukan source utama fitur.

## 7. Validasi yang Sudah Dilakukan

- `php artisan migrate` -> sukses (termasuk migration about us dan image slider).
- `php artisan test --testsuite=Feature` -> lulus (18 tests, 38 assertions).
- `php artisan route:list --path=admin/aboutus`
- `php artisan route:list --path=admin/imageslider`
- `php artisan route:list --path=admin/gallery`
