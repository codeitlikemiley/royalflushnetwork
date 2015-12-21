<?php

namespace App\Http\Controllers;

use Input;
use DB;
use Response;
use App\Link;
use Cookie;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SearchController extends Controller
{
    public function autocomplete()
    {
        // Load Cookie Data if Cookie Present
        if (Cookie::has('sponsor')) {
            $cookie  = Cookie::get('sponsor');
            $results = array();

            $results[] = ['id' => $cookie['id'], 'value' => $cookie['link']];

            return Response::json($results);
            // Return Cookie Data of SponsorLink
        }
        // Search Term in Links table
        // e means escape Entities
        // Return 10 Links That is Like the Term
        $term    = e(Input::get('term'));
        $results = array();
        $queries = DB::table('links')
        ->where('link', 'LIKE', '%' . $term . '%')
        ->take(10)->get();

        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->link];
        }

        return Response::json($results);
    }

    public function searchUser()
    {
        // If Cookie is Present Dont Load Any Data!
        if (Cookie::has('sponsor')) {
            $cookie  = Cookie::get('sponsor');
            $link    = $cookie['link'];
            $message = 'Loading... ' . $link . '\'s Sponsor Link';
            // Return as an Error Code LOCK!
            return response()->json(['cookie' => true, 'message' => $message, 'link' => $link], 423);
        }
        // If No Cookie Is Present
        try {
            $link       = Input::get('q');
            $splinkdata = Link::findByLink($link)->load('user.profile');
            $cookie     = $splinkdata->toArray();
            $message    = 'Loading... ' . $splinkdata['link'] . '\'s Sponsor Link';

            return response()->json(['cookie' => false, 'splinkdata' => $splinkdata, 'message' => $message], 200)->withCookie(Cookie::forever('sponsor', $cookie));
        } catch (ModelNotFoundException $e) {
            $link       = Input::get('q');
            $message    = 'Can\'t Find ' . $link . ' in Database';

            return response()->json(['cookie' => false, 'message' => $message, 'link' => $link], 400);
        }
    }
}
