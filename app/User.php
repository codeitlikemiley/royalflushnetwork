<?php

namespace App;

use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id' ,'password', 'remember_token', 'updated_at', 'activation_code', 'resent', 'status', 'active', 'sp_id', 'email', 'created_at', 'username'];
    
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'active' => 'boolean',
        'status' => 'boolean',

    ];
    /**
     * Boot the model.
     * Automatically Append this during Creation
     * But is Easily Override if an Attribute is Given.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $cookie = \Cookie::get('sponsor');
            if ($cookie) {
                $user->sp_id = $cookie['user_id'];
            }
            $user->activation_code = str_random(60);

        });
    }
    /**
     * [findByUsername Find User Using Their Username].
     *
     * @param [string] $username [Public Searchable]
     *
     * @return [Object] [Userdata]
     */
    public static function findByUsername($username)
    {
        return self::where('username', $username)->firstOrFail();
    }
    /**
     * [setPasswordAttribute Password Setter Mutator].
     *
     * @param [string] $value [Enforce Bcrypt On Save]
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    /**
     * [setUsernameAttribute Username Setter Mutator].
     *
     * @param [string] $value [Make Username in Lowercase on Save]
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }
    public function getCreatedAtAttribute($value)
    {
        // or default TZ as set in .env.php
    // $timezone = ($this->timezone) ?: env('APP_LOCALTZ');

    // use Illuminate\Database\Eloquent\Model;
        $datetime = $this->asDateTime($value)->toIso8601String();

    // Carbon instance modified with TZ
        return $datetime;
    }

    /**
     * [links Eloquent Relationship].
     *
     * @return [Collection] [Set User to Have Many Links]
     */
    public function links()
    {
        return $this->hasMany('App\Link');
    }
    /**
     * [profile Eloquent Relationship].
     *
     * @return [Collection] [Set User to Have One Profile]
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function codes()
    {
        return $this->hasMany('App\Code', 'creator', 'id');
    }

    public function verifyEmail()
    {
        $this->active          = 1;
        $this->activation_code = null;
        $this->save();
    }

    public function incrementResent()
    {
        $this->resent = $this->resent + 1;
        $this->save();
    }
}
