<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FocusArea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FocusAreaController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);

        $focusArea = FocusArea::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? 'ph ph-target',
            'color' => $validated['color'] ?? null,
            'sort_order' => 0,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Fokus area berhasil ditambahkan.',
            'data' => $focusArea,
        ], 201);
    }

    public function update(Request $request, FocusArea $focusArea): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);

        $focusArea->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? $focusArea->icon,
            'color' => $validated['color'] ?? $focusArea->color,
        ]);

        return response()->json([
            'message' => 'Fokus area berhasil diperbarui.',
            'data' => $focusArea->fresh(),
        ]);
    }

    public function destroy(FocusArea $focusArea): JsonResponse
    {
        $focusArea->delete();

        return response()->json([
            'message' => 'Fokus area berhasil dihapus.',
        ]);
    }
}
