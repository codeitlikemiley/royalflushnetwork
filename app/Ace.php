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
        $ace                = Ace::where('link_id', $lid)->where('shuffle', false)->first();
        $cardline           = new Cardline();
        $cardline->points   = 1;
        $ace->cardpoints()->save($cardline);
        $ace->shuffle = true;
        $ace->save();
    }

    public function freeShuffle()
    {
        $ace                = Ace::where('shuffle', false)->first();
        $cardline           = new Cardline();
        $cardline->points   = 1;
        $ace->cardpoints()->save($cardline);
        $ace->shuffle = true;
        $ace->save();
    }

    public function create($lid)
    {
        $ace                 = new Ace();
        $ace->link_id        = $lid;
        $ace->min_direct     = 12;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
    }

    public function forceCycle($lid)
    {
        $ace                 = $this->forceShuffle($lid);
        $directCount         = Link::where('sp_link_id', $lid)->where('active', true)->count();
        $ace                 = new Ace();
        $ace->link_id        = $lid;
        $ace->min_direct     = $directCount;
        $ace->canSwitch      = true;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
    }

    public function freeCycle()
    {
        $ace                 = $this->freeShuffle;
        $lid                 = $ace->link_id;
        $directCount         = $ace->min_direct;
        $ace                 = new Ace();
        $ace->link_id        = $lid;
        $ace->min_direct     = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
    }

    public function switchToTen($lid)
    {
        $ace                 = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $directCount         = $ace->min_direct;
        $ten                 = new Ten();
        $ten->link_id        = $lid;
        $ten->min_direct     = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
        $ace->delete();
    }

    public function switchToJack($lid)
    {
        $ace                  = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $directCount          = $ace->min_direct;
        $jack                 = new Jack();
        $jack->link_id        = $lid;
        $jack->min_direct     = $directCount;
        $cardline             = new Cardline();
        $cardline->link_id    = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
        $ace->delete();
    }

    public function switchToQueen($lid)
    {
        $ace                   = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $directCount           = $ace->min_direct;
        $queen                 = new Queen();
        $queen->link_id        = $lid;
        $queen->min_direct     = $directCount;
        $cardline              = new Cardline();
        $cardline->link_id     = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
        $ace->delete();
    }

    public function switchToKing($lid)
    {
        $ace                   = Ace::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $directCount           = $ace->min_direct;
        $king                  = new King();
        $king->link_id         = $lid;
        $king->min_direct      = $directCount;
        $cardline              = new Cardline();
        $cardline->link_id     = $lid;
        $king->cardpoints()->save($cardline);
        $king->save();
        $ace->delete();
    }
}
