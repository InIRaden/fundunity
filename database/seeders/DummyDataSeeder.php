<?php

namespace Database\Seeders;

use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Message;
use App\Models\Volunteer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaigns = Campaign::all();
        if ($campaigns->isEmpty()) {
            $campaignData = [
                [
                    'title' => 'Bantuan Pangan untuk Keluarga Prasejahtera',
                    'description' => 'Program pengumpulan dana untuk memberikan bantuan sembako dan kebutuhan pokok bulanan bagi keluarga rentan di daerah pinggiran kota.',
                    'collected' => 5000000,
                    'target' => 50000000,
                    'deadline' => Carbon::now()->addDays(30),
                    'category' => 'Pangan',
                    'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=900&q=80',
                    'status' => 'aktif',
                    'is_active' => true,
                ],
                [
                    'title' => 'Renovasi Sekolah Pelosok',
                    'description' => 'Mari wujudkan lingkungan belajar yang nyaman dan layak untuk adik-adik kita yang saat ini belajar di gedung sekolah yang hampir rubuh.',
                    'collected' => 75000000,
                    'target' => 100000000,
                    'deadline' => Carbon::now()->addDays(15),
                    'category' => 'Pendidikan',
                    'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
                    'status' => 'aktif',
                    'is_active' => true,
                ],
                [
                    'title' => 'Bantuan Medis Balita Kurang Gizi',
                    'description' => 'Penyaluran susu khusus, vitamin, dan biaya pengobatan untuk puluhan balita yang mengalami gizi buruk di desa terpencil.',
                    'collected' => 12000000,
                    'target' => 20000000,
                    'deadline' => Carbon::now()->addDays(5),
                    'category' => 'Kesehatan',
                    'image' => 'https://images.unsplash.com/photo-1467453678174-768ec283a940?auto=format&fit=crop&w=900&q=80',
                    'status' => 'aktif',
                    'is_active' => true,
                ]
            ];

            foreach ($campaignData as $data) {
                Campaign::create($data);
            }
            $campaigns = Campaign::all();
        }

        $donors = [
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com'],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com'],
            ['name' => 'Andi Wijaya', 'email' => 'andi@example.com'],
            ['name' => 'Rina Melati', 'email' => 'rina@example.com'],
            ['name' => 'Eko Prasetyo', 'email' => 'eko@example.com'],
        ];

        foreach ($donors as $dData) {
            $donor = Donor::firstOrCreate(['email' => $dData['email']], [
                'name' => $dData['name'],
                'total_donation' => 0,
                'last_donation' => null,
                'is_active' => true,
            ]);

            // Create 1-3 donations for each donor
            $numDonations = rand(1, 3);
            for ($i = 0; $i < $numDonations; $i++) {
                $campaign = $campaigns->random();
                $amount = rand(50, 500) * 1000;
                $date = Carbon::now()->subDays(rand(1, 30));

                Donation::create([
                    'transaction_id' => 'DON-' . strtoupper(Str::random(10)),
                    'campaign_id' => $campaign->id,
                    'donor_id' => $donor->id,
                    'amount' => $amount,
                    'status' => 'success',
                    'prayer' => rand(0, 1) ? 'Semoga berkah dan bermanfaat untuk semua.' : null,
                    'is_anonymous' => rand(0, 1) == 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                $donor->increment('total_donation', $amount);
                $donor->update(['last_donation' => $date->toDateString()]);
                $campaign->increment('collected', $amount);
            }
        }

        // 2. Campaign Updates
        foreach ($campaigns as $campaign) {
            $numUpdates = rand(0, 3);
            for ($i = 0; $i < $numUpdates; $i++) {
                CampaignUpdate::create([
                    'campaign_id' => $campaign->id,
                    'title' => 'Penyaluran Tahap ' . ($i + 1) . ' - ' . $campaign->title,
                    'content' => "Alhamdulillah, berkat bantuan para donatur, kami telah menyalurkan bantuan tahap " . ($i + 1) . ".\n\nBantuan ini telah diserahkan langsung ke lokasi sasaran dan diterima dengan penuh syukur. Terima kasih kepada semua yang telah berkontribusi mewujudkan aksi nyata ini.",
                    'image' => null, // No image for dummy
                    'created_at' => Carbon::now()->subDays(rand(1, 20)),
                ]);
            }
        }

        // 3. Beneficiaries
        $locations = ['Desa Sukamaju', 'Panti Asuhan Kasih Bunda', 'Sekolah Pelosok', 'Warga Terdampak Banjir', 'Klinik Kesehatan Desa'];
        for ($i = 0; $i < 10; $i++) {
            Beneficiary::create([
                'name' => 'Kelompok Penerima Manfaat ' . ($i + 1),
                'program_name' => $campaigns->random()->title,
                'location' => $locations[array_rand($locations)],
                'assistance_value' => rand(100, 1000) * 1000,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
            ]);
        }

        // 4. Volunteers
        $volSkills = ['Pendidikan', 'Kesehatan', 'Lingkungan', 'Sosial Kemanusiaan'];
        for ($i = 0; $i < 8; $i++) {
            Volunteer::create([
                'name' => 'Relawan ' . ($i + 1),
                'email' => 'relawan' . $i . '@example.com',
                'phone' => '0812345678' . $i,
                'category' => $volSkills[array_rand($volSkills)],
                'is_verified' => rand(0, 1) == 1,
                'registered_at' => Carbon::now()->subDays(rand(1, 15)),
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 15)),
            ]);
        }

        // 5. Messages
        for ($i = 0; $i < 5; $i++) {
            Message::create([
                'name' => 'Pengunjung ' . ($i + 1),
                'email' => 'pengunjung' . $i . '@example.com',
                'message' => 'Halo, saya ingin bertanya lebih detail mengenai program donasi bulanan. Bagaimana cara daftarnya?',
                'is_read' => rand(0, 1) == 1,
                'created_at' => Carbon::now()->subDays(rand(1, 10)),
            ]);
        }
    }
}
