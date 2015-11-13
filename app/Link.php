<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['link'];

    protected $hidden = ['user_id','date_activated', 'created_at', 'updated_at'];

    //USER RELATIONSHIP
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
