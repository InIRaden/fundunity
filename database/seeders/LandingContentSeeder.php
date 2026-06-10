<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Faq;
use App\Models\FocusArea;
use App\Models\ImageSlider;
use App\Models\Page;
use App\Models\Partner;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LandingContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedPages();
        $this->seedSlider();
        $this->seedAboutUs();
        $this->seedTeamMembers();
        $this->seedFocusAreas();
        $this->seedCampaigns();
        $this->seedDonations();
        $this->seedFaqs();
        $this->seedPartners();
    }

    private function seedSiteSettings(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Himpunan Mahasiswa Teknologi Pangan Unpad', 'type' => 'text', 'group' => 'general', 'label' => 'Site Name'],
            ['key' => 'site_short_name', 'value' => 'HMT-Unpad', 'type' => 'text', 'group' => 'general', 'label' => 'Site Short Name'],
            ['key' => 'site_logo', 'value' => '/images/Logo.png', 'type' => 'image', 'group' => 'general', 'label' => 'Site Logo'],
            ['key' => 'footer_tagline', 'value' => 'Platform konektivitas, galang dana, dan transparansi organisasi terpercaya. Bersama memberdayakan masyarakat dan mencetak dampak positif setiap harinya.', 'type' => 'textarea', 'group' => 'general', 'label' => 'Footer Tagline'],
            ['key' => 'phone', 'value' => '+62 811 2233 4455', 'type' => 'text', 'group' => 'general', 'label' => 'Phone'],
            ['key' => 'email', 'value' => 'hmt@unpad.ac.id', 'type' => 'text', 'group' => 'general', 'label' => 'Email'],
            ['key' => 'address', 'value' => 'Sekretariat Utama, Gedung Kemahasiswaan Lt. 2, Jatinangor', 'type' => 'text', 'group' => 'general', 'label' => 'Address'],
            ['key' => 'instagram_url', 'value' => '#', 'type' => 'url', 'group' => 'social', 'label' => 'Instagram URL'],
            ['key' => 'whatsapp_url', 'value' => '#', 'type' => 'url', 'group' => 'social', 'label' => 'WhatsApp URL'],
            ['key' => 'footer_copyright', 'value' => 'HMT-Unpad. All rights reserved.', 'type' => 'text', 'group' => 'general', 'label' => 'Footer Copyright'],
            ['key' => 'newsletter_title', 'value' => 'Newsletter', 'type' => 'text', 'group' => 'general', 'label' => 'Newsletter Title'],
            ['key' => 'newsletter_description', 'value' => 'Dapatkan laporan bulanan dan kabar baik penyaluran dana langsung ke email Anda.', 'type' => 'textarea', 'group' => 'general', 'label' => 'Newsletter Description'],
            ['key' => 'newsletter_cta_text', 'value' => 'Berlangganan', 'type' => 'text', 'group' => 'general', 'label' => 'Newsletter CTA'],
            ['key' => 'newsletter_placeholder', 'value' => 'Alamat email Anda...', 'type' => 'text', 'group' => 'general', 'label' => 'Newsletter Placeholder'],
            ['key' => 'legal_privacy_policy', 'value' => "1. Informasi yang Kami Kumpulkan\nKami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk nama, alamat email, dan informasi lain yang Anda pilih untuk dibagikan saat melakukan donasi atau pendaftaran relawan.\n\n2. Penggunaan Informasi\nKami menggunakan informasi yang kami kumpulkan untuk menyediakan, memelihara, dan meningkatkan layanan kami, memproses transaksi donasi Anda, serta untuk berkomunikasi dengan Anda tentang laporan penyaluran dana.\n\n3. Keamanan Informasi\nKami mengambil langkah-langkah teknis dan organisasional yang wajar untuk melindungi informasi pribadi Anda dari akses yang tidak sah, pencurian, atau penyalahgunaan.", 'type' => 'textarea', 'group' => 'legal', 'label' => 'Privacy Policy'],
            ['key' => 'legal_terms_conditions', 'value' => "1. Penerimaan Ketentuan\nDengan mengakses dan menggunakan situs web FundUnity, Anda secara otomatis menerima dan setuju untuk terikat oleh syarat dan ketentuan penggunaan ini. Jika Anda tidak setuju, mohon untuk tidak melanjutkan penggunaan platform ini.\n\n2. Penggunaan Layanan\nAnda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah, seperti berdonasi, mendaftar relawan, atau memantau laporan transparansi, dan sesuai dengan semua hukum serta peraturan yang berlaku di Republik Indonesia.\n\n3. Donasi\nSemua donasi yang diberikan melalui platform ini bersifat sukarela dan tidak dapat ditarik kembali (non-refundable), kecuali terdapat kesalahan sistematis yang dapat dibuktikan secara sah sesuai kebijakan pengembalian dana kami.\n\n4. Perubahan Ketentuan\nKami berhak untuk memperbarui syarat dan ketentuan ini sewaktu-waktu. Perubahan akan berlaku segera setelah dipublikasikan di halaman ini.", 'type' => 'textarea', 'group' => 'legal', 'label' => 'Terms & Conditions'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                    'label' => $setting['label'],
                ]
            );
        }
    }

    private function seedPages(): void
    {
        Page::firstOrCreate(
            ['slug' => 'home'],
            [
                'meta_title' => 'Wujudkan Dampak Nyata',
                'hero_title' => 'Wujudkan Dampak Nyata, Sinergi Membangun Negeri.',
                'hero_subtitle' => 'Lebih dari sekadar platform donasi. Bersama kita menggalang solidaritas, transparansi, dan gerakan nyata untuk perubahan sosial yang berkelanjutan.',
                'hero_image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2670&auto=format&fit=crop',
                'hero_btn_primary_text' => 'Pilih Program Bantuan',
                'hero_btn_primary_url' => '/landing/allprograms',
                'hero_btn_secondary_text' => 'Lihat Profil Kami',
                'hero_btn_secondary_url' => '/landing/about',
                'section_title' => 'Landing Home',
                'section_subtitle' => 'Konten utama landing page',
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'meta_title' => 'Tentang Kami',
                'vision_title' => 'Visi Kami',
                'vision_content' => 'Menjadi jembatan kebaikan digital nomor satu yang transparan dan dapat diandalkan oleh masyarakat luas.',
                'mission_title' => 'Misi Utama',
                'story_title' => 'Profil Organisasi',
                'story_content' => 'Kami adalah organisasi kemahasiswaan dan sosial kultural yang berfokus membangun gerakan solutif bernilai tinggi, transparan, serta berdampak nyata bagi masyarakat luas.',
                'team_section_title' => 'Pengurus',
                'team_section_subtitle' => 'Tim inti organisasi',
            ]
        );
    }

    private function seedSlider(): void
    {
        if (ImageSlider::query()->exists()) {
            return;
        }

        $items = [
            [
                'title' => 'Wujudkan Dampak Nyata',
                'description' => 'Bersama kita menggalang solidaritas, transparansi, dan gerakan nyata untuk perubahan sosial yang berkelanjutan.',
                'image_url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2670&auto=format&fit=crop',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pendidikan untuk Semua',
                'description' => 'Membangun masa depan generasi penerus dengan fasilitas pendidikan yang layak dan setara.',
                'image_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=2622&auto=format&fit=crop',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Bantuan Kesehatan Cepat Tanggap',
                'description' => 'Berikan harapan bagi mereka yang berjuang melawan penyakit di pelosok daerah.',
                'image_url' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=2670&auto=format&fit=crop',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            ImageSlider::create($item);
        }
    }

    private function seedAboutUs(): void
    {
        if (\App\Models\AboutUsItem::query()->exists()) {
            return;
        }

        $items = [
            [
                'section' => 'general',
                'title' => 'Visi Kami',
                'description' => 'Menjadi jembatan kebaikan digital nomor satu yang transparan dan dapat diandalkan oleh masyarakat luas.',
                'image_url' => 'https://images.unsplash.com/photo-1529156069898-49953eb1b5e4?q=80&w=2574&auto=format&fit=crop',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'section' => 'general',
                'title' => 'Misi Utama',
                'description' => "1. Memberikan akses donasi yang mudah dan aman.\n2. Mengedepankan transparansi laporan penyaluran dana.\n3. Memberdayakan komunitas lokal melalui program berkelanjutan.",
                'image_url' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            \App\Models\AboutUsItem::create($item);
        }
    }

    private function seedTeamMembers(): void
    {
        if (\App\Models\TeamMember::query()->exists()) {
            return;
        }

        $items = [
            [
                'name' => 'Ahmad Fadhil',
                'position' => 'Ketua Umum',
                'bio' => 'Memimpin dengan visi inovatif untuk kesejahteraan bersama.',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2670&auto=format&fit=crop',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'position' => 'Sekretaris',
                'bio' => 'Mengelola administrasi dan komunikasi organisasi dengan presisi.',
                'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2670&auto=format&fit=crop',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Reza Rahardian',
                'position' => 'Bendahara',
                'bio' => 'Memastikan setiap dana donasi tersalurkan secara transparan dan akuntabel.',
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=2574&auto=format&fit=crop',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dian Sastro',
                'position' => 'Koordinator Program',
                'bio' => 'Menghubungkan inisiatif kebaikan dengan penerima manfaat secara tepat sasaran.',
                'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=2670&auto=format&fit=crop',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            \App\Models\TeamMember::create($item);
        }
    }

    private function seedFocusAreas(): void
    {
        if (FocusArea::query()->exists()) {
            return;
        }

        $items = [
            [
                'title' => 'Pendidikan',
                'description' => 'Memberikan pendidikan berkualitas untuk anak-anak agar dapat mengembangkan potensinya secara optimal.',
                'icon' => 'ph ph-books',
                'color' => 'blue-600',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kesehatan',
                'description' => 'Menyelenggarakan bantuan kesadaran kesehatan dan akses layanan kesehatan dasar bagi masyarakat.',
                'icon' => 'ph ph-heartbeat',
                'color' => 'rose-600',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Lingkungan',
                'description' => 'Mendorong inisiatif untuk perlindungan lingkungan hidup dan keberlanjutan alam.',
                'icon' => 'ph ph-tree',
                'color' => 'emerald-600',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Komunitas',
                'description' => 'Memberdayakan masyarakat melalui pengembangan keterampilan, kolaborasi, dan penguatan kelompok.',
                'icon' => 'ph ph-users',
                'color' => 'amber-600',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            FocusArea::create($item);
        }
    }

    private function seedCampaigns(): void
    {
        if (Campaign::query()->exists()) {
            return;
        }

        $items = [
            [
                'title' => 'Wujudkan Mimpi Sekolah Tepian Negeri: Renovasi SDN 02 NTT',
                'description' => "Kondisi bangunan SDN 02 di pelosok NTT saat ini sangat memprihatinkan. Atap bocor, dinding retak, dan lantai tanah menjadi teman sehari-hari adik-adik kita belajar.\n\nMari bersama HMT-Unpad kita patungan untuk memberikan ruang kelas yang layak bagi masa depan bangsa. Dana yang terkumpul akan digunakan untuk:\n1. Renovasi atap dan plafon\n2. Pengadaan kursi dan meja belajar baru\n3. Pembuatan pojok baca (perpustakaan mini)",
                'collected' => 85000000,
                'target' => 150000000,
                'deadline' => now()->addDays(45)->toDateString(),
                'category' => 'Pendidikan',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2670&auto=format&fit=crop',
                'status' => 'aktif',
                'is_active' => true,
            ],
            [
                'title' => 'Patungan Sembako & Paket Gizi untuk Lansia Dhuafa Jatinangor',
                'description' => "Di sekitar Jatinangor, masih banyak kakek dan nenek yang hidup sebatang kara dan kesulitan memenuhi kebutuhan pangan harian.\n\nProgram ini bertujuan menyalurkan paket sembako lengkap dan tambahan gizi (susu & vitamin) untuk 100 Lansia Dhuafa setiap bulannya. Mari ulurkan tangan kita untuk meringankan beban mereka di usia senja.",
                'collected' => 12500000,
                'target' => 50000000,
                'deadline' => now()->addDays(15)->toDateString(),
                'category' => 'Sosial',
                'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&q=80&w=800',
                'status' => 'aktif',
                'is_active' => true,
            ],
            [
                'title' => 'Emergency Response: Bantuan Mendesak Korban Banjir Demak',
                'description' => "Ribuan warga Demak saat ini mengungsi akibat banjir bandang yang merendam pemukiman mereka. Kebutuhan mendesak saat ini adalah:\n- Makanan siap saji\n- Selimut & Pakaian layak pakai\n- Obat-obatan & Alat kebersihan\n- Air bersih\n\nTim relawan HMT-Unpad sudah berada di lokasi untuk menyalurkan bantuan secara langsung.",
                'collected' => 145000000,
                'target' => 200000000,
                'deadline' => now()->addDays(5)->toDateString(),
                'category' => 'Bencana Alam',
                'image' => 'https://images.unsplash.com/photo-1547683905-f30e6113824f?auto=format&fit=crop&q=80&w=800',
                'status' => 'aktif',
                'is_active' => true,
            ],
            [
                'title' => 'Program Pemberdayaan Ekonomi Masyarakat Jabar (Legacy)',
                'description' => 'Program pemberdayaan ekonomi yang telah selesai dilaksanakan pada periode sebelumnya.',
                'collected' => 950000000,
                'target' => 950000000,
                'deadline' => now()->subMonths(6)->toDateString(),
                'category' => 'Ekonomi',
                'image' => 'https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?auto=format&fit=crop&q=80&w=800',
                'status' => 'selesai',
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Campaign::create($item);
        }
    }

    private function seedDonations(): void
    {
        if (Donation::query()->exists()) {
            return;
        }

        $campaigns = Campaign::all();
        
        foreach ($campaigns as $campaign) {
            $donorsData = [
                ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'prayer' => 'Semoga berkah untuk adek-adek di sana, semangat belajarnya!', 'amount' => 100000],
                ['name' => 'Hamba Allah', 'email' => 'anon1@gmail.com', 'prayer' => 'Sedekah untuk almarhum Ibu, mohon doanya.', 'amount' => 500000, 'is_anon' => true],
                ['name' => 'Liana Putri', 'email' => 'liana@gmail.com', 'prayer' => 'Semangat terus tim relawan HMT! Titip salam untuk warga.', 'amount' => 250000],
                ['name' => 'Andi Wijaya', 'email' => 'andi@gmail.com', 'prayer' => 'Semoga sedikit bantuan ini bermanfaat.', 'amount' => 50000],
                ['name' => 'Hamba Allah', 'email' => 'anon2@gmail.com', 'prayer' => 'Lancar terus programnya.', 'amount' => 1000000, 'is_anon' => true],
            ];

            foreach ($donorsData as $data) {
                $donor = Donor::firstOrCreate(
                    ['email' => $data['email']],
                    ['name' => $data['name'], 'total_donation' => 0, 'is_active' => true]
                );

                Donation::create([
                    'transaction_id' => 'DON-' . strtoupper(Str::random(10)),
                    'campaign_id' => $campaign->id,
                    'donor_id' => $donor->id,
                    'amount' => $data['amount'],
                    'status' => 'success',
                    'prayer' => $data['prayer'],
                    'is_anonymous' => $data['is_anon'] ?? false,
                    'created_at' => now()->subMinutes(rand(5, 5000)),
                ]);

                $donor->increment('total_donation', $data['amount']);
                $donor->update(['last_donation' => now()]);
            }
        }
    }

    private function seedFaqs(): void
    {
        if (Faq::query()->exists()) {
            return;
        }

        $items = [
            [
                'question' => 'Apakah organisasi ini sah dan memiliki legalitas resmi?',
                'answer' => 'Ya, kami terdaftar resmi dan diakui secara institusional sesuai bentuk organisasi kami, serta memiliki pedoman transparansi yang jelas dan rutin diaudit.',
                'category' => 'umum',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah saya bisa berdonasi tanpa mencantumkan nama (Anonim)?',
                'answer' => 'Tentu. Saat mengisi formulir donasi, Anda bisa menyembunyikan identitas Anda. Laporan transaksi publik hanya akan menampilkan status Hamba Allah atau Inisial.',
                'category' => 'donasi',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana saya memastikan dana disalurkan ke tempat yang tepat?',
                'answer' => 'Setiap kampanye memiliki pembaruan secara berkala yang memuat laporan foto, kuitansi, dan rincian penyaluran yang dapat diverifikasi semua orang di menu Transparansi.',
                'category' => 'transparansi',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa persen potongan administrasi dari donasi saya?',
                'answer' => 'Sistem mengenakan potongan platform atau payment gateway maksimal 5 persen untuk menjaga kelangsungan infrastruktur server. Selebihnya disalurkan penuh ke penerima manfaat.',
                'category' => 'donasi',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Faq::create($item);
        }
    }

    private function seedPartners(): void
    {
        if (Partner::query()->exists()) {
            return;
        }

        $items = [
            ['name' => 'Mitra Sejati', 'logo' => '/images/partners/partner1.png', 'sort_order' => 1],
            ['name' => 'Komunitas Peduli', 'logo' => '/images/partners/partner2.png', 'sort_order' => 2],
            ['name' => 'Yayasan Bersama', 'logo' => '/images/partners/partner3.png', 'sort_order' => 3],
            ['name' => 'Relawan Nusantara', 'logo' => '/images/partners/partner4.png', 'sort_order' => 4],
            ['name' => 'Forum Indonesia', 'logo' => '/images/partners/partner5.png', 'sort_order' => 5],
            ['name' => 'Kolaborasi ID', 'logo' => '/images/partners/partner6.png', 'sort_order' => 6],
        ];

        foreach ($items as $item) {
            Partner::create([
                'name' => $item['name'],
                'logo' => $item['logo'],
                'website_url' => null,
                'type' => 'other',
                'description' => null,
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
