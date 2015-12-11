<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'links';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['link'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','sp_user_id', 'sp_link_id', 'date_activated', 'created_at', 'updated_at'];
    /**
     * [$dates That is Casted on Carbon Instance].
     *
     * @var [Timestamp]
     */
    protected $dates = ['created_at', 'updated_at', 'date_activated'];

    /**
     * Boot the model.
     * Automatically Append this during Creation
     * But is Easily Override if an Attribute is Given
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            $cookie = \Cookie::get('sponsor');
            if ($cookie) {
                $link->sp_user_id = $cookie->user_id;
                $link->sp_link_id = $cookie->id;
            }

        });
    }

    /**
     * [findByLink Get Link Object By Link].
     *
     * @param [string] $link [registered link]
     *
     * @return [object] [linkData]
     */
    public static function findByLink($link)
    {
        return self::where('link', $link)->firstOrFail();
    }
    /**
     * [user Eloquent Relationship].
     *
     * @return [Collection] [Link Belongs To Relationship]
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * [setLinkAttribute Link Setter Mutator].
     *
     * @param [string] $value [Set Link to Lowercase on Save]
     */
    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = strtolower($value);
    }
    /**
     * [spStatus Get Status of Sponsor Link].
     *
     * @param [int] $lid [sp_link_id]
     *
     * @return [Boolean] [Return The Status]
     */
    public function spStatus($lid)
    {
        $sponsor = self::find($lid);

        if (!$sponsor->active) {
            return false;
        }

        return true;
    }
    /**
     * [activeSponsor Loops On Leap Frog Until Status Active].
     *
     * @param [int] $sp_lid [sp_link_id]
     *
     * @return [int] [Returns the First Active Sponsor Link]
     */
    public function activeSponsor($sp_lid)
    {
        $lid = $sp_lid;

        while ($this->spStatus($lid) === false) {
            $lid = $this->leapfrog($lid);
        }

        return $lid;
    }
    /**
     * [leapfrog Sponsor Link if Not Active].
     *
     * @param [int] $lid [sp_link_id]
     *
     * @return [int] [Return The Next Sponsor if Not Active]
     */
    public function leapfrog($lid)
    {
        $sponsor = self::find($lid);

        if (!$sponsor->active) {
            return $sponsor->sp_link_id;
        }

        return $sponsor->id;
    }

    public function code()
    {
        return $this->hasOne('App\Code', 'consumer', 'id');
    }

    public function cardlines()
    {
        return $this->hasMany('App\Cardline', 'link_id', 'id');
    }

    public function tencards()
    {
        return $this->hasMany('App\Ten', 'link_id', 'id');
    }
    public function jackcards()
    {
        return $this->hasMany('App\Jack', 'link_id', 'id');
    }
    public function queencards()
    {
        return $this->hasMany('App\Queen', 'link_id', 'id');
    }
    public function kingcards()
    {
        return $this->hasMany('App\King', 'link_id', 'id');
    }
    public function acecards()
    {
        return $this->hasMany('App\Ace', 'link_id', 'id');
    }
}
