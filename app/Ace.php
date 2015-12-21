<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CardTrait;

class Ace extends Model
{
    use CardTrait;

    protected $table = "aces";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    protected $cardtype  = "App\Ace";

    protected $maxshuffle = 130;

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function acelinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }
}
