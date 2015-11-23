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
        $cardline           = new Cardline();
        $cardline->points   = 1;
        $queen->cardpoints()->save($cardline);
        $queen->shuffle = true;
        $queen->save();
    }

    public function freeShuffle()
    {
        $queen              = Queen::where('shuffle', false)->first();
        $cardline           = new Cardline();
        $cardline->points   = 1;
        $queen->cardpoints()->save($cardline);
        $queen->shuffle = true;
        $queen->save();
    }

    public function create($lid)
    {
        $queen               = new Queen();
        $queen->link_id      = $lid;
        $queen->min_direct   = 4;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
    }

    public function forceCycle($lid)
    {
        $queen               = $this->forceShuffle($lid);
        $directCount         = Link::where('sp_link_id', $lid)->where('active', true)->count();
        $queen               = new Queen();
        $queen->link_id      = $lid;
        $queen->min_direct   = $directCount;
        $queen->canSwitch    = true;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
    }

    public function freeCycle()
    {
        $queen               = $this->freeShuffle;
        $lid                 = $queen->link_id;
        $directCount         = $queen->min_direct;
        $queen               = new Queen();
        $queen->link_id      = $lid;
        $queen->min_direct   = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
    }

    public function switchToTen($lid)
    {
        $queen               = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $directCount         = $queen->min_direct;
        $ten                 = new Ten();
        $ten->link_id        = $lid;
        $ten->min_direct     = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
        $queen->delete();
    }

    public function switchToJack($lid)
    {
        $queen                = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $directCount          = $queen->min_direct;
        $jack                 = new Jack();
        $jack->link_id        = $lid;
        $jack->min_direct     = $directCount;
        $cardline             = new Cardline();
        $cardline->link_id    = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
        $queen->delete();
    }

    public function switchToKing($lid)
    {
        $queen                = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $directCount          = $queen->min_direct;
        $king                 = new King();
        $king->link_id        = $lid;
        $king->min_direct     = $directCount;
        $cardline             = new Cardline();
        $cardline->link_id    = $lid;
        $king->cardpoints()->save($cardline);
        $king->save();
        $queen->delete();
    }

    public function switchToAce($lid)
    {
        $queen                = Queen::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $directCount          = $queen->min_direct;
        $ace                  = new Ace();
        $ace->link_id         = $lid;
        $ace->min_direct      = $directCount;
        $cardline             = new Cardline();
        $cardline->link_id    = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
        $queen->delete();
    }
}
