<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FocusArea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FocusAreaController extends Controller
{
    public function index(): View
    {
        $focusAreas = FocusArea::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('admin.focus-areas.index', compact('focusAreas'));
    }

    public function create(): View
    {
        return view('admin.focus-areas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'icon' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->resolveImageValue($request);

        unset($validated['image_url'], $validated['image_file']);

        FocusArea::create($validated);

        return redirect()->route('admin.focus-areas.index')->with('success', 'Focus area berhasil ditambahkan.');
    }

    public function edit(FocusArea $focusArea): View
    {
        return view('admin.focus-areas.edit', compact('focusArea'));
    }

    public function update(Request $request, FocusArea $focusArea): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'icon' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');
        $removeImage = $request->boolean('remove_image');

        $oldImage = $focusArea->image;
        $newImage = $this->resolveImageValue($request, $focusArea->image);

        if ($removeImage) {
            $newImage = null;
        }

        if ($oldImage !== $newImage) {
            $this->deleteStoredImageIfNeeded($oldImage);
        }

        $validated['image'] = $newImage;

        unset($validated['image_url'], $validated['image_file'], $validated['remove_image']);

        $focusArea->update($validated);

        return redirect()->route('admin.focus-areas.index')->with('success', 'Focus area berhasil diperbarui.');
    }

    public function destroy(FocusArea $focusArea): RedirectResponse
    {
        $this->deleteStoredImageIfNeeded($focusArea->image);
        $focusArea->delete();

        return redirect()->route('admin.focus-areas.index')->with('success', 'Focus area berhasil dihapus.');
    }

    private function resolveImageValue(Request $request, ?string $currentImage = null): ?string
    {
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('focus-areas', 'public');

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
