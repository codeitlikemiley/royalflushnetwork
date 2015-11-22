<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardline extends Model
{
    protected $table = "cardlines";

    public static function findByPin($pin)
    {
        return self::where('pin', $pin)->first();
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
