<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\User;
use App\Profile;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\MailController as Mail;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public $link;
    public $user;
    public $mail;
    public $profile;
    
    public function __construct(Link $link,User $user, Mail $mail, Profile $profile)
    {
        $this->link = $link;
        $this->user = $user;
        $this->mail = $mail;
        $this->profile = $profile;
        
    }

    public function getUserProfile($user = null)
    {
        try{
        $user = $this->findByUsername($user);
        $id = $this->findByID($user);
        $profile = $this->getLinksProfile($id);
        $reflinks = $this->getAllLinks($id);
        return view('pages.userprofile')->with(compact(['user','profile', 'reflinks']));
    }catch(ModelNotFoundException $e) {
                $message = "Ooops! $user is Not Registered! ";
                return view('errors.503')->with('message', $message);
            }
    }

    public function findByUsername($user)
    {
        $user = User::where('username', $user)->firstOrFail();
        return $user; 
    }

    public function findByID($user)
    {
        $id = $user->id;
        return $id;
    }

    // route to be used 
    // Route::get('{link?}', ['as' => 'reflink', 'uses' => 'LinkController@getRefLink']);

    public function getRefLink($link = null)
    {

        

        try{
        $link = $this->findByLink($link);
        $id   =   $this->getUserId($link);
        $reflinks = $this->getAllLinks($id);
        $user = $this->getLinksOwner($id);
        $profile = $this->getLinksProfile($id);
            

        return view('pages.link')->with(compact(['link','user','profile', 'reflinks']));
         }
        catch(ModelNotFoundException $e) {
                $message = "Ooops! $link is Not Registered! ";
                return view('errors.503')->with('message', $message);
            }
    }

    public function findByLink($link)
    {

        $link = Link::where('link', $link)->firstOrFail();
        return $link;
    }

    public function getUserId($link)
    {
        $id = $link->user_id;
        return $id;
    }

    public function getLinksOwner($id)
    {
        $user = User::where('id',$id)->first();
        return $user;
    }

    public function getLinksProfile($id)
    {
        $profile = Profile::where('user_id',$id)->first();
        return $profile;
    }

    public function getAllLinks($id)
    {
        $reflinks = Link::where('user_id',$id)->get();
        return $reflinks;
        
    }
}
