<?php

namespace Database\Seeders;

use Database\Seeders\ProgramSeeder;
use Database\Seeders\FocusAreaSeeder;
use Database\Seeders\GalleryItemSeeder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            LandingContentSeeder::class,
            ProgramSeeder::class,
            FocusAreaSeeder::class,
            GalleryItemSeeder::class,
            DummyDataSeeder::class,
        ]);
    }
}
