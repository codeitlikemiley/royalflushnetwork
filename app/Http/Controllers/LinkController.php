<?php

namespace App\Http\Controllers;

use App\Link;
use Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * [showRefLink description]
     * Route::get('{link?}', ['as' => 'reflink', 'uses' => 'LinkController@showRefLink']);
     *
     * @param [text] $link [referral link]
     *
     * @return [json] [all info abou the link]
     */
     public function showRefLink($link = null)
     {

        //  // If it has a Sponsor Cookie
         if (\Cookie::has('sponsor')) {
             return Redirect::to('/'); // Load Referral Link View
         }
         if (is_null($link)) {
             return Redirect::to('/'); // Redirect To HomePage
         }

         try {
             // If has $Link then Look in Database if Exist
            $link  = Link::findByLink($link)->load('user.profile');
             $link = $link->toArray();
            // Note Cookie Wont Be Created if Exceeded More than 4kb
            \Cookie::queue('sponsor', $link, 2628000);

            // Return Referral View with Variable Link
              return Redirect::to('/')->with('link', $link);

        // If No Record Found Throw Exception!
         } catch (ModelNotFoundException $e) {
             // Return Back to Home
        return Redirect::to('/');

            // return view('nosponsor');
         }
     }

}
