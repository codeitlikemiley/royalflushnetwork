<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queen extends Model
{
    protected $table = "queens";

    public function cardline()
    {
        return $this->morpOne('Cardline', 'card');
    }

    public function points($link)
    {
        return $this->points;
    }
}
