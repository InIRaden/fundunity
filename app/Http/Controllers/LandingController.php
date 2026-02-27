<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.home');
    }

    public function about()
    {
        return view('landing.about');
    }

    public function programs()
    {
        return view('landing.programs');
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
