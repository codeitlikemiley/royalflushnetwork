<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ten extends Model
{
    protected $table = "tens";

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'shuffle'    => 'boolean',
    ];

    public function cardpoints()
    {
        return $this->morphMany('App\Cardline', 'card');
    }
    public function tenlinks()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function forceShuffle($lid)
    {
        $ten              = Ten::where('link_id', $lid)->where('shuffle', false)->first();
        $ten->shuffle     = true;
        $cardID           = $ten->id;
        $ten->save();
        $cardline = Cardline::where('card_type', "App\Ten")->where('card_id', $cardID)->update(array('points' => 1));

        return $ten;
    }

    public function freeShuffle()
    {
        $ten              = Ten::where('shuffle', false)->first();
        $ten->shuffle     = true;
        $cardID           = $ten->id;
        $ten->save();
        $cardline = Cardline::where('card_type', "App\Ten")->where('card_id', $cardID)->update(array('points' => 1));

        return $ten;
    }

    // public function create($lid)
    // {
    //     $ten               = new Ten();
    //     $ten->link_id      = $lid;
    //     $ten->min_direct   = 0;
    //     $cardline          = new Cardline();
    //     $cardline->link_id = $lid;
    //     $ten->cardpoints()->save($cardline);
    //     $ten->save();
    // }

    public function forceCycle($lid)
    {
        $ten                  = $this->forceShuffle($lid);
        $directCount          = $ten->min_direct;
        $newTen               = new Ten();
        $newTen->link_id      = $lid;
        $newTen->min_direct   = $directCount;
        $newTen->canSwitch    = true;
        $newTen->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newTen->cardpoints()->save($cardline);
    }

    public function freeCycle()
    {
        $ten                  = $this->freeShuffle();
        $lid                  = $ten->link_id;
        $directCount          = $ten->min_direct;
        $newTen               = new Ten();
        $newTen->link_id      = $lid;
        $newTen->min_direct   = $directCount;
        $newTen->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newTen->cardpoints()->save($cardline);
    }

    public function switchToJack($lid)
    {
        $ten               = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $cardID            = $ten->id;
        $directCount       = $ten->min_direct;
        $cardline          = Cardline::where('card_type', "App\Ten")->where('card_id', $cardID)->delete();
        $jack              = new Jack();
        $jack->link_id     = $lid;
        $jack->min_direct  = $directCount;
        $jack->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $jack->cardpoints()->save($cardline);
        $ten->delete();
    }

    public function switchToQueen($lid)
    {
        $ten                = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $cardID             = $ten->id;
        $directCount        = $ten->min_direct;
        $cardline           = Cardline::where('card_type', "App\Ten")->where('card_id', $cardID)->delete();
        $queen              = new Queen();
        $queen->link_id     = $lid;
        $queen->min_direct  = $directCount;
        $queen->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $queen->cardpoints()->save($cardline);
        $ten->delete();
    }

    public function switchToKing($lid)
    {
        $ten                = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $cardID             = $ten->id;
        $directCount        = $ten->min_direct;
        $cardline           = Cardline::where('card_type', "App\Ten")->where('card_id', $cardID)->delete();
        $king               = new King();
        $king->link_id      = $lid;
        $king->min_direct   = $directCount;
        $king->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $king->cardpoints()->save($cardline);
        $ten->delete();
    }

    public function switchToAce($lid)
    {
        $ten                = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $cardID             = $ten->id;
        $directCount        = $ten->min_direct;
        $cardline           = Cardline::where('card_type', "App\Ten")->where('card_id', $cardID)->delete();
        $ace                = new Ace();
        $ace->link_id       = $lid;
        $ace->min_direct    = $directCount;
        $ace->save();
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $ace->cardpoints()->save($cardline);
        $ten->delete();
    }
}
