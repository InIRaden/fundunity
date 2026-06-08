<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsItem;
use App\Models\AdminActivityLog;
use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Faq;
use App\Models\FocusArea;
use App\Models\GalleryItem;
use App\Models\ImageSlider;
use App\Models\Message;
use App\Models\Partner;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Volunteer;
use Illuminate\View\View;

class AdminUiController extends Controller
{
    public function dashboard(): View
    {
        $totalCollected = (int) Campaign::sum('collected');
        $totalTarget = (int) Campaign::sum('target');
        $totalDistributed = (int) Beneficiary::sum('assistance_value');

        $activeCampaignCount = Campaign::where('status', 'aktif')->count();
        $nearDeadlineCount = Campaign::where('status', 'aktif')
            ->whereDate('deadline', '>=', now()->toDateString())
            ->whereDate('deadline', '<=', now()->addDays(7)->toDateString())
            ->count();

        $donorCount = Donor::where('is_active', true)->count();
        $newDonorThisWeek = Donor::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $completionRate = $this->ratioPercent($totalCollected, $totalTarget);
        $distributionRate = $this->ratioPercent($totalDistributed, $totalCollected);

        $stats = [
            [
                'icon' => 'ph ph-wallet',
                'title' => 'Total Dana Terkumpul',
                'value' => $this->formatCurrencyShort($totalCollected),
                'change' => $completionRate.'% dari target',
                'trend' => $completionRate >= 50 ? 'up' : 'down',
            ],
            [
                'icon' => 'ph ph-hand-heart',
                'title' => 'Telah Disalurkan',
                'value' => $this->formatCurrencyShort($totalDistributed),
                'change' => $distributionRate.'% tersalur',
                'trend' => $distributionRate >= 50 ? 'up' : 'down',
            ],
            [
                'icon' => 'ph ph-chart-line-up',
                'title' => 'Campaign Berjalan',
                'value' => $activeCampaignCount.' Aktif',
                'change' => $nearDeadlineCount.' hampir timeout',
                'trend' => $nearDeadlineCount > 0 ? 'down' : 'up',
            ],
            [
                'icon' => 'ph ph-users',
                'title' => 'Basis Donatur',
                'value' => number_format($donorCount, 0, ',', '.'),
                'change' => ($newDonorThisWeek > 0 ? '+' : '').$newDonorThisWeek.' minggu ini',
                'trend' => $newDonorThisWeek > 0 ? 'up' : 'down',
            ],
        ];

        $feedItems = $this->buildDashboardFeedItems();

        $selectedFilter = '6 Bulan Terakhir';
        $filterOpen = false;
        $filterOptions = ['6 Bulan Terakhir', 'Tahun Ini', 'Tahun Lalu'];

        $pageMeta = [
            'title' => 'Dashboard Admin',
            'subtitle' => 'Pantau metrik dan aktivitas FundUnity',
        ];

        return view('admin.home', compact('stats', 'feedItems', 'selectedFilter', 'filterOpen', 'filterOptions', 'pageMeta'))
            ->with('sidebarWidth', '256px');
    }

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

        $pageMeta = [
            'title' => 'Visi & Misi',
            'subtitle' => 'Kelola pernyataan visi dan misi utama organisasi',
        ];

