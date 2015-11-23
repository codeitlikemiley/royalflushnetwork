<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardline extends Model
{
    protected $table = "cardlines";

    public static function findByPin($link)
    {
        return self::where('link', $link)->get();
    }

    public function cardlink()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function card()
    {
        return $this->morphTo();
    }

    public function points($link)
    {
        return $this->cardline->points($link);
    }
}
