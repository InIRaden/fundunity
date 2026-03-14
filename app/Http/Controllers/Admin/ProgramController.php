<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = Program::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('admin.programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.programs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'short_description' => ['required', 'string', 'max:500'],
            'full_description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'icon' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'target_audience' => ['nullable', 'string', 'max:200'],
            'location' => ['nullable', 'string', 'max:200'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->resolveImageValue($request);

        unset($validated['image_url'], $validated['image_file']);

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program): View
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'short_description' => ['required', 'string', 'max:500'],
            'full_description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'icon' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'target_audience' => ['nullable', 'string', 'max:200'],
            'location' => ['nullable', 'string', 'max:200'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['remove_image'] = $request->boolean('remove_image');

        $oldImage = $program->image;
        $newImage = $this->resolveImageValue($request, $program->image);

        if ($validated['remove_image']) {
            $newImage = null;
        }

        if ($oldImage !== $newImage) {
            $this->deleteStoredImageIfNeeded($oldImage);
        }

        $validated['image'] = $newImage;

        unset($validated['image_url'], $validated['image_file'], $validated['remove_image']);

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        $this->deleteStoredImageIfNeeded($program->image);
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus.');
    }

    private function resolveImageValue(Request $request, ?string $currentImage = null): ?string
    {
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('programs', 'public');

            return Storage::url($path);
        }

        if ($request->filled('image_url')) {
            return $request->string('image_url')->toString();
        }

        return $currentImage;
    }

    private function deleteStoredImageIfNeeded(?string $imagePath): void
    {
        if (! $imagePath) {
            return;
        }

        if (! Str::startsWith($imagePath, '/storage/')) {
            return;
        }

        $diskPath = Str::after($imagePath, '/storage/');
        Storage::disk('public')->delete($diskPath);
    }
}
