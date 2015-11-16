<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['link'];

    protected $hidden = ['id','user_id', 'sp_user_id', 'sp_link_id', 'date_activated', 'created_at', 'updated_at'];

    //USER RELATIONSHIP
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
