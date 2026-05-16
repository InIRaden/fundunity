<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'section' => ['required', 'in:general,structure'],
            'nama' => ['required', 'string', 'max:200'],
            'jabatan' => ['nullable', 'string', 'max:200', 'required_if:section,structure'],
            'description' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('aboutus', 'public');
            $imagePath = Storage::url($path);
        }

        $item = AboutUsItem::create([
            'section' => $validated['section'],
            'title' => $validated['nama'],
            'position' => $validated['section'] === 'structure' ? ($validated['jabatan'] ?? null) : null,
            'description' => $validated['description'] ?? null,
            'image_url' => $imagePath,
            'sort_order' => 0,
            'is_active' => true,
        ]);

        if ($validated['section'] === 'general' && $imagePath) {
            \App\Models\AboutUsItem::where('section', 'general')->update(['image_url' => $imagePath]);
        }

        return response()->json([
            'message' => 'Data profil berhasil ditambahkan.',
            'data' => $this->transform($item),
        ], 201);
    }

    public function update(Request $request, AboutUsItem $aboutUsItem): JsonResponse
    {
        $validated = $request->validate([
            'section' => ['required', 'in:general,structure'],
            'nama' => ['required', 'string', 'max:200'],
            'jabatan' => ['nullable', 'string', 'max:200', 'required_if:section,structure'],
            'description' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = $aboutUsItem->image_url;
        if ($request->hasFile('image_file')) {
            if ($imagePath && Str::startsWith($imagePath, '/storage/')) {
                $diskPath = Str::after($imagePath, '/storage/');
                Storage::disk('public')->delete($diskPath);
            }
            
            $path = $request->file('image_file')->store('aboutus', 'public');
            $imagePath = Storage::url($path);
        }

        $aboutUsItem->update([
            'section' => $validated['section'],
            'title' => $validated['nama'],
            'position' => $validated['section'] === 'structure' ? ($validated['jabatan'] ?? null) : null,
            'description' => $validated['description'] ?? null,
            'image_url' => $imagePath,
        ]);

        if ($validated['section'] === 'general' && $request->hasFile('image_file')) {
            \App\Models\AboutUsItem::where('section', 'general')->update(['image_url' => $imagePath]);
        }

        return response()->json([
            'message' => 'Data profil berhasil diperbarui.',
            'data' => $this->transform($aboutUsItem->fresh()),
        ]);
    }

    public function destroy(AboutUsItem $aboutUsItem): JsonResponse
    {
        $imagePath = $aboutUsItem->image_url;
        if ($imagePath && Str::startsWith($imagePath, '/storage/')) {
            $diskPath = Str::after($imagePath, '/storage/');
            Storage::disk('public')->delete($diskPath);
        }

        $aboutUsItem->delete();

        return response()->json([
            'message' => 'Data profil berhasil dihapus.',
        ]);
    }

    private function transform(AboutUsItem $item): array
    {
        return [
            'id' => $item->id,
            'section' => $item->section,
            'nama' => $item->title,
            'jabatan' => $item->position,
            'description' => $item->description,
            'imageUrl' => $item->image_url,
        ];
    }
}