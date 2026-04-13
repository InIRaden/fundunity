<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'section' => ['required', 'in:general,structure'],
            'nama' => ['required', 'string', 'max:200'],
            'jabatan' => ['nullable', 'string', 'max:200', 'required_if:section,structure'],
            'description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
        ]);

        $item = AboutUsItem::create([
            'section' => $validated['section'],
            'title' => $validated['nama'],
            'position' => $validated['section'] === 'structure' ? ($validated['jabatan'] ?? null) : null,
            'description' => $validated['description'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'sort_order' => 0,
            'is_active' => true,
        ]);

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
            'image_url' => ['nullable', 'url', 'max:500'],
        ]);

        $aboutUsItem->update([
            'section' => $validated['section'],
            'title' => $validated['nama'],
            'position' => $validated['section'] === 'structure' ? ($validated['jabatan'] ?? null) : null,
            'description' => $validated['description'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
        ]);

        return response()->json([
            'message' => 'Data profil berhasil diperbarui.',
            'data' => $this->transform($aboutUsItem->fresh()),
        ]);
    }

    public function destroy(AboutUsItem $aboutUsItem): JsonResponse
    {
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