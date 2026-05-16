<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function privacy(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');
        $content = $settings->get('legal_privacy_policy') ?: 'Kebijakan Privasi belum tersedia. Silakan hubungi administrator.';

        return view('landing.privacy', [
            'content' => $content,
            'siteName' => $settings->get('site_name') ?: 'FundUnity',
        ]);
    }

    public function terms(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');
        $content = $settings->get('legal_terms_conditions') ?: 'Syarat & Ketentuan belum tersedia. Silakan hubungi administrator.';

        return view('landing.terms', [
            'content' => $content,
            'siteName' => $settings->get('site_name') ?: 'FundUnity',
        ]);
    }
}
