<?php

namespace App\Http\Controllers;

use App\Models\AboutUsItem;
use App\Models\Donor;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Partner;
use App\Models\FocusArea;
use App\Models\GalleryItem;
use App\Models\ImageSlider;
use App\Models\Page;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LandingController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->first();

        $sliderItems = ImageSlider::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $homePrograms = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $homeGallery = GalleryItem::where('is_active', true)
            ->where('type', 'image')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        $homeVideo = GalleryItem::where('is_active', true)
            ->where('type', 'video')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->first();

        $homePartners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        $homeFocusAreas = FocusArea::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        return view('landing.home', compact('page', 'sliderItems', 'homePrograms', 'homeGallery', 'homeVideo', 'homePartners', 'homeFocusAreas'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->first();

        $generalProfile = AboutUsItem::where('section', 'general')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $strukturData = AboutUsItem::where('section', 'structure')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $missionItems = collect();
        $organizationValues = collect();
        $teamMembers = collect();
        $impactStats = collect();

        if (Schema::hasTable('mission_items')) {
            $missionItems = DB::table('mission_items')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        if (Schema::hasTable('organization_values')) {
            $organizationValues = DB::table('organization_values')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        if (Schema::hasTable('team_members')) {
            $teamMembers = DB::table('team_members')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        if (Schema::hasTable('impact_stats')) {
            $impactStats = DB::table('impact_stats')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('landing.about', compact('page', 'generalProfile', 'strukturData', 'missionItems', 'organizationValues', 'teamMembers', 'impactStats'));
    }

    public function programs()
    {
        $programs = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.programs', compact('programs'));
    }

    public function focusAreas()
    {
        $focusAreas = FocusArea::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.focus-areas', compact('focusAreas'));
    }

    public function gallery()
    {
        $galleryItems = GalleryItem::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.gallery', compact('galleryItems'));
    }

    public function partners()
    {
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

        return view('landing.partners', compact('partners', 'partnerGroups'));
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function donationForm()
    {
        return view('landing.donation');
    }

    public function submitDonation(Request $request)
    {
        $validated = $request->validateWithBag('donation', [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:190', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i'],
            'amount' => ['required', 'integer', 'min:1000'],
            'note' => ['nullable', 'string', 'max:3000'],
        ], [
            'email.regex' => 'Email donasi harus menggunakan akun Gmail.',
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

        $summary = 'DONASI PUBLIK - Nominal: Rp '.number_format((int) $validated['amount'], 0, ',', '.').'.';
        $notes = trim((string) ($validated['note'] ?? ''));

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $notes !== '' ? $summary."\nCatatan: ".$notes : $summary,
            'is_read' => false,
            'read_at' => null,
        ]);

        return back()->with('donation_success', 'Donasi berhasil dikirim. Terima kasih atas kontribusi Anda.');
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
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('landing.faq', compact('faqs'));
    }

    public function getInvolved()
    {
        $involvementTypes = collect();
        $involvementBenefits = collect();

        if (Schema::hasTable('involvement_types')) {
            $involvementTypes = DB::table('involvement_types')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        if (Schema::hasTable('involvement_benefits')) {
            $involvementBenefits = DB::table('involvement_benefits')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('landing.get-involved', compact('involvementTypes', 'involvementBenefits'));
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

    public function privacy()
    {
        return view('landing.privacy');
    }

    public function terms()
    {
        return view('landing.terms');
    }
}
