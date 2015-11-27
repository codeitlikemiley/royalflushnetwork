<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CardTrait;

class Jack extends Model
{
    use CardTrait;

    protected $table = "jacks";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];
    protected $cardtype  = "App\Jack";

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function jacklinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }
}