        return view('admin.aboutus', compact('generalProfile', 'pageMeta'));
    }

    public function members(): View
    {
        $members = TeamMember::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (TeamMember $member): array {
                return [
                    'id' => $member->id,
                    'jabatan' => $member->position,
                    'nama' => $member->name,
                    'description' => $member->bio,
                    'imageUrl' => $member->photo,
                ];
            })
            ->values();

        $pageMeta = [
            'title' => 'Anggota Organisasi',
            'subtitle' => 'Kelola profil tim dan pengurus organisasi',
        ];

        return view('admin.members', compact('members', 'pageMeta'));
    }

    public function campaign(): View
    {
        $campaigns = Campaign::with('updates')->orderByDesc('created_at')
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
                    'updates' => $campaign->updates->map(fn($u) => [
                        'id' => $u->id,
                        'title' => $u->title,
                        'content' => $u->content,
                        'image' => $u->image,
                        'created_at' => $u->created_at->format('Y-m-d H:i'),
                    ])->all(),
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
        $activities = collect();

        $activities = $activities
            ->merge(
                Message::orderByDesc('created_at')
                    ->limit(8)
                    ->get()
                    ->map(function (Message $message): array {
                        return [
                            'icon' => 'ph ph-chat-circle-text',
                            'title' => 'Pesan kontak baru diterima',
                            'description' => 'Pesan dari '.$message->name.' ('.$message->email.').',
                            'timestamp' => $message->created_at,
                            'type' => 'user',
                            'user' => $message->name,
                            'ip' => '-',
                        ];
                    })
            )
            ->merge(
                Donor::orderByDesc('created_at')
                    ->limit(8)
                    ->get()
                    ->map(function (Donor $donor): array {
                        return [
                            'icon' => 'ph ph-money',
                            'title' => 'Donasi donatur tercatat',
                            'description' => 'Donasi '.$this->formatCurrency((int) $donor->total_donation).' oleh '.$donor->name.'.',
                            'timestamp' => $donor->last_donation ?? $donor->created_at,
                            'type' => 'donation',
                            'user' => $donor->name,
                            'ip' => '-',
                        ];
                    })
            )
            ->merge(
                Campaign::orderByDesc('updated_at')
                    ->limit(8)
                    ->get()
                    ->map(function (Campaign $campaign): array {
                        return [
                            'icon' => 'ph ph-megaphone',
                            'title' => 'Campaign diperbarui',
                            'description' => 'Campaign '.$campaign->title.' berstatus '.$campaign->status.'.',
                            'timestamp' => $campaign->updated_at,
                            'type' => 'campaign',
                            'user' => 'Sistem',
                            'ip' => '-',
                        ];
                    })
            )
            ->sortByDesc(static fn (array $activity): int => $activity['timestamp']?->getTimestamp() ?? 0)
            ->take(20)
            ->values();

        $stats = [
            'total_activities' => Message::count() + Donor::count() + Campaign::count() + Volunteer::count() + Beneficiary::count(),
            'today_activities' => Message::whereDate('created_at', now()->toDateString())->count()
                + Donor::whereDate('created_at', now()->toDateString())->count()
                + Campaign::whereDate('updated_at', now()->toDateString())->count()
                + Volunteer::whereDate('created_at', now()->toDateString())->count()
                + Beneficiary::whereDate('created_at', now()->toDateString())->count(),
            'unique_users' => collect()
                ->merge(Message::whereNotNull('email')->pluck('email'))
                ->merge(Donor::whereNotNull('email')->pluck('email'))
                ->merge(Volunteer::whereNotNull('email')->pluck('email'))
                ->filter()
                ->unique()
                ->count(),
            'failed_attempts' => Message::whereNull('email')->orWhere('email', '')->count(),
        ];

        $pageMeta = [
            'title' => 'Log Aktivitas',
            'subtitle' => 'Riwayat audit sistem dan manipulasi data',
        ];

        return view('admin.notifications', [
            'activities' => $activities->all(),
            'stats' => $stats,
            'pageMeta' => $pageMeta,
        ]);
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

        // Calculate dynamic trend for Pemasukan
        $currentMonthIncomes = Donation::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $lastMonthIncomes = Donation::where('status', 'success')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('amount');

        if ($lastMonthIncomes > 0) {
            $incomeTrend = round((($currentMonthIncomes - $lastMonthIncomes) / $lastMonthIncomes) * 100);
        } else {
            $incomeTrend = $currentMonthIncomes > 0 ? 100 : 0;
        }

        $incomeTrendStatus = $incomeTrend >= 0 ? 'up' : 'down';
        $incomeTrendText = ($incomeTrend >= 0 ? '+' : '') . $incomeTrend . '%';

        $campaigns = Campaign::with('updates')->orderByDesc('created_at')->get();
        $donors = Donor::orderByDesc('last_donation')->orderByDesc('created_at')->get();

        $campaignPool = $campaigns->values();
        $campaignPoolCount = max($campaignPool->count(), 1);

        $filteredIncomes = Donation::with(['donor', 'campaign'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function (Donation $donation) {
                return [
                    'id'       => $donation->id,
                    'nama'     => $donation->is_anonymous ? 'Hamba Allah' : ($donation->donor->name ?? 'Anonim'),
                    'category' => $donation->campaign->title ?? ($donation->campaign->category ?? 'Donasi Umum'),
                    'notes'    => $donation->prayer,
                    'amount'   => (int) $donation->amount,
                    'status'   => $donation->status === 'success' ? 'berhasil' : $donation->status,
                    'date'     => $donation->created_at->format('Y-m-d'),
                ];
            })
            ->all();

        // Ambil data penyaluran REAL dari tabel beneficiaries (bukan estimasi ratio)
        $beneficiariesByProgram = Beneficiary::query()
            ->select('program_name', 'name', 'location', 'assistance_value')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('program_name');

        $beneficiaryValueByProgram = $beneficiariesByProgram->map(
            fn ($group) => $group->sum('assistance_value')
        );

        $laporanItems = $campaigns
            ->map(function (Campaign $campaign) use ($beneficiariesByProgram, $beneficiaryValueByProgram): array {
                $pemasukan   = (int) $campaign->collected;
                // Tersalurkan = total nilai penyaluran ke penerima manfaat (data real dari tabel beneficiaries)
                $disalurkan  = (int) ($beneficiaryValueByProgram[$campaign->title] ?? 0);
                $sisa        = max($pemasukan - $disalurkan, 0);
                $penerima    = isset($beneficiariesByProgram[$campaign->title])
                    ? $beneficiariesByProgram[$campaign->title]->count()
                    : 0;

                // Detail list penerima untuk modal
                $penerimaList = isset($beneficiariesByProgram[$campaign->title])
                    ? $beneficiariesByProgram[$campaign->title]->map(fn ($b) => [
                        'nama'   => $b->name,
                        'lokasi' => $b->location,
                        'nilai'  => (int) $b->assistance_value,
                    ])->values()->all()
                    : [];

                return [
                    'id'           => $campaign->id,
                    'program'      => $campaign->title,
                    'kategori'     => $campaign->category ?: 'Umum',
                    'pemasukan'    => $pemasukan,
                    'disalurkan'   => $disalurkan,
                    'sisa'         => $sisa,
                    'penerima'     => $penerima,
                    'penerimaList' => $penerimaList,
                    'updates'      => $campaign->updates->map(fn($u) => [
                        'id' => $u->id,
                        'title' => $u->title,
                        'content' => $u->content,
                        'image' => $u->image,
                        'created_at' => $u->created_at->format('Y-m-d H:i')
                    ])->all(),
                    'periode'      => $campaign->deadline
                        ? date('M Y', strtotime((string) $campaign->deadline))
                        : ($campaign->created_at ? date('M Y', strtotime((string) $campaign->created_at)) : null),
                    'status'       => $campaign->status === 'selesai' ? 'selesai' : 'berjalan',
                ];
            })
            ->values()
            ->all();

        $totalPemasukanGlobal  = collect($laporanItems)->sum('pemasukan');
        $totalDisalurkanGlobal = collect($laporanItems)->sum('disalurkan');
        $totalSisaGlobal       = collect($laporanItems)->sum('sisa');

        $pageMeta = [
            'title'    => 'Keuangan Transparansi',
            'subtitle' => 'Pantau pemasukan, penyaluran, dan laporan dana',
        ];

        return view('admin.keuangantransparansi', compact(
            'activeMasterTab',
            'incomeSearch',
            'incomeFilterTab',
            'campaigns',
            'filteredIncomes',
            'laporanItems',
            'totalPemasukanGlobal',
            'totalDisalurkanGlobal',
            'totalSisaGlobal',
            'incomeTrendStatus',
            'incomeTrendText',
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
            'logoUrl' => $settings->get('site_logo') ?: asset('images/Logo.png'),
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
            ['key' => 'campaign', 'label' => 'Campaign Landing', 'route' => 'admin.campaign'],
            ['key' => 'focus', 'label' => 'Fokus Area', 'route' => 'admin.focusareas'],
            ['key' => 'about', 'label' => 'Profil Lembaga', 'route' => 'admin.aboutus'],
            ['key' => 'faqs', 'label' => 'Tanya Jawab', 'route' => 'admin.faqs'],
            ['key' => 'partners', 'label' => 'Mitra Kami', 'route' => 'admin.partners'],
            ['key' => 'identity', 'label' => 'Website Identity', 'route' => 'admin.identity'],
        ];

        $pageMeta = [
            'title' => 'Landing Manager',
            'subtitle' => 'Pusat pengelolaan konten landing page',
        ];

        return view('admin.landing-manager', compact('tabs', 'pageMeta'));
    }

    public function legal(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');

        $legal = [
            'privacyPolicy' => $settings->get('legal_privacy_policy') ?: '',
            'termsConditions' => $settings->get('legal_terms_conditions') ?: '',
        ];

        $pageMeta = [
            'title' => 'Kebijakan & Privasi',
            'subtitle' => 'Kelola kebijakan privasi dan syarat & ketentuan website',
        ];

        return view('admin.legal', compact('legal', 'pageMeta'));
    }

    private function buildDashboardFeedItems(): array
    {
        $feedItems = collect()
            ->merge(
                Donor::orderByDesc('last_donation')
                    ->orderByDesc('created_at')
                    ->limit(4)
                    ->get()
                    ->map(function (Donor $donor): array {
                        $timestamp = $donor->last_donation ?? $donor->created_at;

                        return [
                            'event' => 'Donasi Masuk ('.$this->formatCurrency((int) $donor->total_donation).')',
                            'detail' => 'Dari '.$donor->name,
                            'time' => $timestamp?->diffForHumans() ?? 'Baru saja',
                            'type' => 'in',
                            'timestamp' => $timestamp,
                        ];
                    })
            )
            ->merge(
                Beneficiary::orderByDesc('created_at')
                    ->limit(3)
                    ->get()
                    ->map(function (Beneficiary $beneficiary): array {
                        return [
                            'event' => 'Penyaluran ('.$this->formatCurrency((int) $beneficiary->assistance_value).')',
                            'detail' => 'Untuk '.$beneficiary->name.' - '.($beneficiary->program_name ?: 'Program Umum'),
                            'time' => $beneficiary->created_at?->diffForHumans() ?? 'Baru saja',
                            'type' => 'out',
                            'timestamp' => $beneficiary->created_at,
                        ];
                    })
            )
            ->merge(
                Campaign::orderByDesc('updated_at')
                    ->limit(3)
                    ->get()
                    ->map(function (Campaign $campaign): array {
                        return [
                            'event' => 'Campaign Diperbarui',
                            'detail' => 'Program: '.$campaign->title,
                            'time' => $campaign->updated_at?->diffForHumans() ?? 'Baru saja',
                            'type' => 'sys',
                            'timestamp' => $campaign->updated_at,
                        ];
                    })
            )
            ->sortByDesc(static fn (array $item): int => $item['timestamp']?->getTimestamp() ?? 0)
            ->take(5)
            ->values();

        if ($feedItems->isEmpty()) {
            return [
                [
                    'event' => 'Belum ada aktivitas terbaru',
                    'detail' => 'Data akan muncul otomatis setelah ada transaksi.',
                    'time' => 'Baru saja',
                    'type' => 'sys',
                ],
            ];
        }

        return $feedItems
            ->map(static function (array $item): array {
                return [
                    'event' => $item['event'],
                    'detail' => $item['detail'],
                    'time' => $item['time'],
                    'type' => $item['type'],
                ];
            })
            ->all();
    }

    private function ratioPercent(int $value, int $total): int
    {
        if ($total <= 0) {
            return 0;
        }

        return (int) round(($value / $total) * 100);
    }

    private function formatCurrency(int $value): string
    {
        return 'Rp '.number_format($value, 0, ',', '.');
    }

    private function formatCurrencyShort(int $value): string
    {
        if ($value >= 1000000000) {
            return 'Rp '.number_format($value / 1000000000, 1, ',', '.').' Miliar';
        }

        if ($value >= 1000000) {
            return 'Rp '.number_format($value / 1000000, 1, ',', '.').' Juta';
        }

        return $this->formatCurrency($value);
    }
}
