<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showPage(Request $request)
    {
        // Fetch theme from session or default to 'light'
        $theme = $request->session()->get('theme', 'light'); 
        return view('your-view', ['theme' => $theme]);
    }
    public function index()
    {
        return view('admin'); // This assumes your admin blade view is named admin.blade.php
    }
    public function login()
    {
        return view('form.login'); // Return the view for the login page
    }
    public function signup()
    {
        return view('form.signup'); // Return the view for the login page
    }
    public function home()
    {
        return view('pages.home'); // Return the view for the home page
    }
    public function announcements()
    {
        return view('pages.announcements.announcements'); // Return the view for the home page
    }
    public function events()
    {
        return view('pages.events.events'); // Return the view for the home page
    }
    public function shelters()
    {
        return view('pages.shelters.shelters'); // Return the view for the home page
    }
    public function browse()
    {
        return view('pages.browse.browse'); // Return the view for the home page
    }
    public function posts()
    {
        return view('pages.posts.posts'); // Return the view for the home page
    }
    public function profile()
    {
        return view('pages.profile.profile'); // Return the view for the home page
    }
    public function TermsOfService()
    {
        return view('pages.site.TermsOfService'); // Return the view for the home page
    }
    public function PrivacyPolicy()
    {
        return view('pages.site.PrivacyPolicy'); // Return the view for the home page
    }
}
