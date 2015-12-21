<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

//Get home view
Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);
//show profile edit form
Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@edit']);

//show login/signup form
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);

//Post Login and Start Session
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@authenticate']);

// Log Out and End Session
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

//Show Forgot Pass Page
Route::get('password/email', ['as' => 'password/email', 'uses' => 'Auth\PasswordController@index']);

//Post Email to be Recovered
Route::post('password/email', ['as' => 'password/postEmail', 'uses' => 'Auth\PasswordController@sendLink']);

//Show Password Reset Form
Route::get('password/reset/{email}/{activation_code}', ['as' => 'password/reset/', 'uses' => 'Auth\PasswordController@reset']);
//Grant Request for new password
Route::post('password/reset', ['as' => 'password/postReset', 'uses' => 'Auth\PasswordController@save']);

//Activates The User Account
Route::get('account/activate/{email}/{activation_code}', 'Auth\AuthController@activate');
//Send Activation Link to New Registered User
Route::post('activate/link', ['as' => 'account/activate/link', 'uses' => 'Auth\AuthController@sendActivationLink']);

//Ask to Resend a Verification Email for Activation
Route::get('/resendEmail', 'Auth\AuthController@resendEmail');

// Register A New User
Route::post('signup', ['as' => 'signup', 'uses' => 'Auth\AuthController@create']);

 // Route For Searching For a Sponsor Thru Ajax
Route::post('searchUser', 'SearchController@searchUser');
// Route For AutoComplete
Route::get('search/autocomplete', 'SearchController@autocomplete');

//Load Referral Link of A User {NOTE: ALWAYS MAKE THIS THE LAST LINE IN ROUTE!}
Route::get('{link?}', ['as' => 'reflink', 'uses' => 'LinkController@showRefLink']);



});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "api" middleware group to every route
| it contains. The "api" middleware group is defined in your HTTP
| kernel and includes Throttle with 60 Request Per Min Rate by Default.
|
*/
Route::group(['middleware' => 'api'], function () {
// Get Latest User Sign Up for the NewsBar
Route::get('/api/users', 'HomeController@latestUserSignup');

});
