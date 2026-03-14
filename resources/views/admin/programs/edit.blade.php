<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-4">
        <div class="bg-white border p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Program #{{ $program->id }}</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-300 text-red-800 p-3">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm">Judul *</label>
                    <input type="text" name="title" value="{{ old('title', $program->title) }}" class="w-full border p-2" required>
                </div>

                <div>
                    <label class="block text-sm">Deskripsi Singkat *</label>
                    <textarea name="short_description" class="w-full border p-2" rows="3" required>{{ old('short_description', $program->short_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm">Deskripsi Lengkap</label>
                    <textarea name="full_description" class="w-full border p-2" rows="4">{{ old('full_description', $program->full_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm">Link Gambar (opsional)</label>
                    <input type="url" name="image_url" value="{{ old('image_url', str_starts_with((string) $program->image, '/storage/') ? '' : $program->image) }}" class="w-full border p-2" placeholder="https://...">
                    <p class="text-xs text-gray-500 mt-1">Isi jika ingin pakai link foto dari internet.</p>
                </div>

                <div>
                    <label class="block text-sm">Upload File Gambar Baru (opsional)</label>
                    <input type="file" name="image_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB. Jika diisi, file upload diprioritaskan.</p>
                </div>

                @if($program->image)
                    <div class="border p-3 bg-gray-50 text-sm">
                        <p class="font-semibold">Gambar saat ini:</p>
                        <a href="{{ $program->image }}" target="_blank" class="text-blue-600 underline break-all">{{ $program->image }}</a>
                        <div class="mt-2 flex items-center gap-2">
                            <input type="checkbox" id="remove_image" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}>
                            <label for="remove_image">Hapus gambar saat ini</label>
                        </div>
                    </div>
                @endif

                <div>
                    <label class="block text-sm">Nama Ikon (fallback)</label>
                    <input type="text" name="icon" value="{{ old('icon', $program->icon) }}" class="w-full border p-2" placeholder="misal: hand-heart">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $program->category) }}" class="w-full border p-2">
                    </div>
                    <div>
                        <label class="block text-sm">Target Audience</label>
                        <input type="text" name="target_audience" value="{{ old('target_audience', $program->target_audience) }}" class="w-full border p-2">
                    </div>
                    <div>
                        <label class="block text-sm">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $program->location) }}" class="w-full border p-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm">Urutan</label>
                        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $program->sort_order) }}" class="w-full border p-2">
                    </div>
                    <div class="flex items-center gap-2 mt-6">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
                        <label for="is_active">Aktifkan program</label>
                    </div>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="submit" class="bg-black text-white px-4 py-2">Update</button>
                    <a href="{{ route('admin.programs.index') }}" class="bg-gray-200 px-4 py-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
