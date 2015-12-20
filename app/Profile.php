<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['profile_pic', 'first_name', 'last_name', 'about_me', 'display_name', 'contact_no', 'address', 'city', 'province_state', 'zip_code', 'country'];

    protected $hidden = ['id', 'first_name', 'last_name', 'user_id', 'address', 'city',  'province_state', 'zip_code', 'country', 'updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            $profile->profile_pic = asset('img/avatar.png');

        });
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }

    // USER RELATION
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
