<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ace extends Model
{
    protected $table = "aces";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function acelinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function forceShuffle($lid)
    {
        $ace               = Ace::where('link_id', $lid)->where('shuffle', false)->first();
        $ace->shuffle      = true;
        $cardID            = $ace->id;
        $ace->save();
        $cardline = Cardline::where('card_type', "App\Ace")->where('card_id', $cardID)->update(array('points' => 1));

        return $ace;
    }
    public function freeShuffle()
    {
        $ace               = Ace::where('shuffle', false)->firstOrFail();
        $ace->shuffle      = true;
        $cardID            = $ace->id;
        $ace->save();
        $cardline = Cardline::where('card_type', "App\Ace")->where('card_id', $cardID)->update(array('points' => 1));

        return $ace;
    }

    // public function create($lid)
    // {
    //     $ace                 = new Ace();
    //     $ace->link_id        = $lid;
    //     $ace->min_direct     = 12;
    //     $cardline            = new Cardline();
    //     $cardline->link_id   = $lid;
    //     $ace->cardpoints()->save($cardline);
    //     $ace->save();
    // }

    public function forceCycle($lid)
    {
        $ace                   = $this->forceShuffle($lid);
        $directCount           = $ace->min_direct;
        $newAce                = new Ace();
        $newAce->link_id       = $lid;
        $newAce->min_direct    = $directCount;
        $newAce->canSwitch     = true;
        $newAce->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newAce->cardpoints()->save($cardline);
    }

    public function freeCycle()
    {
        $ace                   = $this->freeShuffle();
        $lid                   = $ace->link_id;
        $directCount           = $ace->min_direct;
        $newAce                = new Ace();
        $newAce->link_id       = $lid;
        $newAce->min_direct    = $directCount;
        $newAce->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newAce->cardpoints()->save($cardline);
    }

    public function switchToTen($lid)
    {
        $ace                = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $cardID             = $ace->id;
        $directCount        = $ace->min_direct;
        $ace->delete();
        $cardline          = Cardline::where('card_type', "App\Ace")->where('card_id', $cardID)->delete();
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
        $ace                  = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $cardID               = $ace->id;
        $directCount          = $ace->min_direct;
        $ace->delete();
        $cardline           = Cardline::where('card_type', "App\Ace")->where('card_id', $cardID)->delete();
        $jack               = new Jack();
        $jack->link_id      = $lid;
        $jack->min_direct   = $directCount;
        $jack->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $jack->cardpoints()->save($cardline);
    }

    public function switchToQueen($lid)
    {
        $ace                 = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $cardID              = $ace->id;
        $directCount         = $ace->min_direct;
        $ace->delete();
        $cardline           = Cardline::where('card_type', "App\Ace")->where('card_id', $cardID)->delete();
        $queen              = new Queen();
        $queen->link_id     = $lid;
        $queen->min_direct  = $directCount;
        $queen->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $queen->cardpoints()->save($cardline);
    }

    public function switchToKing($lid)
    {
        $ace                 = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $cardID              = $ace->id;
        $directCount         = $ace->min_direct;
        $ace->delete();
        $cardline           = Cardline::where('card_type', "App\Ace")->where('card_id', $cardID)->delete();
        $king               = new King();
        $king->link_id      = $lid;
        $king->min_direct   = $directCount;
        $king->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $king->cardpoints()->save($cardline);
    }
}
