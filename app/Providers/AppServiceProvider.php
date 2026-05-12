<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $defaults = [
            'site_name' => 'Himpunan Mahasiswa Teknologi Pangan Unpad',
            'site_short_name' => 'HMT-Unpad',
            'site_logo' => asset('images/Logo.png'),
            'newsletter_title' => 'Newsletter',
            'newsletter_description' => 'Dapatkan laporan bulanan dan kabar baik penyaluran dana langsung ke email Anda.',
            'newsletter_cta_text' => 'Berlangganan',
            'newsletter_placeholder' => 'Alamat email Anda...',
            'footer_tagline' => 'Platform konektivitas, galang dana, dan transparansi organisasi terpercaya. Bersama memberdayakan masyarakat dan mencetak dampak positif setiap harinya.',
            'phone' => '+62 811 2233 4455',
            'email' => 'hmt@unpad.ac.id',
            'address' => 'Sekretariat Utama, Gedung Kemahasiswaan Lt. 2, Jatinangor',
            'instagram_url' => '#',
            'whatsapp_url' => '#',
            'footer_copyright' => 'HMT-Unpad. All rights reserved.',
            'nav_who_we_are_label' => 'Siapa Kami',
            'nav_what_we_do_label' => 'Apa Yang Kami Lakukan',
            'nav_move_together_label' => 'Bergerak Bersama',
            'nav_about_label' => 'Tentang Kami',
            'nav_contact_label' => 'Hubungi Kami',
            'nav_programs_label' => 'Program Galang Dana',
            'nav_focus_areas_label' => 'Pilar Fokus Program',
            'nav_gallery_label' => 'Galeri Dokumentasi',
            'nav_faq_label' => 'FAQ (Tanya Jawab)',
            'nav_get_involved_label' => 'Pendaftaran Relawan',
            'nav_donate_button_text' => 'Donasi Sekarang',
        ];

        $siteSettings = $defaults;

        try {
            if (Schema::hasTable('site_settings')) {
                $fromDatabase = SiteSetting::query()->pluck('value', 'key')->all();
                $siteSettings = array_merge($defaults, $fromDatabase);
            }
        } catch (\Throwable) {
            // Ignore errors during early bootstrap/migration stages and keep defaults.
        }

        View::share('siteSettings', $siteSettings);
    }
}
