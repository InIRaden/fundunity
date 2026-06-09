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

        $defaults = [
            // preset theme for admin UI
            'admin_theme_preset' => 'emerald',
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => 'text',
                    'group' => 'menu',
                    'label' => 'Admin Theme Preset',
                ]
            );
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('site_settings')) {
            return;
        }

        SiteSetting::query()->whereIn('key', [
            'admin_theme_preset',
        ])->delete();
    }
};

