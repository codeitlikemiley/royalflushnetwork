<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jack extends Model
{
    protected $table = "jacks";

    public function cardline()
    {
        return $this->morpOne('Cardline', 'card');
    }

    public function points($link)
    {
        return $this->points;
    }
}
