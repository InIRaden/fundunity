<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['nullable', 'string', 'max:100'],
            'activity_date' => ['nullable', 'date'],
            'image_url' => ['nullable', 'url', 'max:500', 'required_without:image_file'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096', 'required_without:image_url'],
        ]);

        $imageValue = $this->resolveImageValue($request);

        $item = GalleryItem::create([
            'title' => $validated['title'],
            'type' => 'image',
            'url' => $imageValue,
            'thumbnail' => $imageValue,
            'caption' => null,
            'category' => $validated['category'] ?? null,
            'activity_date' => $validated['activity_date'] ?? null,
            'sort_order' => 0,
            'is_featured' => false,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Item galeri berhasil ditambahkan.',
            'data' => $item,
        ], 201);
    }

    public function update(Request $request, GalleryItem $galleryItem): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['nullable', 'string', 'max:100'],
            'activity_date' => ['nullable', 'date'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $oldImage = $galleryItem->url;
        $newImage = $this->resolveImageValue($request, $galleryItem->url);

        if ($oldImage !== $newImage) {
            $this->deleteStoredImageIfNeeded($oldImage);
        }

        $galleryItem->update([
            'title' => $validated['title'],
            'type' => 'image',
            'url' => $newImage,
            'thumbnail' => $newImage,
            'category' => $validated['category'] ?? null,
            'activity_date' => $validated['activity_date'] ?? null,
        ]);

        return response()->json([
            'message' => 'Item galeri berhasil diperbarui.',
            'data' => $galleryItem->fresh(),
        ]);
    }

    public function destroy(GalleryItem $galleryItem): JsonResponse
    {
        $this->deleteStoredImageIfNeeded($galleryItem->url);
        $galleryItem->delete();

        return response()->json([
            'message' => 'Item galeri berhasil dihapus.',
        ]);
    }

    private function resolveImageValue(Request $request, ?string $currentImage = null): ?string
    {
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('gallery-items', 'public');

            return Storage::url($path);
        }

        if ($request->filled('image_url')) {
            return $request->string('image_url')->toString();
        }

        return $currentImage;
    }

    private function deleteStoredImageIfNeeded(?string $imagePath): void
    {
        if (! $imagePath || ! Str::startsWith($imagePath, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($imagePath, '/storage/'));
    }
}
