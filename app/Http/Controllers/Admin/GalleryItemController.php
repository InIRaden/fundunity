<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        $galleryItems = GalleryItem::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('admin.gallery-items.index', compact('galleryItems'));
    }

    public function create(): View
    {
        return view('admin.gallery-items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'in:image,video'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
        ]);

        $validator->after(function ($validator) use ($request): void {
            if ($request->input('type') === 'image' && ! $request->hasFile('image_file') && ! $request->filled('image_url')) {
                $validator->errors()->add('image_url', 'Isi image URL atau upload image file untuk type image.');
            }

            if ($request->input('type') === 'video' && ! $request->filled('video_url')) {
                $validator->errors()->add('video_url', 'Video URL wajib diisi untuk type video.');
            }
        });

        $validator->validate();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'type' => ['required', 'in:image,video'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'thumbnail_url' => ['nullable', 'url', 'max:500'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'caption' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $validated['url'] = $this->resolveMainUrl($request);
        $validated['thumbnail'] = $this->resolveThumbnail($request);

        unset(
            $validated['image_url'],
            $validated['image_file'],
            $validated['video_url'],
            $validated['thumbnail_url'],
            $validated['thumbnail_file']
        );

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('admin.gallery-items.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'in:image,video'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
        ]);

        $validator->after(function ($validator) use ($request, $galleryItem): void {
            if (
                $request->input('type') === 'image'
                && ! $request->hasFile('image_file')
                && ! $request->filled('image_url')
                && ($galleryItem->type !== 'image' || ! $galleryItem->url)
            ) {
                $validator->errors()->add('image_url', 'Isi image URL atau upload image file untuk type image.');
            }

            if (
                $request->input('type') === 'video'
                && ! $request->filled('video_url')
                && ($galleryItem->type !== 'video' || ! $galleryItem->url)
            ) {
                $validator->errors()->add('video_url', 'Video URL wajib diisi untuk type video.');
            }
        });

        $validator->validate();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'type' => ['required', 'in:image,video'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'thumbnail_url' => ['nullable', 'url', 'max:500'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_thumbnail' => ['nullable', 'boolean'],
            'caption' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $oldUrl = $galleryItem->url;
        $newUrl = $this->resolveMainUrl($request, $galleryItem->url);

        $oldThumbnail = $galleryItem->thumbnail;
        $newThumbnail = $this->resolveThumbnail($request, $galleryItem->thumbnail);

        if ($request->boolean('remove_thumbnail')) {
            $newThumbnail = null;
        }

        if ($oldUrl !== $newUrl) {
            $this->deleteStoredFileIfNeeded($oldUrl);
        }

        if ($oldThumbnail !== $newThumbnail) {
            $this->deleteStoredFileIfNeeded($oldThumbnail);
        }

        $validated['url'] = $newUrl;
        $validated['thumbnail'] = $newThumbnail;

        unset(
            $validated['image_url'],
            $validated['image_file'],
            $validated['video_url'],
            $validated['thumbnail_url'],
            $validated['thumbnail_file'],
            $validated['remove_thumbnail']
        );

        $galleryItem->update($validated);

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $this->deleteStoredFileIfNeeded($galleryItem->url);
        $this->deleteStoredFileIfNeeded($galleryItem->thumbnail);

        $galleryItem->delete();

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil dihapus.');
    }

    private function resolveMainUrl(Request $request, ?string $currentUrl = null): ?string
    {
        if ($request->input('type') === 'image') {
            if ($request->hasFile('image_file')) {
                $path = $request->file('image_file')->store('gallery', 'public');

                return Storage::url($path);
            }

            if ($request->filled('image_url')) {
                return $request->string('image_url')->toString();
            }
        }

        if ($request->input('type') === 'video' && $request->filled('video_url')) {
            return $request->string('video_url')->toString();
        }

        return $currentUrl;
    }

    private function resolveThumbnail(Request $request, ?string $currentThumbnail = null): ?string
    {
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('gallery/thumbnails', 'public');

            return Storage::url($path);
        }

        if ($request->filled('thumbnail_url')) {
            return $request->string('thumbnail_url')->toString();
        }

        return $currentThumbnail;
    }

    private function deleteStoredFileIfNeeded(?string $path): void
    {
        if (! $path || ! Str::startsWith($path, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($path, '/storage/'));
    }
}
