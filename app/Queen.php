<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queen extends Model
{
    protected $table = "queens";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function queenlinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function forceShuffle($lid)
    {
        $queen              = Queen::where('link_id', $lid)->where('shuffle', false)->first();
        $queen->shuffle     = true;
        $cardID             = $queen->id;
        $queen->save();
        $cardline = Cardline::where('card_type', "App\Queen")->where('card_id', $cardID)->update(array('points' => 1));

        return $queen;
    }
    public function freeShuffle()
    {
        $queen              = Queen::where('shuffle', false)->first();
        $queen->shuffle     = true;
        $cardID             = $queen->id;
        $queen->save();
        $cardline = Cardline::where('card_type', "App\Queen")->where('card_id', $cardID)->update(array('points' => 1));

        return $queen;
    }

    // public function create($lid)
    // {
    //     $queen               = new Queen();
    //     $queen->link_id      = $lid;
    //     $queen->min_direct   = 4;
    //     $cardline            = new Cardline();
    //     $cardline->link_id   = $lid;
    //     $queen->cardpoints()->save($cardline);
    //     $queen->save();
    //Queen
    public function forceCycle($lid)
    {
        $queen                  = $this->forceShuffle($lid);
        $directCount            = $queen->min_direct;
        $newQueen               = new Queen();
        $newQueen->link_id      = $lid;
        $newQueen->min_direct   = $directCount;
        $newQueen->canSwitch    = true;
        $newQueen->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newQueen->cardpoints()->save($cardline);
    }

    public function freeCycle()
    {
        $queen                  = $this->freeShuffle();
        $lid                    = $queen->link_id;
        $directCount            = $queen->min_direct;
        $newQueen               = new Queen();
        $newQueen->link_id      = $lid;
        $newQueen->min_direct   = $directCount;
        $newQueen->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newQueen->cardpoints()->save($cardline);
    }

    public function switchToTen($lid)
    {
        $queen               = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $cardID              = $queen->id;
        $directCount         = $queen->min_direct;
        $queen->delete();
        $cardline          = Cardline::where('card_type', "App\Queen")->where('card_id', $cardID)->delete();
        $ten               = new Ten();
        $ten->link_id      = $lid;
        $ten->min_direct   = $directCount;
        $ten->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $ten->cardpoints()->save($cardline);
    }

    public function switchToJack($lid)
    {
        $queen                = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $cardID               = $queen->id;
        $directCount          = $queen->min_direct;
        $queen->delete();
        $cardline           = Cardline::where('card_type', "App\Queen")->where('card_id', $cardID)->delete();
        $jack               = new Jack();
        $jack->link_id      = $lid;
        $jack->min_direct   = $directCount;
        $jack->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $jack->cardpoints()->save($cardline);
    }

    public function switchToKing($lid)
    {
        $queen                = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $cardID               = $queen->id;
        $directCount          = $queen->min_direct;
        $queen->delete();
        $cardline           = Cardline::where('card_type', "App\Queen")->where('card_id', $cardID)->delete();
        $king               = new King();
        $king->link_id      = $lid;
        $king->min_direct   = $directCount;
        $king->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $king->cardpoints()->save($cardline);
    }

    public function switchToAce($lid)
    {
        $queen                = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $cardID               = $queen->id;
        $directCount          = $queen->min_direct;
        $queen->delete();
        $cardline           = Cardline::where('card_type', "App\Queen")->where('card_id', $cardID)->delete();
        $ace                = new Ace();
        $ace->link_id       = $lid;
        $ace->min_direct    = $directCount;
        $ace->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $ace->cardpoints()->save($cardline);
    }
}
