<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id' ,'password', 'remember_token', 'updated_at', 'activation_code', 'resent', 'status', 'active', 'sp_id', 'email'];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'active' => 'boolean',
        'status' => 'boolean',

    ];
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
}
