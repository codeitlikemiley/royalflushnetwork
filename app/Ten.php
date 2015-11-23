<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ten extends Model
{
    protected $table = "tens";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }
    public function tenlinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function overridePoints($lid)
    {
        $ten              = Ten::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline         = new App\Cardline();
        $cardline->points = 1;
        $ten->cardpoints()->save($cardline);
        $ten->shuffle = true;
        $ten->save();
    }

    public function freePoints()
    {
        $ten              = Ten::where('shuffle', false)->first();
        $cardline         = new App\Cardline();
        $cardline->points = 1;
        $ten->cardpoints()->save($cardline);
        $ten->shuffle = true;
        $ten->save();
    }
}
