<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminUiController extends Controller
{
    public function aboutUs(): View
    {
        $generalProfile = [
            [
                'id' => 1,
                'nama' => 'Visi Kami',
                'description' => 'Menjadi platform donasi terpercaya yang menghubungkan kebaikan dengan yang membutuhkan.',
                'imageUrl' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1474&q=80',
            ],
            [
                'id' => 2,
                'nama' => 'Misi Kami',
                'description' => 'Memberdayakan komunitas melalui transparansi dan akuntabilitas dalam pengelolaan dana sosial.',
                'imageUrl' => 'https://images.unsplash.com/photo-1542601906990-24d4c16419d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80',
            ],
        ];

        $strukturData = [
            ['id' => 101, 'jabatan' => 'Ketua Umum', 'nama' => 'Rio Pangestu', 'description' => 'Informatika - 2021', 'imageUrl' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=400&fit=crop'],
            ['id' => 102, 'jabatan' => 'Wakil Ketua', 'nama' => 'Siti Aminah', 'description' => 'Matematika - 2021', 'imageUrl' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&h=400&fit=crop'],
            ['id' => 103, 'jabatan' => 'Sekretaris Jenderal', 'nama' => 'Ahmad Dahlan', 'description' => 'Geofisika - 2022', 'imageUrl' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=400&fit=crop'],
            ['id' => 104, 'jabatan' => 'Bendahara Umum', 'nama' => 'Diana Putri', 'description' => 'Statistika - 2022', 'imageUrl' => 'https://images.unsplash.com/photo-1554151228-14d9def656e4?w=400&h=400&fit=crop'],
        ];

        $pageMeta = [
            'title' => 'Profil Lembaga',
            'subtitle' => 'Kelola identitas, visi, misi, dan tim organisasi',
        ];

        return view('admin.aboutus', compact('generalProfile', 'strukturData', 'pageMeta'));
    }

    public function campaign(): View
    {
        $campaigns = [
            [
                'id' => 1,
                'title' => 'Bantuan Bencana Banjir NTT',
                'description' => 'Menggalang dana untuk korban banjir bandang di Nusa Tenggara Timur yang membutuhkan bantuan segera.',
                'collected' => 32500000,
                'target' => 50000000,
                'deadline' => '2025-04-30',
                'category' => 'Kebencanaan',
                'status' => 'aktif',
            ],
            [
                'id' => 2,
                'title' => 'Beasiswa Anak Yatim 2025',
                'description' => 'Program beasiswa untuk 20 anak yatim piatu berprestasi agar dapat melanjutkan pendidikan.',
                'collected' => 30000000,
                'target' => 30000000,
                'deadline' => '2025-03-01',
                'category' => 'Pendidikan',
                'status' => 'selesai',
            ],
            [
                'id' => 3,
                'title' => 'Pembangunan Sumur Warga Pelosok',
                'description' => 'Pengadaan sumur bor untuk masyarakat desa yang kesulitan akses air bersih.',
                'collected' => 4800000,
                'target' => 20000000,
                'deadline' => '2025-06-15',
                'category' => 'Kesehatan & Air Bersih',
                'status' => 'aktif',
            ],
        ];

        $searchQuery = '';
        $isModalOpen = false;
        $editingId = null;
        $form = [
            'title' => '',
            'description' => '',
            'target' => '',
            'deadline' => '',
            'category' => '',
            'status' => 'aktif',
        ];

        $pageMeta = [
            'title' => 'Campaign',
            'subtitle' => 'Kelola program galang dana dan progres pencapaian',
        ];

        return view('admin.campaign', compact('campaigns', 'searchQuery', 'isModalOpen', 'editingId', 'form', 'pageMeta'));
    }

    public function focusAreas(): View
    {
        $focusAreas = [
            ['id' => 1, 'icon' => 'ph ph-graduation-cap', 'iconName' => 'PiGraduationCap', 'title' => 'Pendidikan', 'description' => 'Memberikan pendidikan berkualitas untuk anak-anak kurang mampu agar mereka dapat mengembangkan potensinya secara optimal.'],
            ['id' => 2, 'icon' => 'ph ph-heartbeat', 'iconName' => 'PiHeartbeat', 'title' => 'Kesehatan', 'description' => 'Menyelenggarakan kampanye kesadaran kesehatan dan memberikan akses layanan kesehatan dasar bagi masyarakat yang membutuhkan.'],
            ['id' => 3, 'icon' => 'ph ph-tree', 'iconName' => 'PiTree', 'title' => 'Lingkungan', 'description' => 'Mendorong inisiatif untuk perlindungan lingkungan hidup dan keberlanjutan alam untuk generasi yang akan datang.'],
            ['id' => 4, 'icon' => 'ph ph-users', 'iconName' => 'PiUsers', 'title' => 'Komunitas', 'description' => 'Memberdayakan masyarakat melalui pengembangan keterampilan, kolaborasi, dan penguatan kapasitas kelompok.'],
        ];

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
        $messages = [
            [
                'id' => 1,
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'message' => 'Halo, saya sangat tertarik dengan program pendidikan desa yang diadakan. Apakah saya bisa ikut menyumbang buku bacaan bekas layak pakai? Jika iya, ke mana saya harus mengirimkannya?',
                'is_read' => false,
                'date' => '12 Okt 2023 10:30',
            ],
            [
                'id' => 2,
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@yahoo.com',
                'message' => 'Saya ingin menanyakan detail kolaborasi untuk acara bakti sosial bulan depan. Apakah organisasi Anda terbuka untuk bermitra dengan BEM kampus kami?',
                'is_read' => false,
                'date' => '11 Okt 2023 14:15',
            ],
            [
                'id' => 3,
                'name' => 'Ahmad Dahlan',
                'email' => 'ahmad.d@perusahaan.com',
                'message' => 'Terima kasih atas bantuan yang disalurkan ke panti asuhan kami bulan lalu. Anak-anak sangat senang dengan bingkisan yang diberikan.',
                'is_read' => true,
                'date' => '09 Okt 2023 09:00',
            ],
            [
                'id' => 4,
                'name' => 'Rina Marlina',
                'email' => 'rina.marlina88@gmail.com',
                'message' => 'Apakah ada lowongan relawan untuk kegiatan peduli lingkungan akhir tahun ini? Saya memiliki pengalaman di bidang pengolahan sampah.',
                'is_read' => true,
                'date' => '05 Okt 2023 16:45',
            ],
        ];

        $messageStats = [
            'total' => count($messages),
            'unread' => collect($messages)->where('is_read', false)->count(),
            'this_month' => count($messages),
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
        $galleryImages = [
            [
                'id' => 1,
                'title' => 'Bantuan Sembako Cianjur',
                'category' => 'Tanggap Bencana',
                'date' => '2025-01-15',
                'imageUrl' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=600',
            ],
            [
                'id' => 2,
                'title' => 'Beasiswa Anak Juara',
                'category' => 'Pendidikan',
                'date' => '2025-02-10',
                'imageUrl' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600',
            ],
            [
                'id' => 3,
                'title' => 'Renovasi Sumur Bor NTT',
                'category' => 'Infrastruktur',
                'date' => '2025-03-05',
                'imageUrl' => 'https://images.unsplash.com/photo-1541544741938-0af808871cc0?q=80&w=600',
            ],
        ];

        $pageMeta = [
            'title' => 'Galeri Aktivitas',
            'subtitle' => 'Kelola dokumentasi visual kegiatan dan bukti penyaluran',
        ];

        return view('admin.gallery', compact('galleryImages', 'pageMeta'));
    }

    public function imageSlider(): View
    {
        $sliderItems = [
            [
                'id' => 1,
                'title' => 'Selamat Datang di FundUnity',
                'description' => 'Platform berbagi kebaikan untuk sesama.',
                'imageUrl' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1470&q=80',
            ],
            [
                'id' => 2,
                'title' => 'Program Kemanusiaan',
                'description' => 'Bersama kita bisa membantu korban bencana alam.',
                'imageUrl' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=1470&q=80',
            ],
        ];

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
