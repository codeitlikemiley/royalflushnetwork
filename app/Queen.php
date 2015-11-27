<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CardTrait;

class Queen extends Model
{
    use CardTrait;

    protected $table = "queens";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    protected $cardtype  = "App\Queen";

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function queenlinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }
}
