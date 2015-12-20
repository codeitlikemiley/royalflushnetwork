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

             return view('welcome'); // Load Referral Link View
         }
         if (is_null($link)) {
             return Redirect::to('/'); // Redirect To HomePage
        }

        try {
            // If has $Link then Look in Database if Exist
            $link = Link::with('user', 'user.profile')->where('link', $link)->firstOrFail();
            $link = $link->toArray();
            // Note Cookie Wont Be Created if Exceeded More than 4kb
            \Cookie::queue('sponsor', $link, 2628000);

            // Return Referral View with Variable Link
              return view('welcome')->with('link', $link);

        // If No Record Found Throw Exception!
        } catch (ModelNotFoundException $e) {
            // Return Back to Home
        return Redirect::to('/');

            // return view('nosponsor');
        }


     }

    public function showSponsor(){
       return view('welcome');


    }

//    public function showRefLink($link = null)
//    {
//
//        //  // If it has a Sponsor Cookie
//        if (\Cookie::has('sponsor')) {
//
//            return Redirect::to('/');
//        }
//        // if it has A Value then Check if it Exist in DB
//        try {
//            // if Value Exceed More than 4kb You Cant Create a Cookie
//            $link = Link::with(['user', 'user.profile'])->where('link', $link)->first();
//            $link = $link->toJson();
//
//
////            $response = new Response($link);
//
//            \Cookie::queue('sponsor', $link, 2628000); // 5 Year Cookie or Forever
//
//            return Redirect::to('showsponsor');
//
//
////            return $response->withCookie(\Cookie::forever('sponsor', $link)); // OK Returning 5 years Cookie
//
//            // Catch Exception if Not Found!
//        } catch (ModelNotFoundException $e) {
//            // Return Back to Home
//            return Redirect::to('/');
//        }
//
//        // Return With Cookie Response
//    }
}
