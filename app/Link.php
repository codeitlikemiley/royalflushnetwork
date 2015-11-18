<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['link'];

    protected $hidden = ['id','user_id', 'sp_user_id', 'sp_link_id', 'date_activated', 'created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at', 'date_activated'];

    public static function findByLink($link)
    {
        return self::where('link', $link)->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = strtolower($value);
    }

    public function spStatus($lid)
    {
        $sponsor = self::find($lid);

        if (!$sponsor->active) {
            return false;
        }

        return true;
    }

    public function activeSponsor($sp_lid)
    {
        $lid = $sp_lid;

        while ($this->spStatus($lid) === false) {
            $lid = $this->leapfrog($lid);
        }

        return $lid;
    }

    public function leapfrog($lid)
    {
        $sponsor = self::find($lid);

        if (!$sponsor->active) {
            return $sponsor->sp_link_id;
        }

        return $sponsor->id;
    }
}
