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
	 App\User::create(Request::all());
});

Route::get('api/user/{search}', array('as' => 'search', function(Request $request, $search){
	$user = Input::get('search');
	$user = App\User::where('name', 'LIKE', '%'.$search.'%')->get();
	return $user; // returning a USER sample is Tito
}));


