<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('site_settings')) {
            return;
        }

        $menuKeys = [
            // Admin sidebar
            'admin_menu_dashboard_enabled',
            'admin_menu_campaign_enabled',
            'admin_menu_keuangantransparansi_enabled',
            'admin_menu_databasestakeholder_enabled',
            'admin_menu_messages_enabled',
            'admin_menu_gallery_enabled',
            'admin_menu_aboutus_enabled',
            'admin_menu_members_enabled',
            'admin_menu_focusareas_enabled',
            'admin_menu_imageslider_enabled',
            'admin_menu_partners_enabled',
            'admin_menu_faqs_enabled',
            'admin_menu_legal_enabled',
            'admin_menu_settings_enabled',
            'admin_menu_management_enabled',

            // Landing navbar
            'landing_menu_home_enabled',
            'landing_menu_about_enabled',
            'landing_menu_team_enabled',
            'landing_menu_focus_areas_enabled',
            'landing_menu_programs_enabled',
            'landing_menu_gallery_enabled',
            'landing_menu_faq_enabled',
            'landing_menu_get_involved_enabled',
            'landing_menu_donate_enabled',
        ];

        foreach ($menuKeys as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => (SiteSetting::query()->where('key', $key)->exists())
                        ? (SiteSetting::query()->where('key', $key)->value('value') ?? '1')
                        : '1',
                    'type' => 'text',
                    'group' => 'menu',
                    'label' => ucwords(str_replace('_', ' ', $key)),
                ]
            );
        }
    }

    public function down(): void
    {
        // Jangan hapus record agar tidak membatalkan setting user.
    }
};

