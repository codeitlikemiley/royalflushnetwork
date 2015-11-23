<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ace extends Model
{
    protected $table = "aces";

    public function cardline()
    {
        return $this->morpOne('Cardline', 'card');
    }

    public function points($link)
    {
        return $this->points;
    }
}