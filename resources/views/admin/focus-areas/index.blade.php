<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Focus Areas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-6xl mx-auto p-4">
    <div class="bg-white border p-4 mb-4">
        <h1 class="text-2xl font-bold">Admin Focus Areas</h1>
        <p class="text-sm text-gray-600">CRUD sederhana untuk halaman /focusareas</p>
        <div class="mt-3 flex gap-2 flex-wrap">
            <a href="{{ route('admin.focus-areas.create') }}" class="bg-black text-white px-3 py-2 text-sm">+ Tambah Focus Area</a>
            <a href="{{ route('focus-areas') }}" class="bg-gray-200 px-3 py-2 text-sm">Lihat /focusareas</a>
            <a href="{{ route('admin.gallery-items.index') }}" class="bg-gray-200 px-3 py-2 text-sm">Ke Admin Gallery</a>
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
                <th class="p-2 border text-left">Urutan</th>
                <th class="p-2 border text-left">Aktif</th>
                <th class="p-2 border text-left">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($focusAreas as $focusArea)
                <tr>
                    <td class="p-2 border">{{ $focusArea->id }}</td>
                    <td class="p-2 border">{{ $focusArea->title }}</td>
                    <td class="p-2 border">{{ $focusArea->sort_order }}</td>
                    <td class="p-2 border">{{ $focusArea->is_active ? 'Ya' : 'Tidak' }}</td>
                    <td class="p-2 border">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.focus-areas.edit', $focusArea) }}" class="bg-yellow-200 px-2 py-1">Edit</a>
                            <form action="{{ route('admin.focus-areas.destroy', $focusArea) }}" method="POST" onsubmit="return confirm('Hapus focus area ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-200 px-2 py-1">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data focus area.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
