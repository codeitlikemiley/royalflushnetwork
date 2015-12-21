<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CardTrait;

class King extends Model
{
    use CardTrait;

    protected $table = "kings";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    protected $cardtype  = "App\King";

    protected $maxshuffle = 70;

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function kinglinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }
}
