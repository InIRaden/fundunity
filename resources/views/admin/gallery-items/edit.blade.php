<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto p-4">
    <div class="bg-white border p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Item Gallery #{{ $galleryItem->id }}</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 p-3">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.gallery-items.update', $galleryItem) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $galleryItem->title) }}" class="w-full border p-2" required>
            </div>

            <div>
                <label class="block text-sm">Type *</label>
                <select name="type" class="w-full border p-2" required>
                    <option value="image" {{ old('type', $galleryItem->type) === 'image' ? 'selected' : '' }}>image</option>
                    <option value="video" {{ old('type', $galleryItem->type) === 'video' ? 'selected' : '' }}>video</option>
                </select>
            </div>

            <div>
                <label class="block text-sm">Image URL (untuk type=image)</label>
                <input type="url" name="image_url" value="{{ old('image_url', $galleryItem->type === 'image' && !str_starts_with((string) $galleryItem->url, '/storage/') ? $galleryItem->url : '') }}" class="w-full border p-2" placeholder="https://...">
            </div>

            <div>
                <label class="block text-sm">Image File (untuk type=image)</label>
                <input type="file" name="image_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
            </div>

            <div>
                <label class="block text-sm">Video URL (untuk type=video)</label>
                <input type="url" name="video_url" value="{{ old('video_url', $galleryItem->type === 'video' ? $galleryItem->url : '') }}" class="w-full border p-2" placeholder="https://www.youtube.com/embed/...">
            </div>

            <div>
                <label class="block text-sm">Thumbnail URL (opsional)</label>
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url', $galleryItem->thumbnail && !str_starts_with((string) $galleryItem->thumbnail, '/storage/') ? $galleryItem->thumbnail : '') }}" class="w-full border p-2" placeholder="https://...">
            </div>

            <div>
                <label class="block text-sm">Thumbnail File (opsional)</label>
                <input type="file" name="thumbnail_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
            </div>

            @if($galleryItem->url)
                <div class="border p-3 bg-gray-50 text-sm">
                    <p class="font-semibold">URL utama saat ini:</p>
                    <a href="{{ $galleryItem->url }}" target="_blank" class="text-blue-600 underline break-all">{{ $galleryItem->url }}</a>
                </div>
            @endif

            @if($galleryItem->thumbnail)
                <div class="border p-3 bg-gray-50 text-sm">
                    <p class="font-semibold">Thumbnail saat ini:</p>
                    <a href="{{ $galleryItem->thumbnail }}" target="_blank" class="text-blue-600 underline break-all">{{ $galleryItem->thumbnail }}</a>
                    <div class="mt-2">
                        <label><input type="checkbox" name="remove_thumbnail" value="1" {{ old('remove_thumbnail') ? 'checked' : '' }}> Hapus thumbnail</label>
                    </div>
                </div>
            @endif

            <div>
                <label class="block text-sm">Caption</label>
                <textarea name="caption" rows="3" class="w-full border p-2">{{ old('caption', $galleryItem->caption) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-sm">Category</label>
                    <input type="text" name="category" value="{{ old('category', $galleryItem->category) }}" class="w-full border p-2">
                </div>
                <div>
                    <label class="block text-sm">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order) }}" class="w-full border p-2">
                </div>
                <div class="flex flex-col gap-2 mt-6">
                    <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $galleryItem->is_featured) ? 'checked' : '' }}> Featured</label>
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $galleryItem->is_active) ? 'checked' : '' }}> Aktif</label>
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-black text-white px-4 py-2">Update</button>
                <a href="{{ route('admin.gallery-items.index') }}" class="bg-gray-200 px-4 py-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
