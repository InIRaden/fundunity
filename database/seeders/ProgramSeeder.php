<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Distribusi Pangan',
                'short_description' => 'Menyediakan paket makanan bergizi untuk keluarga kurang mampu setiap bulan.',
                'full_description' => 'Program distribusi pangan menyasar keluarga rentan dengan paket kebutuhan pokok dan pendampingan gizi.',
                'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=900&q=80',
                'icon' => 'gift',
                'category' => 'pangan',
                'target_audience' => 'Keluarga prasejahtera',
                'location' => 'Bandung',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pendidikan Gizi',
                'short_description' => 'Workshop tentang nutrisi dan pola makan sehat untuk keluarga.',
                'full_description' => 'Edukasi gizi praktis untuk orang tua, kader, dan remaja agar pencegahan stunting lebih efektif.',
                'image' => null,
                'icon' => 'book-open',
                'category' => 'pendidikan',
                'target_audience' => 'Ibu dan anak',
                'location' => 'Cimahi',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Keterampilan',
                'short_description' => 'Pelatihan keterampilan untuk meningkatkan kemandirian ekonomi masyarakat.',
                'full_description' => 'Pelatihan keterampilan kerja dan usaha mikro untuk membuka peluang pendapatan baru.',
                'image' => null,
                'icon' => 'briefcase',
                'category' => 'ekonomi',
                'target_audience' => 'Usia produktif',
                'location' => 'Kabupaten Bandung',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Dapur Umum',
                'short_description' => 'Menyediakan makanan hangat gratis di titik layanan harian.',
                'full_description' => 'Dapur umum kolaboratif bersama relawan untuk distribusi makanan siap santap.',
                'image' => 'https://images.unsplash.com/photo-1467453678174-768ec283a940?auto=format&fit=crop&w=900&q=80',
                'icon' => 'home',
                'category' => 'pangan',
                'target_audience' => 'Masyarakat rentan',
                'location' => 'Bandung Timur',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(
                ['title' => $program['title']],
                $program
            );
        }
    }
}
