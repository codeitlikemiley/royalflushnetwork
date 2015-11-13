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
    protected $hidden = ['password', 'remember_token', 'updated_at', 'activation_code', 'resent', 'status', 'active', 'sp_id', 'email'];

    public static function findByUsername($username)
    {
        return self::where('username', $username)->firstOrFail();
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = \Hash::make($value);
        }
    } //test this if still needed cause i already use Brcypt in password in other file


    public function accountIsActive($code)
    {
        $user = self::where('activation_code', '=', $code)->first();
        $user->active = 1;
        $user->activation_code = '';
        if ($user->save()) {
            \Auth::login($user);
        }

        return true;
    } // check if this is being used


    // LINK RELATION

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}
