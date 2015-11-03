<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pages.parallax');
});

Route::get('/login', function(){
	return view('auth.login');
});

Route::get('/vue', function(){
	return view('vue');
});

Route::get('api/users', function(){
	return App\User::all();
});

Route::post('api/users', function(){
	return App\User::create(Request::all());
});