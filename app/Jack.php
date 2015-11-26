<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jack extends Model
{
    protected $table = "jacks";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }

    public function jacklinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function forceShuffle($lid)
    {
        $jack              = Jack::where('link_id', $lid)->where('shuffle', false)->first();
        $jack->shuffle     = true;
        $cardID            = $jack->id;
        $jack->save();
        $cardline = Cardline::where('card_type', "App\Jack")->where('card_id', $cardID)->update(array('points' => 1));

        return $jack;
    }
    public function freeShuffle()
    {
        $jack              = Jack::where('shuffle', false)->firstOrFail();
        $jack->shuffle     = true;
        $cardID            = $jack->id;
        $jack->save();
        $cardline = Cardline::where('card_type', "App\Jack")->where('card_id', $cardID)->update(array('points' => 1));

        return $jack;
    }

    // public function create($lid)
    // {
    //     $jack               = new Jack();
    //     $jack->link_id      = $lid;
    //     $jack->min_direct   = 2;
    //     $cardline           = new Cardline();
    //     $cardline->link_id  = $lid;
    //     $jack->cardpoints()->save($cardline);
    //     $jack->save();
    // }

    public function forceCycle($lid)
    {
        $jack                  = $this->forceShuffle($lid);
        $directCount           = $jack->min_direct;
        $newJack               = new Jack();
        $newJack->link_id      = $lid;
        $newJack->min_direct   = $directCount;
        $newJack->canSwitch    = true;
        $newJack->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newJack->cardpoints()->save($cardline);
    }

    public function freeCycle()
    {
        $jack                  = $this->freeShuffle();
        $lid                   = $jack->link_id;
        $directCount           = $jack->min_direct;
        $newJack               = new Jack();
        $newJack->link_id      = $lid;
        $newJack->min_direct   = $directCount;
        $newJack->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newJack->cardpoints()->save($cardline);
    }

    public function switchToTen($lid)
    {
        $jack               = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $cardID             = $jack->id;
        $directCount        = $jack->min_direct;
        $jack->delete();
        $cardline          = Cardline::where('card_type', "App\Jack")->where('card_id', $cardID)->delete();
        $ten               = new Ten();
        $ten->link_id      = $lid;
        $ten->min_direct   = $directCount;
        $ten->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $ten->cardpoints()->save($cardline);
    }

    public function switchToQueen($lid)
    {
        $jack                = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $cardID              = $jack->id;
        $directCount         = $jack->min_direct;
        $jack->delete();
        $cardline           = Cardline::where('card_type', "App\Jack")->where('card_id', $cardID)->delete();
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
        $jack                = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $cardID              = $jack->id;
        $directCount         = $jack->min_direct;
        $jack->delete();
        $cardline           = Cardline::where('card_type', "App\Jack")->where('card_id', $cardID)->delete();
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
        $jack                = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $cardID              = $jack->id;
        $directCount         = $jack->min_direct;
        $jack->delete();
        $cardline           = Cardline::where('card_type', "App\Jack")->where('card_id', $cardID)->delete();
        $ace                = new Ace();
        $ace->link_id       = $lid;
        $ace->min_direct    = $directCount;
        $ace->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $ace->cardpoints()->save($cardline);
    }
}
