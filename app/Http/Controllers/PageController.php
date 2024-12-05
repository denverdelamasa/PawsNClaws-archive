<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
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
    public function posts()
    {
        return view('pages.posts.posts'); // Return the view for the home page
    }
    public function shelters()
    {
        return view('pages.shelters.shelters'); // Return the view for the home page
    }
}
