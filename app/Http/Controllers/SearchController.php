<?php

namespace App\Http\Controllers;

use Input;
use DB;
use Response;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Redirect;
use URL;

class SearchController extends Controller
{
    public function autocomplete()
    {
        $term = e(Input::get('term'));
        $results = array();
        $queries = DB::table('users')
        ->where('username', 'LIKE', '%'.$term.'%')
        ->take(5)->get();

        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->username];
        }

        return Response::json($results);
    }

    public function searchUser()
    {
        try {
            $username = Input::get('q');
            $userdata = User::findByUsername($username)->load('links', 'profile');

            return view('pages.findSponsor')->with('userdata', $userdata);
        } catch (ModelNotFoundException $e) {
            return Redirect::to(URL::previous())->withInput();
        }
    }
}
