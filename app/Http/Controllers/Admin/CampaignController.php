<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'target'      => ['required', 'integer', 'min:1'],
            'deadline'    => ['required', 'date'],
            'category'    => ['required', 'string', 'max:100'],
            'status'      => ['required', 'in:draft,aktif,selesai'],
            'collected'   => ['nullable', 'integer', 'min:0'],
            'image_url'   => ['nullable', 'url', 'max:500'],
            'image_file'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $validated['collected'] = $validated['collected'] ?? 0;
        $validated['image']     = $this->resolveImage($request);

        unset($validated['image_url'], $validated['image_file']);

        $campaign = Campaign::create($validated);

        return response()->json([
            'message' => 'Campaign berhasil ditambahkan.',
            'data'    => $campaign,
        ], 201);
    }

    public function update(Request $request, Campaign $campaign): JsonResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:200'],
            'description'  => ['required', 'string'],
            'target'       => ['required', 'integer', 'min:1'],
            'deadline'     => ['required', 'date'],
            'category'     => ['required', 'string', 'max:100'],
            'status'       => ['required', 'in:draft,aktif,selesai'],
            'collected'    => ['nullable', 'integer', 'min:0'],
            'image_url'    => ['nullable', 'url', 'max:500'],
            'image_file'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        if (! array_key_exists('collected', $validated)) {
            $validated['collected'] = $campaign->collected;
        }

        $oldImage = $campaign->image;
        $newImage = $request->boolean('remove_image') ? null : $this->resolveImage($request, $campaign->image);

        if ($oldImage !== $newImage) {
            $this->deleteStoredImage($oldImage);
        }

        $validated['image'] = $newImage;
        unset($validated['image_url'], $validated['image_file'], $validated['remove_image']);

        $campaign->update($validated);

        return response()->json([
            'message' => 'Campaign berhasil diperbarui.',
            'data'    => $campaign->fresh(),
        ]);
    }

    public function destroy(Campaign $campaign): JsonResponse
    {
        $this->deleteStoredImage($campaign->image);
        $campaign->delete();

        return response()->json([
            'message' => 'Campaign berhasil dihapus.',
        ]);
    }

    private function resolveImage(Request $request, ?string $current = null): ?string
    {
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('campaigns', 'public');
            return Storage::url($path);
        }

        if ($request->filled('image_url')) {
            return $request->string('image_url')->toString();
        }

        return $current;
    }

    private function deleteStoredImage(?string $path): void
    {
        if (! $path || ! Str::startsWith($path, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($path, '/storage/'));
    }
}
