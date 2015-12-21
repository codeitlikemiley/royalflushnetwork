<?php

namespace App\Http\Controllers;

use App\Link;
use App\Ten;
use App\Jack;
use App\Queen;
use App\King;
use App\Ace;
use App\Cardline;
use Illuminate\Http\Request;

class CardlineController extends Controller
{
    public $link;
    public $ten;
    public $jack;
    public $queen;
    public $king;
    public $ace;
    public $cardline;

    public function __construct(Link $link, Ten $ten, Jack $jack, Queen $queen, King $king, Ace $ace, Cardline $cardline)
    {
        $this->link     = $link;
        $this->ten      = $ten;
        $this->jack     = $jack;
        $this->queen    = $queen;
        $this->king     = $king;
        $this->ace      = $ace;
        $this->cardline = $cardline;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forceCycle($lid)
    {
        return $this->ten->forceCycle($lid);
    }

    public function switchToJack($lid)
    {
        var_dump($this->ten->deactivate($lid));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($lid)
     {
         $directCount       = Link::where('sp_link_id', $lid)->count();
         $ten               = new Ten();
         $ten->link_id      = $lid;
         $ten->min_direct   = $directCount;
         $ten->save();
         $cardline          = new Cardline();
         $cardline->link_id = $lid;
         $ten->cardpoints()->save($cardline);
     }

    public function Booster($qty)
    {
        $u = $qty;
        $i = 0;
        while ($i < $u) {
            $this->DynamicFlushLine();
            $i++;
        }

        return "Booster Has Been Finished Distributing!";
    }

    public function free()
    {
        $this->ten->freeCycle();
    }

    public function DynamicFlushLine()
    {
        try {
            $this->ace->freeCycle();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            try {
                $this->king->freeCycle();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                try {
                    $this->queen->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    try {
                        $this->jack->freeCycle();
                    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                        $this->ten->freeCycle();
                    }
                }
            }
        }

        try {
            $this->king->freeCycle();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            try {
                $this->queen->freeCycle();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                try {
                    $this->jack->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $this->ten->freeCycle();
                }
            }
        }

        try {
            $this->queen->freeCycle();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            try {
                $this->jack->freeCycle();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                $this->ten->freeCycle();
            }
        }

        try {
            $this->jack->freeCycle();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            $this->ten->freeCycle();
        }

        try {
            $this->ten->freeCycle();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return "ERROR CREATE COMPANY ACCOUNT!!!";
        }
    } //end of DynamicFlushLine

}
