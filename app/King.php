<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class King extends Model
{
    protected $table = "kings";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];
    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function kinglinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function overridePoints($lid)
    {
        $king              = King::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline          = new App\Cardline();
        $cardline->points  = 1;
        $king->cardpoints()->save($cardline);
        $king->shuffle = true;
        $king->save();
    }

    public function freePoints()
    {
        $king              = Jack::where('shuffle', false)->first();
        $cardline          = new App\Cardline();
        $cardline->points  = 1;
        $king->cardpoints()->save($cardline);
        $king->shuffle = true;
        $king->save();
    }
}
