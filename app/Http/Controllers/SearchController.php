<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class SearchController extends Controller
{
  

    public function search(Request $request)
{
    // Gets the query string from our form submission 
    $query = Request::input('search');
    // Returns an array of users that have the query string located somewhere within 
    // our users name. Paginates them so we can break up lots of search results.
    $users = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')->paginate(10);
        
    // returns a view and passes the view the list of users and the original query.
    return view('pages.search', compact('users', 'query'));
 }
}
