<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageSliderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:500', 'required_without:image_file'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096', 'required_without:image_url'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slider = ImageSlider::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $this->resolveImageValue($request),
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Banner slider berhasil ditambahkan.',
            'data' => $slider,
        ], 201);
    }

    public function update(Request $request, ImageSlider $imageSlider): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $oldImage = $imageSlider->image_url;
        $newImage = $this->resolveImageValue($request, $imageSlider->image_url);

        if ($oldImage !== $newImage) {
            $this->deleteStoredImageIfNeeded($oldImage);
        }

        $imageSlider->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $newImage,
            'sort_order' => $validated['sort_order'] ?? $imageSlider->sort_order,
        ]);

        return response()->json([
            'message' => 'Banner slider berhasil diperbarui.',
            'data' => $imageSlider->fresh(),
        ]);
    }

    public function destroy(ImageSlider $imageSlider): JsonResponse
    {
        $this->deleteStoredImageIfNeeded($imageSlider->image_url);
        $imageSlider->delete();

        return response()->json([
            'message' => 'Banner slider berhasil dihapus.',
        ]);
    }

    private function resolveImageValue(Request $request, ?string $currentImage = null): ?string
    {
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('image-sliders', 'public');

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