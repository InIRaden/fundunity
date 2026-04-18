<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'image_url' => ['required', 'url', 'max:500'],
            'website_url' => ['nullable', 'url', 'max:500'],
            'type' => ['nullable', 'in:corporate,ngo,government,other'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $partner = Partner::create([
            'name' => $validated['name'],
            'logo' => $validated['image_url'],
            'website_url' => $validated['website_url'] ?? null,
            'type' => $validated['type'] ?? 'other',
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Mitra berhasil ditambahkan.',
            'data' => $this->transform($partner),
        ], 201);
    }

    public function update(Request $request, Partner $partner): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'image_url' => ['required', 'url', 'max:500'],
            'website_url' => ['nullable', 'url', 'max:500'],
            'type' => ['nullable', 'in:corporate,ngo,government,other'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $partner->update([
            'name' => $validated['name'],
            'logo' => $validated['image_url'],
            'website_url' => $validated['website_url'] ?? $partner->website_url,
            'type' => $validated['type'] ?? $partner->type,
            'description' => $validated['description'] ?? $partner->description,
            'sort_order' => $validated['sort_order'] ?? $partner->sort_order,
        ]);

        return response()->json([
            'message' => 'Mitra berhasil diperbarui.',
            'data' => $this->transform($partner->fresh()),
        ]);
    }

    public function destroy(Partner $partner): JsonResponse
    {
        $partner->delete();

        return response()->json([
            'message' => 'Mitra berhasil dihapus.',
        ]);
    }

    private function transform(Partner $partner): array
    {
        return [
            'id' => $partner->id,
            'name' => $partner->name,
            'imageUrl' => $partner->logo,
            'websiteUrl' => $partner->website_url,
            'type' => $partner->type,
            'description' => $partner->description,
            'sort_order' => $partner->sort_order,
        ];
    }
}
