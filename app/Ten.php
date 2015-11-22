<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ten extends Model
{
    protected $table = "tens";

    public function cardline()
    {
        return $this->morpOne('Cardline', 'card');
    }
    public function points($link)
    {
        return $this->points;
    }
}
