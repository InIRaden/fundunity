<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Gallery Items</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-6xl mx-auto p-4">
    <div class="bg-white border p-4 mb-4">
        <h1 class="text-2xl font-bold">Admin More Gallery</h1>
        <p class="text-sm text-gray-600">CRUD sederhana untuk halaman /moregallery</p>
        <div class="mt-3 flex gap-2 flex-wrap">
            <a href="{{ route('admin.gallery-items.create') }}" class="bg-black text-white px-3 py-2 text-sm">+ Tambah Item</a>
            <a href="{{ route('gallery') }}" class="bg-gray-200 px-3 py-2 text-sm">Lihat /moregallery</a>
            <a href="{{ route('admin.focus-areas.index') }}" class="bg-gray-200 px-3 py-2 text-sm">Ke Admin Focus</a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border text-left">ID</th>
                <th class="p-2 border text-left">Judul</th>
                <th class="p-2 border text-left">Type</th>
                <th class="p-2 border text-left">Featured</th>
                <th class="p-2 border text-left">Aktif</th>
                <th class="p-2 border text-left">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($galleryItems as $item)
                <tr>
                    <td class="p-2 border">{{ $item->id }}</td>
                    <td class="p-2 border">{{ $item->title }}</td>
                    <td class="p-2 border">{{ $item->type }}</td>
                    <td class="p-2 border">{{ $item->is_featured ? 'Ya' : 'Tidak' }}</td>
                    <td class="p-2 border">{{ $item->is_active ? 'Ya' : 'Tidak' }}</td>
                    <td class="p-2 border">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.gallery-items.edit', $item) }}" class="bg-yellow-200 px-2 py-1">Edit</a>
                            <form action="{{ route('admin.gallery-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus item galeri ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-200 px-2 py-1">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data galeri.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
