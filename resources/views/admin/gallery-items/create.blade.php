<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto p-4">
    <div class="bg-white border p-4">
        <h1 class="text-2xl font-bold mb-4">Tambah Item Gallery</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 p-3">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.gallery-items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf

            <div>
                <label class="block text-sm">Judul *</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border p-2" required>
            </div>

            <div>
                <label class="block text-sm">Type *</label>
                <select name="type" class="w-full border p-2" required>
                    <option value="image" {{ old('type') === 'image' ? 'selected' : '' }}>image</option>
                    <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>video</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Type image: isi image_url atau image_file. Type video: isi video_url.</p>
            </div>

            <div>
                <label class="block text-sm">Image URL (untuk type=image)</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}" class="w-full border p-2" placeholder="https://...">
            </div>

            <div>
                <label class="block text-sm">Image File (untuk type=image)</label>
                <input type="file" name="image_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
            </div>

            <div>
                <label class="block text-sm">Video URL (untuk type=video)</label>
                <input type="url" name="video_url" value="{{ old('video_url') }}" class="w-full border p-2" placeholder="https://www.youtube.com/embed/...">
            </div>

            <div>
                <label class="block text-sm">Thumbnail URL (opsional)</label>
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" class="w-full border p-2" placeholder="https://...">
            </div>

            <div>
                <label class="block text-sm">Thumbnail File (opsional)</label>
                <input type="file" name="thumbnail_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
            </div>

            <div>
                <label class="block text-sm">Caption</label>
                <textarea name="caption" rows="3" class="w-full border p-2">{{ old('caption') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-sm">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" class="w-full border p-2">
                </div>
                <div>
                    <label class="block text-sm">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full border p-2">
                </div>
                <div class="flex flex-col gap-2 mt-6">
                    <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}> Featured</label>
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}> Aktif</label>
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-black text-white px-4 py-2">Simpan</button>
                <a href="{{ route('admin.gallery-items.index') }}" class="bg-gray-200 px-4 py-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
