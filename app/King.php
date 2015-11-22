<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class King extends Model
{
    protected $table = "kings";

    public function cardline()
    {
        return $this->morpOne('Cardline', 'card');
    }

    public function points($link)
    {
        return $this->points;
    }
}
