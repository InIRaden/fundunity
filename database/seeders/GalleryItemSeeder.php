<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $image1 = 'seed/gallery/distribusi-pangan.svg';
        $image2 = 'seed/gallery/pelatihan-relawan.svg';
        $thumb = 'seed/gallery/thumbnails/video-kegiatan.svg';

        Storage::disk('public')->put($image1, $this->svgContent('Distribusi Pangan', '#0f766e'));
        Storage::disk('public')->put($image2, $this->svgContent('Pelatihan Relawan', '#7c3aed'));
        Storage::disk('public')->put($thumb, $this->svgContent('Video Kegiatan', '#1f2937'));

        $items = [
            [
                'title' => 'Distribusi Pangan Bulanan',
                'type' => 'image',
                'url' => Storage::url($image1),
                'thumbnail' => null,
                'caption' => 'Penyaluran paket pangan kepada keluarga binaan.',
                'category' => 'kegiatan',
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Relawan',
                'type' => 'image',
                'url' => Storage::url($image2),
                'thumbnail' => null,
                'caption' => 'Sesi pelatihan relawan untuk program lapangan.',
                'category' => 'dokumentasi',
                'sort_order' => 2,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Video Kegiatan Komunitas',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => Storage::url($thumb),
                'caption' => 'Ringkasan kegiatan komunitas terbaru.',
                'category' => 'video',
                'sort_order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }

    private function svgContent(string $title, string $bgColor): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="700" viewBox="0 0 1200 700">'
            . '<rect width="1200" height="700" fill="' . $bgColor . '"/>'
            . '<text x="50%" y="50%" fill="white" dominant-baseline="middle" text-anchor="middle" font-size="52" font-family="Arial, sans-serif">'
            . htmlspecialchars($title, ENT_QUOTES, 'UTF-8')
            . '</text>'
            . '</svg>';
    }
}
