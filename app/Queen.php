<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queen extends Model
{
    protected $table = "queens";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function queenlinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function overridePoints($lid)
    {
        $queen              = Queen::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline           = new App\Cardline();
        $cardline->points   = 1;
        $queen->cardpoints()->save($cardline);
        $queen->shuffle = true;
        $queen->save();
    }

    public function freePoints()
    {
        $queen              = Queen::where('shuffle', false)->first();
        $cardline           = new App\Cardline();
        $cardline->points   = 1;
        $queen->cardpoints()->save($cardline);
        $queen->shuffle = true;
        $queen->save();
    }
}
