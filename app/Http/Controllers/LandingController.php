<?php

namespace App\Http\Controllers;

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
}
