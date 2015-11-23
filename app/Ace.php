<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ace extends Model
{
    protected $table = "aces";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function acelinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function overridePoints($lid)
    {
        $ace               = Ace::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline          = new App\Cardline();
        $cardline->points  = 1;
        $ace->cardpoints()->save($cardline);
        $ace->shuffle = true;
        $ace->save();
    }

    public function freePoints()
    {
        $jack              = Jack::where('shuffle', false)->first();
        $cardline          = new App\Cardline();
        $cardline->points  = 1;
        $ace->cardpoints()->save($cardline);
        $ace->shuffle = true;
        $ace->save();
    }
}
