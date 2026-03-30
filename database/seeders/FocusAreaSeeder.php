<?php

namespace Database\Seeders;

use App\Models\FocusArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FocusAreaSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Ketahanan Pangan',
                'description' => 'Meningkatkan akses pangan bergizi untuk keluarga rentan di wilayah binaan.',
                'icon' => 'shield-check',
                'color' => 'green-600',
                'sort_order' => 1,
                'is_active' => true,
                'file' => 'seed/focus-areas/ketahanan-pangan.svg',
                'bg' => '#16a34a',
            ],
            [
                'title' => 'Pendidikan Komunitas',
                'description' => 'Program edukasi literasi, keterampilan, dan penguatan kapasitas warga.',
                'icon' => 'book-open',
                'color' => 'blue-600',
                'sort_order' => 2,
                'is_active' => true,
                'file' => 'seed/focus-areas/pendidikan-komunitas.svg',
                'bg' => '#2563eb',
            ],
            [
                'title' => 'Pemberdayaan Ekonomi',
                'description' => 'Pendampingan usaha mikro agar masyarakat lebih mandiri secara finansial.',
                'icon' => 'briefcase',
                'color' => 'orange-600',
                'sort_order' => 3,
                'is_active' => true,
                'file' => 'seed/focus-areas/pemberdayaan-ekonomi.svg',
                'bg' => '#ea580c',
            ],
        ];

        foreach ($items as $item) {
            Storage::disk('public')->put($item['file'], $this->svgContent($item['title'], $item['bg']));

            FocusArea::updateOrCreate(
                ['title' => $item['title']],
                [
                    'description' => $item['description'],
                    'image' => Storage::url($item['file']),
                    'icon' => $item['icon'],
                    'color' => $item['color'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => $item['is_active'],
                ]
            );
        }
    }

    private function svgContent(string $title, string $bgColor): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="700" viewBox="0 0 1200 700">'
            . '<rect width="1200" height="700" fill="' . $bgColor . '"/>'
            . '<text x="50%" y="50%" fill="white" dominant-baseline="middle" text-anchor="middle" font-size="56" font-family="Arial, sans-serif">'
            . htmlspecialchars($title, ENT_QUOTES, 'UTF-8')
            . '</text>'
            . '</svg>';
    }
}
