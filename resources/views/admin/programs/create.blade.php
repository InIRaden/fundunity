<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-4">
        <div class="bg-white border p-4">
            <h1 class="text-2xl font-bold mb-4">Tambah Program</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-300 text-red-800 p-3">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf

                <div>
                    <label class="block text-sm">Judul *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full border p-2" required>
                </div>

                <div>
                    <label class="block text-sm">Deskripsi Singkat *</label>
                    <textarea name="short_description" class="w-full border p-2" rows="3" required>{{ old('short_description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm">Deskripsi Lengkap</label>
                    <textarea name="full_description" class="w-full border p-2" rows="4">{{ old('full_description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm">Link Gambar (opsional)</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" class="w-full border p-2" placeholder="https://...">
                    <p class="text-xs text-gray-500 mt-1">Bisa isi link foto dari internet.</p>
                </div>

                <div>
                    <label class="block text-sm">Upload File Gambar (opsional)</label>
                    <input type="file" name="image_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB. Jika diisi, file upload diprioritaskan.</p>
                </div>

                <div>
                    <label class="block text-sm">Nama Ikon (fallback)</label>
                    <input type="text" name="icon" value="{{ old('icon') }}" class="w-full border p-2" placeholder="misal: book-open">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm">Kategori</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="w-full border p-2">
                    </div>
                    <div>
                        <label class="block text-sm">Target Audience</label>
                        <input type="text" name="target_audience" value="{{ old('target_audience') }}" class="w-full border p-2">
                    </div>
                    <div>
                        <label class="block text-sm">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location') }}" class="w-full border p-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm">Urutan</label>
                        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full border p-2">
                    </div>
                    <div class="flex items-center gap-2 mt-6">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Aktifkan program</label>
                    </div>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="submit" class="bg-black text-white px-4 py-2">Simpan</button>
                    <a href="{{ route('admin.programs.index') }}" class="bg-gray-200 px-4 py-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
