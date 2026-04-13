<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsItem;
use App\Models\Campaign;
use App\Models\FocusArea;
use App\Models\GalleryItem;
use App\Models\ImageSlider;
use App\Models\Message;
use Illuminate\View\View;

class AdminUiController extends Controller
{
    public function aboutUs(): View
    {
        $generalProfile = AboutUsItem::where('section', 'general')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (AboutUsItem $item): array {
                return [
                    'id' => $item->id,
                    'nama' => $item->title,
                    'description' => $item->description,
                    'imageUrl' => $item->image_url,
                ];
            })
            ->values();

        $strukturData = AboutUsItem::where('section', 'structure')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (AboutUsItem $item): array {
                return [
                    'id' => $item->id,
                    'jabatan' => $item->position,
                    'nama' => $item->title,
                    'description' => $item->description,
                    'imageUrl' => $item->image_url,
                ];
            })
            ->values();

        $pageMeta = [
            'title' => 'Profil Lembaga',
            'subtitle' => 'Kelola identitas, visi, misi, dan tim organisasi',
        ];

        return view('admin.aboutus', compact('generalProfile', 'strukturData', 'pageMeta'));
    }

    public function campaign(): View
    {
        $campaigns = Campaign::orderByDesc('created_at')
            ->get()
            ->map(static function (Campaign $campaign): array {
                return [
                    'id' => $campaign->id,
                    'title' => $campaign->title,
                    'description' => $campaign->description,
                    'collected' => (int) $campaign->collected,
                    'target' => (int) $campaign->target,
                    'deadline' => $campaign->deadline ? substr((string) $campaign->deadline, 0, 10) : null,
                    'category' => $campaign->category ?? 'Umum',
                    'status' => $campaign->status,
                ];
            })
            ->values();

        $pageMeta = [
            'title' => 'Campaign',
            'subtitle' => 'Kelola program galang dana dan progres pencapaian',
        ];

        return view('admin.campaign', compact('campaigns', 'pageMeta'));
    }

    public function focusAreas(): View
    {
        $focusAreas = FocusArea::orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (FocusArea $focusArea): array {
                return [
                    'id' => $focusArea->id,
                    'icon' => $focusArea->icon ?: 'ph ph-target',
                    'title' => $focusArea->title,
                    'description' => $focusArea->description,
                ];
            })
            ->values();

        $pageMeta = [
            'title' => 'Fokus Area',
            'subtitle' => 'Kelola pilar pengabdian dan bidang program',
        ];

        return view('admin.focusareas', compact('focusAreas', 'pageMeta'));
    }

    public function faqs(): View
    {
        $faqs = [
            [
                'id' => 1,
                'question' => 'Apakah organisasi ini sah dan memiliki legalitas resmi?',
                'answer' => 'Ya, kami terdaftar resmi dan diakui secara institusional sesuai bentuk organisasi kami, serta memiliki pedoman transparansi yang jelas dan rutin diaudit.',
            ],
            [
                'id' => 2,
                'question' => 'Apakah saya bisa berdonasi tanpa mencantumkan nama (Anonim)?',
                'answer' => 'Tentu. Saat mengisi formulir donasi, Anda bisa menyembunyikan identitas Anda. Laporan transaksi publik hanya akan menampilkan status Hamba Allah atau Inisial.',
            ],
            [
                'id' => 3,
                'question' => 'Bagaimana saya memastikan dana disalurkan ke tempat yang tepat?',
                'answer' => 'Setiap kampanye memiliki pembaruan (Update) secara berkala yang memuat laporan foto, kuitansi, dan rincian penyaluran yang dapat diverifikasi semua orang di menu Transparansi.',
            ],
            [
                'id' => 4,
                'question' => 'Berapa persen potongan administrasi dari donasi saya?',
                'answer' => 'Sistem mengenakan potongan platform/payment gateway (maksimal 5%) untuk menjaga kelangsungan infrastruktur server. Selebihnya disalurkan penuh ke penerima manfaat.',
            ],
        ];

        $pageMeta = [
            'title' => 'Tanya Jawab',
            'subtitle' => 'Kelola daftar FAQ untuk pengunjung',
        ];

        return view('admin.faqs', compact('faqs', 'pageMeta'));
    }

    public function messages(): View
    {
        $messages = Message::orderByDesc('created_at')
            ->get()
            ->map(static function (Message $message): array {
                return [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'message' => $message->message,
                    'is_read' => (bool) $message->is_read,
                    'date' => $message->created_at?->format('d M Y H:i'),
                    'created_at' => $message->created_at?->toISOString(),
                ];
            })
            ->values();

        $messageStats = [
            'total' => count($messages),
            'unread' => collect($messages)->where('is_read', false)->count(),
            'this_month' => Message::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
        ];

        $filter = 'all';

        $pageMeta = [
            'title' => 'Kotak Masuk',
            'subtitle' => 'Tinjau pesan kolaborasi dan laporan dari pendukung',
        ];

        return view('admin.messages', compact('messages', 'messageStats', 'filter', 'pageMeta'));
    }

    public function notifications(): View
    {
        $activities = [
            [
                'icon' => 'ph ph-lock-key',
                'title' => 'Admin login ke sistem',
                'description' => 'Akses panel admin berhasil dari perangkat terdaftar.',
                'timestamp' => now()->subMinutes(35),
                'type' => 'login',
                'user' => 'admin@fundunity.id',
                'ip' => '192.168.1.10',
            ],
            [
                'icon' => 'ph ph-money',
                'title' => 'Donasi baru diterima',
                'description' => 'Donasi masuk Rp 1.500.000 untuk campaign Pendidikan.',
                'timestamp' => now()->subHours(3),
                'type' => 'donation',
                'user' => 'Sistem',
                'ip' => '127.0.0.1',
            ],
            [
                'icon' => 'ph ph-megaphone',
                'title' => 'Campaign diperbarui',
                'description' => 'Deadline campaign Tanggap Banjir diperpanjang 7 hari.',
                'timestamp' => now()->subDay(),
                'type' => 'campaign',
                'user' => 'Nadia Putri',
                'ip' => '192.168.1.21',
            ],
        ];

        $stats = [
            'total_activities' => 128,
            'today_activities' => 16,
            'unique_users' => 8,
            'failed_attempts' => 2,
        ];

        $pageMeta = [
            'title' => 'Log Aktivitas',
            'subtitle' => 'Riwayat audit sistem dan manipulasi data',
        ];

        return view('admin.notifications', compact('activities', 'stats', 'pageMeta'));
    }

    public function partners(): View
    {
        $partners = [
            [
                'id' => 1,
                'name' => 'Bank Syariah Indonesia',
                'imageUrl' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/2560px-Bank_Syariah_Indonesia.svg.png',
            ],
            [
                'id' => 2,
                'name' => 'Kitabisa',
                'imageUrl' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Kitabisa_Logo.png',
            ],
        ];

        $pageMeta = [
            'title' => 'Mitra Kami',
            'subtitle' => 'Kelola daftar partner dan kolaborator',
        ];

        return view('admin.partners', compact('partners', 'pageMeta'));
    }

    public function databaseStakeholder(): View
    {
        $activeTab = 'donatur';
        $searchQuery = '';

        $donatur = [
            [
                'id' => 1,
                'nama' => 'Budi Santoso',
                'email' => 'budi@mail.com',
                'totalDonasi' => 12500000,
                'lastDonasi' => '2025-03-01',
            ],
            [
                'id' => 2,
                'nama' => 'PT Maju Bersama',
                'email' => 'csr@majubersama.co.id',
                'totalDonasi' => 50000000,
                'lastDonasi' => '2025-02-15',
            ],
            [
                'id' => 3,
                'nama' => 'Siti Aminah',
                'email' => 'siti.a@mail.com',
                'totalDonasi' => 500000,
                'lastDonasi' => '2025-03-02',
            ],
        ];

        $penerima = [
            ['id' => 1, 'nama' => 'SDN 01 Atap', 'program' => 'Renovasi Sekolah', 'nilai' => 15000000, 'lokasi' => 'Kupang, NTT'],
            ['id' => 2, 'nama' => 'Panti Asuhan Al-Kautsar', 'program' => 'Beasiswa Anak Yatim', 'nilai' => 5000000, 'lokasi' => 'Bandung, Jabar'],
            ['id' => 3, 'nama' => 'Desa Sukamakmur', 'program' => 'Pembangunan Sumur Bor', 'nilai' => 8000000, 'lokasi' => 'Gunungkidul, DIY'],
        ];

        $relawan = [
            ['id' => 1, 'nama' => 'Rina Kusumawati', 'email' => 'rina.k@mail.com', 'phone' => '081234567890', 'kategori' => 'Relawan Lapangan', 'date' => '2026-03-29'],
            ['id' => 2, 'nama' => 'Andi Pratama', 'email' => 'andi.p@mail.com', 'phone' => '085678901234', 'kategori' => 'Digital Media', 'date' => '2026-03-28'],
        ];

        $pageMeta = [
            'title' => 'Relasi & Bantuan',
            'subtitle' => 'Basis data donatur, relawan, dan penerima bantuan',
        ];

        return view('admin.databasestakeholder', compact('activeTab', 'searchQuery', 'donatur', 'penerima', 'relawan', 'pageMeta'));
    }

    public function keuanganTransparansi(): View
    {
        $activeMasterTab = 'pemasukan';
        $incomeSearch = '';
        $incomeFilterTab = 'semua';

        $filteredIncomes = [
            [
                'id' => 101,
                'nama' => 'Budi Santoso',
                'category' => 'Bantuan Banjir NTT',
                'notes' => 'Semoga berkah',
                'amount' => 500000,
                'status' => 'berhasil',
                'date' => '2025-03-01',
            ],
            [
                'id' => 102,
                'nama' => 'PT Maju Bersama',
                'category' => 'Pembangunan Sumur Bor',
                'notes' => 'Donasi CSR Perusahaan',
                'amount' => 5000000,
                'status' => 'pending',
                'date' => '2025-03-02',
            ],
            [
                'id' => 103,
                'nama' => 'Siti Aminah',
                'category' => 'Beasiswa Anak Yatim 2025',
                'notes' => 'Titip untuk yatim piatu',
                'amount' => 250000,
                'status' => 'berhasil',
                'date' => '2025-03-02',
            ],
            [
                'id' => 104,
                'nama' => 'Hamba Allah',
                'category' => 'Bantuan Banjir NTT',
                'notes' => '',
                'amount' => 100000,
                'status' => 'gagal',
                'date' => '2025-03-03',
            ],
            [
                'id' => 105,
                'nama' => 'Anonim',
                'category' => 'Beasiswa Anak Yatim 2025',
                'notes' => 'Semoga bermanfaat',
                'amount' => 1500000,
                'status' => 'berhasil',
                'date' => '2025-03-04',
            ],
        ];

        $laporanItems = [
            [
                'program' => 'Bantuan Banjir NTT',
                'kategori' => 'Kebencanaan',
                'pemasukan' => 32500000,
                'disalurkan' => 30000000,
                'sisa' => 2500000,
                'penerima' => 47,
                'periode' => 'Mar 2025',
                'status' => 'selesai',
            ],
            [
                'program' => 'Beasiswa Anak Yatim 2025',
                'kategori' => 'Pendidikan',
                'pemasukan' => 30000000,
                'disalurkan' => 20000000,
                'sisa' => 10000000,
                'penerima' => 20,
                'periode' => 'Jan-Des 2025',
                'status' => 'berjalan',
            ],
            [
                'program' => 'Pembangunan Sumur Bor',
                'kategori' => 'Kesehatan',
                'pemasukan' => 4800000,
                'disalurkan' => 0,
                'sisa' => 4800000,
                'penerima' => 0,
                'periode' => 'Apr-Jun 2025',
                'status' => 'berjalan',
            ],
        ];

        $totalPemasukanGlobal = collect($laporanItems)->sum('pemasukan');
        $totalDisalurkanGlobal = collect($laporanItems)->sum('disalurkan');
        $totalSisaGlobal = collect($laporanItems)->sum('sisa');

        $pageMeta = [
            'title' => 'Keuangan Transparansi',
            'subtitle' => 'Pantau pemasukan, penyaluran, dan laporan dana',
        ];

        return view('admin.keuangantransparansi', compact(
            'activeMasterTab',
            'incomeSearch',
            'incomeFilterTab',
            'filteredIncomes',
            'laporanItems',
            'totalPemasukanGlobal',
            'totalDisalurkanGlobal',
            'totalSisaGlobal',
            'pageMeta'
        ));
    }

    public function gallery(): View
    {
        $galleryImages = GalleryItem::where('type', 'image')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (GalleryItem $item): array {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'category' => $item->category ?? 'Umum',
                    'date' => $item->activity_date
                        ? substr((string) $item->activity_date, 0, 10)
                        : ($item->created_at ? substr((string) $item->created_at, 0, 10) : null),
                    'imageUrl' => $item->thumbnail ?: $item->url,
                ];
            })
            ->values();

        $pageMeta = [
            'title' => 'Galeri Aktivitas',
            'subtitle' => 'Kelola dokumentasi visual kegiatan dan bukti penyaluran',
        ];

        return view('admin.gallery', compact('galleryImages', 'pageMeta'));
    }

    public function imageSlider(): View
    {
        $sliderItems = ImageSlider::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (ImageSlider $slider): array {
                return [
                    'id' => $slider->id,
                    'title' => $slider->title,
                    'description' => $slider->description,
                    'imageUrl' => $slider->image_url,
                    'sort_order' => $slider->sort_order,
                ];
            })
            ->values();

        $pageMeta = [
            'title' => 'Banner Slider',
            'subtitle' => 'Kelola konten banner pada landing page',
        ];

        return view('admin.imageslider', compact('sliderItems', 'pageMeta'));
    }

    public function websiteIdentity(): View
    {
        $identity = [
            'orgName' => 'Komunitas Ruang Berbagi',
            'shortName' => 'FundUnity',
            'tagline' => 'Bangun komunitas, kelola donasi.',
            'email' => 'halo@fundunity.id',
            'phone' => '0812-3456-7890',
            'instagram' => '@fundunity',
            'address' => 'Jl. Kolaborasi Sosial No. 17, Bandung',
        ];

        $pageMeta = [
            'title' => 'Website Identity',
            'subtitle' => 'Kelola identitas visual dan informasi organisasi',
        ];

        return view('admin.identity', compact('identity', 'pageMeta'));
    }

    public function landingManager(): View
    {
        $tabs = [
            ['key' => 'slider', 'label' => 'Banner Slider', 'route' => 'admin.imageslider'],
            ['key' => 'focus', 'label' => 'Fokus Area', 'route' => 'admin.focusareas'],
            ['key' => 'about', 'label' => 'Profil Lembaga', 'route' => 'admin.aboutus'],
            ['key' => 'faqs', 'label' => 'Tanya Jawab', 'route' => 'admin.faqs'],
            ['key' => 'partners', 'label' => 'Mitra Kami', 'route' => 'admin.partners'],
        ];

        $pageMeta = [
            'title' => 'Landing Manager',
            'subtitle' => 'Pusat pengelolaan konten landing page',
        ];

        return view('admin.landing-manager', compact('tabs', 'pageMeta'));
    }
}
