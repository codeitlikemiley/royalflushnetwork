<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jack extends Model
{
    protected $table = "jacks";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function jacklinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function overridePoints($lid)
    {
        $jack              = Jack::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline          = new App\Cardline();
        $cardline->points  = 1;
        $jack->cardpoints()->save($cardline);
        $jack->shuffle = true;
        $jack->save();
    }

    public function freePoints()
    {
        $jack              = Jack::where('shuffle', false)->first();
        $cardline          = new App\Cardline();
        $cardline->points  = 1;
        $jack->cardpoints()->save($cardline);
        $jack->shuffle = true;
        $jack->save();
    }
}
