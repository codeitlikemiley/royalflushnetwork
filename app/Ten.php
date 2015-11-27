<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CardTrait;

class Ten extends Model
{
    use CardTrait;

    protected $table = "tens";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    protected $cardtype  = "App\Ten";

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }
    public function tenlinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }
}
