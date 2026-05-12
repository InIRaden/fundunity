<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'jabatan' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('members', 'public');
            $imagePath = Storage::url($path);
        }

        $member = TeamMember::create([
            'name' => $validated['nama'],
            'position' => $validated['jabatan'],
            'bio' => $validated['description'] ?? null,
            'photo' => $imagePath,
            'sort_order' => 0,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Anggota berhasil ditambahkan.',
            'data' => $this->transform($member),
        ], 201);
    }

    public function update(Request $request, TeamMember $teamMember): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'jabatan' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = $teamMember->photo;
        if ($request->hasFile('image_file')) {
            // Delete old image if it's a local storage file
            if ($imagePath && Str::startsWith($imagePath, '/storage/')) {
                $diskPath = Str::after($imagePath, '/storage/');
                Storage::disk('public')->delete($diskPath);
            }
            
            $path = $request->file('image_file')->store('members', 'public');
            $imagePath = Storage::url($path);
        }

        $teamMember->update([
            'name' => $validated['nama'],
            'position' => $validated['jabatan'],
            'bio' => $validated['description'] ?? null,
            'photo' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Data anggota berhasil diperbarui.',
            'data' => $this->transform($teamMember->fresh()),
        ]);
    }

    public function destroy(TeamMember $teamMember): JsonResponse
    {
        $imagePath = $teamMember->photo;
        if ($imagePath && Str::startsWith($imagePath, '/storage/')) {
            $diskPath = Str::after($imagePath, '/storage/');
            Storage::disk('public')->delete($diskPath);
        }

        $teamMember->delete();

        return response()->json([
            'message' => 'Anggota berhasil dihapus.',
        ]);
    }

    private function transform(TeamMember $member): array
    {
        return [
            'id' => $member->id,
            'nama' => $member->name,
            'jabatan' => $member->position,
            'description' => $member->bio,
            'imageUrl' => $member->photo,
        ];
    }
}