<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class King extends Model
{
    protected $table = "kings";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];
    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function kinglinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function forceShuffle($lid)
    {
        $king              = King::where('link_id', $lid)->where('shuffle', false)->first();
        $king->shuffle     = true;
        $cardID            = $king->id;
        $king->save();
        $cardline = Cardline::where('card_type', "App\King")->where('card_id', $cardID)->update(array('points' => 1));

        return $king;
    }
    public function freeShuffle()
    {
        $king              = King::where('shuffle', false)->firstOrFail();
        $king->shuffle     = true;
        $cardID            = $king->id;
        $king->save();
        $cardline = Cardline::where('card_type', "App\King")->where('card_id', $cardID)->update(array('points' => 1));

        return $king;
    }

    // public function create($lid)
    // {
    //     $king                = new King();
    //     $king->link_id       = $lid;
    //     $king->min_direct    = 6;
    //     $cardline            = new Cardline();
    //     $cardline->link_id   = $lid;
    //     $king->cardpoints()->save($cardline);
    //     $king->save();
    // }

    public function forceCycle($lid)
    {
        $king                  = $this->forceShuffle($lid);
        $directCount           = $king->min_direct;
        $newKing               = new King();
        $newKing->link_id      = $lid;
        $newKing->min_direct   = $directCount;
        $newKing->canSwitch    = true;
        $newKing->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newKing->cardpoints()->save($cardline);
    }

    public function freeCycle()
    {
        $king                  = $this->freeShuffle();
        $lid                   = $king->link_id;
        $directCount           = $king->min_direct;
        $newKing               = new King();
        $newKing->link_id      = $lid;
        $newKing->min_direct   = $directCount;
        $newKing->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newKing->cardpoints()->save($cardline);
    }

    public function switchToTen($lid)
    {
        $king               = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $cardID             = $king->id;
        $directCount        = $king->min_direct;
        $king->delete();
        $cardline          = Cardline::where('card_type', "App\King")->where('card_id', $cardID)->delete();
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
        $king                = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $cardID              = $king->id;
        $directCount         = $king->min_direct;
        $king->delete();
        $cardline           = Cardline::where('card_type', "App\King")->where('card_id', $cardID)->delete();
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
        $king                = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $cardID              = $king->id;
        $directCount         = $king->min_direct;
        $king->delete();
        $cardline            = Cardline::where('card_type', "App\King")->where('card_id', $cardID)->delete();
        $queen               = new Queen();
        $queen->link_id      = $lid;
        $queen->min_direct   = $directCount;
        $queen->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $queen->cardpoints()->save($cardline);
    }

    public function switchToAce($lid)
    {
        $king                = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $cardID              = $king->id;
        $directCount         = $king->min_direct;
        $king->delete();
        $cardline           = Cardline::where('card_type', "App\King")->where('card_id', $cardID)->delete();
        $ace                = new Ace();
        $ace->link_id       = $lid;
        $ace->min_direct    = $directCount;
        $ace->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $ace->cardpoints()->save($cardline);
    }
}
