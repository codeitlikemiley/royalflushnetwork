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
    protected $hidden = ['id','user_id', 'sp_user_id', 'sp_link_id', 'date_activated', 'created_at', 'updated_at'];
    /**
     * [$dates That is Casted on Carbon Instance]
     * @var [Timestamp]
     */
    protected $dates = ['created_at', 'updated_at', 'date_activated'];
    /**
     * [findByLink Get Link Object By Link]
     * @param  [string] $link [registered link]
     * @return [object]       [linkData]
     */
    public static function findByLink($link)
    {
        return self::where('link', $link)->firstOrFail();
    }
    /**
     * [user Eloquent Relationship]
     * @return [Collection] [Link Belongs To Relationship]
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * [setLinkAttribute Link Setter Mutator]
     * @param [string] $value [Set Link to Lowercase on Save]
     */
    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = strtolower($value);
    }
    /**
     * [spStatus Get Status of Sponsor Link]
     * @param  [int] $lid [sp_link_id]
     * @return [Boolean]      [Return The Status]
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
     * [activeSponsor Loops On Leap Frog Until Status Active]
     * @param  [int] $sp_lid [sp_link_id]
     * @return [int]         [Returns the First Active Sponsor Link]
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
     * [leapfrog Sponsor Link if Not Active]
     * @param  [int] $lid [sp_link_id]
     * @return [int]      [Return The Next Sponsor if Not Active]
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
    	return $this->hasOne('App\Code');
    }
}
