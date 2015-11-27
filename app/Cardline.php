<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardline extends Model
{
    public $table = "cardlines";

    public static function findLinkID($lid)
    {
        return self::where('link_id', $lid)->get();
    }

    public function cardlink()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function card()
    {
        return $this->morphTo();
    }
}
