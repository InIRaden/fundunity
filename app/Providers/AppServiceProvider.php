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
            'site_name' => 'Komunitas Ruang Berbagi',
            'site_logo' => 'https://via.placeholder.com/50x50/22c55e/ffffff?text=KRB',
            'newsletter_title' => 'Bergabunglah Bersama Kami',
            'newsletter_description' => 'Dapatkan pembaruan terbaru seputar program, kisah inspiratif, dan kesempatan berkontribusi.',
            'newsletter_cta_text' => 'Berlangganan',
            'newsletter_placeholder' => 'Masukkan email Anda',
            'footer_tagline' => 'Membantu individu dan organisasi mendukung berbagai aksi nyata demi dunia yang lebih baik.',
            'phone' => '0821 - 1677 - 1146',
            'email' => 'komunitasruangberbagi@gmail.com',
            'address' => 'Bandung, Jawa Barat, Indonesia',
            'instagram_url' => 'https://instagram.com/komunitasruangberbagi',
            'whatsapp_url' => 'https://whatsapp.com/channel/0029VazY3qSFXUuUlnV5VQ0q',
            'footer_copyright' => 'Komunitas Ruang Berbagi. Semua hak dilindungi.',
            'nav_who_we_are_label' => 'Siapa Kami',
            'nav_what_we_do_label' => 'Apa Yang Kami Lakukan',
            'nav_move_together_label' => 'Bersama Bergerak',
            'nav_about_label' => 'Tentang KRB',
            'nav_contact_label' => 'Kontak',
            'nav_programs_label' => 'Program',
            'nav_focus_areas_label' => 'Fokus Area',
            'nav_gallery_label' => 'Galeri Lainnya',
            'nav_faq_label' => 'FAQ',
            'nav_get_involved_label' => 'Terlibat',
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
