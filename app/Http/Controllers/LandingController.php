<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Program;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->first();

        return view('landing.home', compact('page'));
    }

    public function about()
    {
        return view('landing.about');
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
        return view('landing.focus-areas');
    }

    public function gallery()
    {
        return view('landing.gallery');
    }

    public function partners()
    {
        return view('landing.partners');
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function faq()
    {
        return view('landing.faq');
    }

    public function getInvolved()
    {
        return view('landing.get-involved');
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // TODO: Implement newsletter subscription logic
        // For now, just redirect back with success message
        return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
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
