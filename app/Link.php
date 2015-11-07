<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

use App\Matrix;
use App\Profile;
use App\Cycle;
use App\User;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['link', 'sp_link_id'];

//    protected $hidden = ['id', 'user_id', 'sp_user_id', 'sp_link_id', 'active', 'date_activated', 'created_at', 'updated_at'];


    

    //LINK RELATIONSHIPS


    public function sponsor()
    {
        return $this->belongsTo('App\Link', 'sp_link_id', 'id')->select('link');
        //->GUIDE -< // return $this->belongsTo('User', 'local_key', 'parent_key', );
        // Auth::user->link()->sponsor()->link;
        // Authenticated User -> Eloquent Relationship ->  Chained the Relationship -> Access the Column Name
    }


    public function isactivesponsor()
    {
        return $this->belongsTo('App\Link', 'sp_link_id', 'id')->select('active');
        //->GUIDE -< // return $this->belongsTo('User', 'local_key', 'parent_key', );
    }



    public function referrals()
    {
        return $this->hasMany('App\Link', 'sp_link_id', 'id')->select('link');
        //->GUIDE-<// return $this->hasOne('Link', 'foreign_key', 'local_key');
    }


    public function activereferrals()
    {
        return $this->referrals()->where ('active', '=', true)->select('link');
    }

    // call the method in your controller
    // $link->activereferrals()->get();

    
    //USER RELATIONSHIP
    public function user()
    {
        return $this->belongsTo('App\User');

    }
    
    public function directsponsor()
    {
        return $this->belongsTo('App\User', 'sp_user_id' ,'sp_id');
        //->GUIDE -< // return $this->belongsTo('User', 'local_key', 'parent_key', );
    }

    public function scopeActive($query)
    {
        return $query->where('active', '=',1);
        // this will query all active links in the link table
    }

    //Utilizing A Query Scope - Called the Active scope Function to list Active by Created Date
    // $users = User::Active()->orderBy('date_activated')->get();

    public function scopeOfActiveLink($query, $link, $active)
    {
        return $query->whereLink($link)->whereActive($active);
    }

    // uncomment the statement below , it will call the Dynamic Scope, i can put name here of the link to get the active user
    //$links = Link::ofActiveLink('true')->get();


    public function isActive($user){
        if($user->active = 1){
            return true;
        }

        return false;
    }



}