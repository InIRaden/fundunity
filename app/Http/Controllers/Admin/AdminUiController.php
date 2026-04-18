<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsItem;
use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\Donor;
use App\Models\Faq;
use App\Models\FocusArea;
use App\Models\GalleryItem;
use App\Models\ImageSlider;
use App\Models\Message;
use App\Models\Partner;
use App\Models\SiteSetting;
use App\Models\Volunteer;
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
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (Faq $faq): array {
                return [
                    'id' => $faq->id,
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                    'category' => $faq->category,
                    'sort_order' => $faq->sort_order,
                    'is_active' => (bool) $faq->is_active,
                ];
            })
            ->values();

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
        $partners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (Partner $partner): array {
                return [
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'imageUrl' => $partner->logo,
                    'websiteUrl' => $partner->website_url,
                    'type' => $partner->type,
                    'description' => $partner->description,
                    'sort_order' => $partner->sort_order,
                ];
            })
            ->values();

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

        $donatur = Donor::where('is_active', true)
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (Donor $donor): array {
                return [
                    'id' => $donor->id,
                    'nama' => $donor->name,
                    'email' => $donor->email,
                    'totalDonasi' => (int) $donor->total_donation,
                    'lastDonasi' => $donor->last_donation ? substr((string) $donor->last_donation, 0, 10) : null,
                ];
            })
            ->values();

        $penerima = Beneficiary::where('is_active', true)
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (Beneficiary $beneficiary): array {
                return [
                    'id' => $beneficiary->id,
                    'nama' => $beneficiary->name,
                    'program' => $beneficiary->program_name,
                    'nilai' => (int) $beneficiary->assistance_value,
                    'lokasi' => $beneficiary->location,
                ];
            })
            ->values();

        $relawan = Volunteer::where('is_active', true)
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (Volunteer $volunteer): array {
                return [
                    'id' => $volunteer->id,
                    'nama' => $volunteer->name,
                    'email' => $volunteer->email,
                    'phone' => $volunteer->phone,
                    'kategori' => $volunteer->category,
                    'date' => $volunteer->registered_at ? substr((string) $volunteer->registered_at, 0, 10) : null,
                    'isVerified' => (bool) $volunteer->is_verified,
                ];
            })
            ->values();

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
        $settingKeys = [
            'site_name',
            'site_short_name',
            'identity_tagline',
            'email',
            'phone',
            'instagram_url',
            'address',
            'site_logo',
        ];

        $settings = SiteSetting::query()
            ->whereIn('key', $settingKeys)
            ->pluck('value', 'key');

        $identity = [
            'orgName' => $settings->get('site_name') ?: 'Komunitas Ruang Berbagi',
            'shortName' => $settings->get('site_short_name') ?: 'FundUnity',
            'tagline' => $settings->get('identity_tagline') ?: 'Bangun komunitas, kelola donasi.',
            'email' => $settings->get('email') ?: 'halo@fundunity.id',
            'phone' => $settings->get('phone') ?: '0812-3456-7890',
            'instagramUrl' => $settings->get('instagram_url') ?: 'https://instagram.com/fundunity',
            'address' => $settings->get('address') ?: 'Jl. Kolaborasi Sosial No. 17, Bandung',
            'logoUrl' => $settings->get('site_logo') ?: 'https://via.placeholder.com/256x256/22c55e/ffffff?text=FU',
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
