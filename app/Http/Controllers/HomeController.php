<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display home view.
     *
     * @return view
     */
    public function index()
    {
        return \View::make('pages.parallax');
    }
}
