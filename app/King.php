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
        $king               = King::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline           = new Cardline();
        $cardline->points   = 1;
        $king->cardpoints()->save($cardline);
        $king->shuffle = true;
        $king->save();
    }

    public function freeShuffle()
    {
        $king               = King::where('shuffle', false)->first();
        $cardline           = new Cardline();
        $cardline->points   = 1;
        $king->cardpoints()->save($cardline);
        $king->shuffle = true;
        $king->save();
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
        $king                = $this->forceShuffle($lid);
        $directCount         = Link::where('sp_link_id', $lid)->where('active', true)->count();
        $king                = new King();
        $king->link_id       = $lid;
        $king->min_direct    = $directCount;
        $king->canSwitch     = true;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $king->cardpoints()->save($cardline);
        $king->save();
    }

    public function freeCycle()
    {
        $king                = $this->freeShuffle;
        $lid                 = $king->link_id;
        $directCount         = $king->min_direct;
        $king                = new King();
        $king->link_id       = $lid;
        $king->min_direct    = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $king->cardpoints()->save($cardline);
        $king->save();
    }

    public function switchToTen($lid)
    {
        $king                = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $directCount         = $king->min_direct;
        $ten                 = new Ten();
        $ten->link_id        = $lid;
        $ten->min_direct     = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
        $king->delete();
    }

    public function switchToJack($lid)
    {
        $king                 = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $directCount          = $king->min_direct;
        $jack                 = new Jack();
        $jack->link_id        = $lid;
        $jack->min_direct     = $directCount;
        $cardline             = new Cardline();
        $cardline->link_id    = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
        $king->delete();
    }

    public function switchToQueen($lid)
    {
        $king                  = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $directCount           = $king->min_direct;
        $queen                 = new Queen();
        $queen->link_id        = $lid;
        $queen->min_direct     = $directCount;
        $cardline              = new Cardline();
        $cardline->link_id     = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
        $king->delete();
    }

    public function switchToAce($lid)
    {
        $king                 = King::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $directCount          = $king->min_direct;
        $ace                  = new Ace();
        $ace->link_id         = $lid;
        $ace->min_direct      = $directCount;
        $cardline             = new Cardline();
        $cardline->link_id    = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
        $king->delete();
    }
}
