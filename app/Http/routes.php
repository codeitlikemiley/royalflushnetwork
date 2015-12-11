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
Route::get('cookie/{sponsor}', function($sponsor)
{
	$sponsor = App\Link::where('link', $sponsor)->firstOrFail();
	$response = new Illuminate\Http\Response($sponsor);

return $response->withCookie(cookie('sponsor', $sponsor, 60));
});
Route::get('getcookie', function(){
if (Cookie::get('sponsor')) {
return "GOT A SPONSOR";
}
else{ // IF NO SPONSOR DIRECT IT TO COMPANY
$sponsor = App\Link::find(1);
$response = new Illuminate\Http\Response($sponsor);
return $response->withCookie(cookie('sponsor', $sponsor, 60));	
}


});
Route::get('/cardline/ten/{lid}', ['as' => 'forceCycle', 'uses' => 'CardlineController@forceCycle']);
Route::get('/cardline/create/{lid}', ['as' => 'tenCreate', 'uses' => 'CardlineController@create']);
Route::get('/cardline/freecycle', ['as' => 'freeCycle', 'uses' => 'CardlineController@free']);
Route::get('/cardline/switchToJack/{lid}', ['as' => 'switchToJack', 'uses' => 'CardlineController@switchToJack']);
Route::get('/cardline/DynamicFlushLine', ['as' => 'DynamicFlushLine', 'uses' => 'CardlineController@DynamicFlushLine']);
Route::get('/cardline/Booster/{qty}', ['as' => 'Booster', 'uses' => 'CardlineController@Booster']);
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
Route::get('password/reset/{email}/{activation_code}', ['as' => 'password/reset/', 'uses' => 'Auth\PasswordController@reset']);
//Grant Request for new password
Route::post('password/reset', ['as' => 'password/postReset', 'uses' => 'Auth\PasswordController@save']);

//Activates The User Account
Route::get('account/activate/{email}/{activation_code}', 'Auth\AuthController@activate');
//Send Activation Link to New Registered User
Route::post('activate/link', ['as' => 'account/activate/link', 'uses' => 'Auth\AuthController@sendActivationLink']);

//Ask to Resend a Verification Email for Activation
Route::get('/resendEmail', 'Auth\AuthController@resendEmail');

// Route::get('{link?}', ['as' => 'reflink', 'uses' => 'LinkController@getRefLink']);
Route::get('materialized', function () {
    $users = App\User::latest()->get();
    $int = ((App\User::all()->count()) * 5 );
    $rfnbonus= intval($int); 
    return view('materialized', compact('users','rfnbonus'));
});

Route::get('fire', function () {
    // this fires the event
    event(new App\Events\IncreaseRfnBonus());

    return "Event Fired!";

});

Route::get('api/rfnbonus', function(){

    $rfnbonus = ((App\User::all()->count()) * 5 );
    return $rfnbonus;
});

//test route for broadcasting in the NewsBar
Route::get('sender', function () {
    $data = [
        'event' => 'UserSignedUp',
        'data'  => [
            'display_name'   => 'chill',
            'created_at'     => '2011-12-17T09:24:17Z',
        ],
    ];
    // Use this To Fire User Info In NewsBar
    // This Can Use the test-chanel in UserHasRegistered Event
    PHPRedis::publish('rfn-chanel', json_encode($data));

    return "User Signed Up!";
});

Route::get('receiver', function () {
    return view('receiver');
});
//test route for Redis set and get key
Route::get('message', function () {
    $app = PHPRedis::connection();
$app->set("masterpowers", "Yeah Baby Yeah");
print_r($app->get("masterpowers"));
});
 // Route For Searching For a Sponsor Thru Ajax
Route::post('searchUser', 'SearchController@searchUser');
// Route For AutoComplete
Route::get('search/autocomplete', 'SearchController@autocomplete');

// For For Activating First Link note User Must Be Auth! Tweak it if Dash is OK!
Route::get('activate/FirstLink', ['as' => 'get1stlink', 'uses' => 'CodeController@showActivateFirstLink']);
Route::post('activate/FirstLink', ['as' => '1stlinkactivation', 'uses' => 'CodeController@activateFirstLink']);
// after first link is activated dont show anymore this url to them
Route::post('signup', ['as' => 'signup', 'uses' => 'Auth\AuthController@create']);
// Route::get('{link?}', ['as' => 'links', 'uses' => 'LinkController@getRefLink']);

Route::get('activeSponsor/{id}', function ($id) {
    $id = App\Link::where('id', $id)->firstOrFail()->activeSponsor($id);

    return $id;

});
// Route::get('code/all', ['as' => 'codeall', 'uses' => 'CodeController@index']);
Route::get('code/{linkID}/{PINCODE}', ['as' => 'code', 'uses' => 'CodeController@attachLink']);

// Update user account data
// Route::put('profile', ['as' => 'profile/update', 'uses' => 'UserController@update']); // Not working yet


Route::get('/vue', function () {
    return view('vue');
});

Route::get('api/users', function () {

    $value = Cache::rememberForever('users', function () {
    return \App\Profile::latest()->take(50)->select('display_name', 'created_at')->get();

    // Should Only Fetch the Users Display Name!
});

return $value = Cache::pull('users');
});

//Route::post('api/users', function(){
//	 App\User::create(Request::all());
//});
//

//Route::get('/activate/{code}', 'Auth\AuthController@activateAccount

