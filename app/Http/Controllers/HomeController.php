<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display home view
     *
     * @return view
     */
    public function index()
    {
        return \View::make('pages.parallax');
    }
}
