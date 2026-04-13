<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'target' => ['required', 'integer', 'min:1'],
            'deadline' => ['required', 'date'],
            'category' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:draft,aktif,selesai'],
            'collected' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['collected'] = $validated['collected'] ?? 0;

        $campaign = Campaign::create($validated);

        return response()->json([
            'message' => 'Campaign berhasil ditambahkan.',
            'data' => $campaign,
        ], 201);
    }

    public function update(Request $request, Campaign $campaign): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'target' => ['required', 'integer', 'min:1'],
            'deadline' => ['required', 'date'],
            'category' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:draft,aktif,selesai'],
            'collected' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! array_key_exists('collected', $validated)) {
            $validated['collected'] = $campaign->collected;
        }

        $campaign->update($validated);

        return response()->json([
            'message' => 'Campaign berhasil diperbarui.',
            'data' => $campaign->fresh(),
        ]);
    }

    public function destroy(Campaign $campaign): JsonResponse
    {
        $campaign->delete();

        return response()->json([
            'message' => 'Campaign berhasil dihapus.',
        ]);
    }
}
