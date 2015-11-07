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

//Post Login and Start Session
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@authenticate']);

// Log Out and End Session
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

//Show Forgot Pass Page
Route::get('password/email', ['as' => 'password/email', 'uses' => 'Auth\PasswordController@index']);

//Post Email to be Recovered
Route::post('password/email', ['as' => 'password/postEmail', 'uses' => 'Auth\PasswordController@sendLink']);

//Show Password Reset Form
Route::get('password/reset/{email}/{activation_code}',
    [
        'as' => 'password/reset/',
        'uses' => 'Auth\PasswordController@reset',
    ]);
//Grant Request for new password
Route::post('password/reset', ['as' => 'password/postReset', 'uses' => 'Auth\PasswordController@save']);



//Activates The User Account
Route::get('account/activate/{email}/{activation_code}','Auth\AuthController@activate');
//Send Activation Link to New Registered User
Route::post('activate/link', ['as' => 'account/activate/link', 'uses' => 'Auth\AuthController@sendActivationLink']);

//Ask to Resend a Verification Email for Activation
Route::get('/resendEmail', 'Auth\AuthController@resendEmail');

// Route::get('{link?}', ['as' => 'reflink', 'uses' => 'LinkController@getRefLink']);

Route::get('@{user?}', ['as' => 'username', 'uses' => 'LinkController@getUserProfile']);







//post signup form - CREATE THIS NOW!
Route::post('signup', ['as' => 'signup', 'uses' => 'Auth\AuthController@create']); // Not working




// //Update user account data
// Route::put('profile', ['as' => 'profile/update', 'uses' => 'UserController@update']); // Not working yet









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


