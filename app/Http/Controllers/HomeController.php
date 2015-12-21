<?php

namespace App\Http\Controllers;

use App\Profile;
use Cache;

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

    public function latestUserSignup()
    {
    	$value = Cache::rememberForever('users', function () {
    	return Profile::latest()->take(50)->select('display_name', 'created_at')->get();
		});
		return $value = Cache::pull('users');
    }
}
