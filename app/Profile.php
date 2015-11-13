<?php

namespace App;

use App\User;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['profile_pic', 'about_me', 'display_name', 'contact_no', 'address', 'city', 'province_state', 'zip_code', 'country'];

    protected $hidden = ['id','user_id', 'address', 'province_state', 'zip_code', 'created_at', 'updated_at'];

    // USER RELATION
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    



}
