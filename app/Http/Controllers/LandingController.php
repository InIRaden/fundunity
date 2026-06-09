<?php

namespace App\Http\Controllers;

use App\Models\AboutUsItem;
use App\Models\Campaign;
use App\Models\Donor;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\FocusArea;
use App\Models\GalleryItem;
use App\Models\ImageSlider;
use App\Models\Page;
use App\Models\Volunteer;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LandingController extends Controller
{
    private function loadSiteSettings(): array
    {
        return \App\Models\SiteSetting::query()->pluck('value', 'key')->all();
    }

    public function index()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_home_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $page = Page::where('slug', 'home')->first();

        $sliderItems = ImageSlider::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $homeCampaigns = Campaign::where('is_active', true)
            ->where('status', 'aktif')
            ->orderBy('deadline')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        $homeFocusAreas = FocusArea::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $homePartners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        $impactStats = [
            'donor_count' => Donor::where('is_active', true)->count(),
            'distributed_amount' => (int) Campaign::where('is_active', true)->sum('collected'),
            'completed_programs' => Campaign::where('is_active', true)->where('status', 'selesai')->count(),
            'volunteer_count' => Volunteer::where('status', 'aktif')->count() ?: Volunteer::count(),
        ];

        return view('landing.home', compact(
            'siteSettings',
            'page',
            'sliderItems',
            'homeCampaigns',
            'homeFocusAreas',
            'homePartners',
            'impactStats'
        ));
    }

    public function about()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_about_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $page = Page::where('slug', 'about')->first();

        $generalProfile = AboutUsItem::where('section', 'general')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $homePartners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        $impactStats = [
            'donor_count' => Donor::where('is_active', true)->count(),
            'distributed_amount' => (int) Campaign::where('is_active', true)->sum('collected'),
            'completed_programs' => Campaign::where('is_active', true)->where('status', 'selesai')->count(),
            'volunteer_count' => Volunteer::where('status', 'aktif')->count() ?: Volunteer::count(),
        ];

        return view('landing.about', compact('siteSettings', 'page', 'generalProfile', 'homePartners', 'impactStats'));
    }

    public function team()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_team_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.team', compact('siteSettings', 'teamMembers'));
    }

    public function programs()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_programs_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $campaigns = Campaign::where('is_active', true)
            ->where('status', 'aktif')
            ->orderBy('deadline')
            ->orderByDesc('created_at')
            ->get();

        $categories = $campaigns
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();

        return view('landing.programs', compact('siteSettings', 'campaigns', 'categories'));
    }

    public function campaignDetail(Campaign $campaign)
    {
        if (! $campaign->is_active) {
            abort(404);
        }

        $campaign->load(['updates' => function ($query) {
            $query->orderByDesc('created_at');
        }]);

        $recentDonations = Donation::with('donor')
            ->where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $prayers = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->whereNotNull('prayer')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('landing.campaign-detail', compact('campaign', 'recentDonations', 'prayers'));
    }

    public function focusAreas()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_focus_areas_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $focusAreas = FocusArea::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $impactStats = [
            'donor_count' => Donor::where('is_active', true)->count(),
            'distributed_amount' => (int) Campaign::where('is_active', true)->sum('collected'),
            'completed_programs' => Campaign::where('is_active', true)->where('status', 'selesai')->count(),
            'volunteer_count' => Volunteer::where('status', 'aktif')->count() ?: Volunteer::count(),
        ];

        $activeCampaignCount = Campaign::where('is_active', true)->where('status', 'aktif')->count();

        return view('landing.focus-areas', compact('siteSettings', 'focusAreas', 'impactStats', 'activeCampaignCount'));
    }

    public function gallery()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_gallery_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $galleryItems = GalleryItem::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.gallery', compact('siteSettings', 'galleryItems'));
    }

    public function partners()
    {
        $siteSettings = $this->loadSiteSettings();

        $partners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $partnerGroups = [
            'corporate' => $partners->where('type', 'corporate')->values(),
            'ngo' => $partners->where('type', 'ngo')->values(),
            'government' => $partners->where('type', 'government')->values(),
            'other' => $partners->where('type', 'other')->values(),
        ];

        $impactStats = [
            'donor_count' => Donor::where('is_active', true)->count(),
            'distributed_amount' => (int) Campaign::where('is_active', true)->sum('collected'),
            'completed_programs' => Campaign::where('is_active', true)->where('status', 'selesai')->count(),
            'volunteer_count' => Volunteer::where('status', 'aktif')->count() ?: Volunteer::count(),
        ];

        return view('landing.partners', compact('siteSettings', 'partnerGroups', 'impactStats'));
    }

    public function contact()
    {
        $siteSettings = $this->loadSiteSettings();
        // Tidak ada flag landing_menu_contact_enabled di UI saat ini, jadi tidak diblokir.


        return view('landing.contact', compact('siteSettings'));
    }

    public function donationForm(?Campaign $campaign = null)
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_donate_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }

        $qrisUrl = \App\Models\SiteSetting::where('key', 'payment_qris_url')->value('value');


        return view('landing.donation', [
            'selectedCampaign' => $campaign,
            'qrisUrl' => $qrisUrl,
        ]);
    }

    public function submitDonation(Request $request)
    {
        $validated = $request->validateWithBag('donation', [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'max:190'],
            'amount' => ['required', 'integer', 'min:1000'],
            'campaign_id' => ['nullable', 'integer', 'exists:campaigns,id'],
            'note' => ['nullable', 'string', 'max:3000'],
            'is_anonymous' => ['nullable', 'boolean'],
        ]);

        $donor = Donor::where('email', $validated['email'])->first();

        if ($donor) {
            $donor->update([
                'name' => $validated['name'],
                'total_donation' => ((int) $donor->total_donation) + (int) $validated['amount'],
                'last_donation' => now()->toDateString(),
                'is_active' => true,
            ]);
        } else {
            $donor = Donor::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'total_donation' => (int) $validated['amount'],
                'last_donation' => now()->toDateString(),
                'is_active' => true,
            ]);
        }

        $campaign = null;

        if (! empty($validated['campaign_id'])) {
            $campaign = Campaign::find($validated['campaign_id']);

            if ($campaign) {
                $campaign->increment('collected', (int) $validated['amount']);
            }
        }

        // Record the transaction in the donations table
        $donation = Donation::create([
            'transaction_id' => 'DON-' . strtoupper(Str::random(10)),
            'campaign_id' => $validated['campaign_id'] ?? null,
            'donor_id' => $donor->id,
            'amount' => (int) $validated['amount'],
            'status' => 'success',
            'prayer' => $validated['note'] ?? null,
            'is_anonymous' => $request->boolean('is_anonymous'),
        ]);

        return back()
            ->with('donation_success', 'Donasi berhasil dikirim. Terima kasih atas kontribusi Anda.')
            ->with('donation_amount', (int) $validated['amount'])
            ->with('donation_name', $donation->is_anonymous ? 'Hamba Allah' : $validated['name'])
            ->with('donation_transaction', $donation->transaction_id);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:190'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'is_read' => false,
            'read_at' => null,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim. Tim kami akan segera merespons.');
    }

    public function faq()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_faq_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.faq', compact('siteSettings', 'faqs'));
    }

    public function getInvolved()
    {
        $siteSettings = $this->loadSiteSettings();
        if (($siteSettings['landing_menu_get_involved_enabled'] ?? '1') !== '1') {
            return response()->view('feature-off', [
                'message' => 'Maaf ya, menu ini sedang tidak aktif sementara waktu. Yuk, kembali ke Beranda dan jelajahi program kebaikan kami yang lain!',
            ], 503);
        }


        $involvementTypes = collect();


        if (Schema::hasTable('involvement_types')) {
            $involvementTypes = DB::table('involvement_types')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
            } else {
                // Provide default categories if table doesn't exist
                $involvementTypes = collect([
                    (object) ['title' => 'Acara Sosial', 'id' => 1],
                    (object) ['title' => 'Relawan Lapangan', 'id' => 2],
                    (object) ['title' => 'Digital Media', 'id' => 3],
                    (object) ['title' => 'Kemitraan', 'id' => 4],
                ]);
        }

            $involvementBenefits = collect();
        if (Schema::hasTable('involvement_benefits')) {
            $involvementBenefits = DB::table('involvement_benefits')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('landing.get-involved', compact('siteSettings', 'involvementTypes', 'involvementBenefits'));
    }

    public function submitGetInvolved(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:30'],
            'category' => ['required', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        Volunteer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'category' => $validated['category'],
            'is_verified' => false,
            'registered_at' => now()->toDateString(),
            'is_active' => true,
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => 'PENDAFTARAN RELAWAN - Kategori: '.$validated['category'].'. '
                .($validated['message'] ? 'Pesan: '.$validated['message'] : 'Tanpa pesan tambahan.')
                .' No HP: '.$validated['phone'],
            'is_read' => false,
            'read_at' => null,
        ]);

        return back()->with('volunteer_success', 'Pendaftaran relawan berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }

    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['nullable', 'string', 'max:200'],
        ]);

        if (! Schema::hasTable('newsletter_subscribers')) {
            return back()->with('newsletter_error', 'Fitur newsletter belum tersedia. Silakan hubungi admin sistem.');
        }

        $existing = DB::table('newsletter_subscribers')
            ->where('email', $validated['email'])
            ->first();

        if ($existing) {
            DB::table('newsletter_subscribers')
                ->where('id', $existing->id)
                ->update([
                    'name' => $validated['name'] ?? $existing->name,
                    'is_active' => true,
                    'subscribed_at' => now(),
                    'updated_at' => now(),
                ]);

            return back()->with('newsletter_success', 'Email Anda sudah terdaftar. Status langganan diperbarui.');
        }

        DB::table('newsletter_subscribers')->insert([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
            'subscribed_at' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('newsletter_success', 'Terima kasih telah berlangganan newsletter kami!');
    }

}
