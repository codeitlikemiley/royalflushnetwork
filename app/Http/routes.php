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

//Get home view
Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);
//show profile edit form
Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@edit']);

//show login/signup form
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);

//post login form
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@authenticate']);

//logut route
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

//get recovery password form
Route::get('password/email', ['as' => 'password/email', 'uses' => 'Auth\PasswordController@index']);

//send recovery link by email
Route::post('password/email', ['as' => 'password/postEmail', 'uses' => 'Auth\PasswordController@sendLink']);

//get new password form
Route::get('password/reset/{email}/{activation_code}',
    [
        'as' => 'password/reset/',
        'uses' => 'Auth\PasswordController@reset',
    ]);
//post new password form
Route::post('password/reset', ['as' => 'password/postReset', 'uses' => 'Auth\PasswordController@save']);

//Resend and Vefify Email
Route::get('/resendEmail', 'Auth\AuthController@resendEmail');

//account activation uses $user->email , $user->activation_code fields
Route::get('account/activate/{email}/{activation_code}','Auth\AuthController@activate');
//re-send activation link by email
Route::post('activate/link', ['as' => 'account/activate/link', 'uses' => 'Auth\AuthController@sendActivationLink']);






//Update user account data
Route::put('profile', ['as' => 'profile/update', 'uses' => 'UserController@update']); // Not working yet


//post signup form
Route::post('signup', ['as' => 'signup', 'uses' => 'Auth\AuthController@create']); // Not working






//Route::get('/vue', function(){
//	return view('vue');
//});
//
//Route::get('api/users', function(){
//	return App\User::all();
//});
//
//Route::post('api/users', function(){
//	 App\User::create(Request::all());
//});
//
//Route::get('api/user/{search}', array('as' => 'search', function(Request $request, $search){
//	$user = Input::get('search');
//	$user = App\User::where('name', 'LIKE', '%'.$search.'%')->get();
//	return $user; // returning a USER sample is Tito
//}));








//Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');


