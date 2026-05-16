<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Faq;
use App\Models\FocusArea;
use App\Models\ImageSlider;
use App\Models\Page;
use App\Models\Partner;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class LandingContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedPages();
        $this->seedSlider();
        $this->seedFocusAreas();
        $this->seedCampaigns();
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

        ImageSlider::create([
            'title' => 'Hero Landing',
            'description' => 'Hero utama landing page',
            'image_url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2670&auto=format&fit=crop',
            'sort_order' => 1,
            'is_active' => true,
        ]);
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
                'title' => 'Bantuan Mendesak Korban Banjir Demak dan Sekitarnya',
                'description' => 'Program bantuan cepat tanggap untuk keluarga terdampak banjir.',
                'collected' => 125000000,
                'target' => 200000000,
                'deadline' => now()->addDays(5)->toDateString(),
                'category' => 'Bencana Alam',
                'image' => 'https://images.unsplash.com/photo-1547683905-f30e6113824f?auto=format&fit=crop&q=80&w=800',
                'status' => 'aktif',
                'is_active' => true,
            ],
            [
                'title' => 'Beasiswa Pendidikan Untuk 100 Anak Yatim Berprestasi',
                'description' => 'Program beasiswa pendidikan untuk anak-anak yatim berprestasi.',
                'collected' => 45000000,
                'target' => 100000000,
                'deadline' => now()->addDays(24)->toDateString(),
                'category' => 'Pendidikan',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=800',
                'status' => 'aktif',
                'is_active' => true,
            ],
            [
                'title' => 'Pembangunan Sumur Air Bersih Pelosok NTT',
                'description' => 'Pembangunan sarana air bersih untuk wilayah yang sulit akses air.',
                'collected' => 8200000,
                'target' => 50000000,
                'deadline' => now()->addDays(60)->toDateString(),
                'category' => 'Infrastruktur',
                'image' => 'https://plus.unsplash.com/premium_photo-1664302152996-03fcb2220d9e?auto=format&fit=crop&q=80&w=800',
                'status' => 'aktif',
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Campaign::create($item);
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
