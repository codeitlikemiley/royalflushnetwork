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
        $cardline          = new Cardline();
        $cardline->points  = 1;
        $jack->cardpoints()->save($cardline);
        $jack->shuffle = true;
        $jack->save();
    }

    public function freeShuffle()
    {
        $jack              = Jack::where('shuffle', false)->first();
        $cardline          = new Cardline();
        $cardline->points  = 1;
        $jack->cardpoints()->save($cardline);
        $jack->shuffle = true;
        $jack->save();
    }

    public function create($lid)
    {
        $jack               = new Jack();
        $jack->link_id      = $lid;
        $jack->min_direct   = 2;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
    }

    public function forceCycle($lid)
    {
        $jack               = $this->forceShuffle($lid);
        $directCount        = Link::where('sp_link_id', $lid)->where('active', true)->count();
        $jack               = new Jack();
        $jack->link_id      = $lid;
        $jack->min_direct   = $directCount;
        $jack->canSwitch    = true;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
    }

    public function freeCycle()
    {
        $jack               = $this->freeShuffle;
        $lid                = $jack->link_id;
        $directCount        = $jack->min_direct;
        $jack               = new Ten();
        $jack->link_id      = $lid;
        $jack->min_direct   = $directCount;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
    }

    public function switchToTen($lid)
    {
        $jack               = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 0)->where('canSwitch', true)->first();
        $directCount        = $jack->min_direct;
        $ten                = new Ten();
        $ten->link_id       = $lid;
        $ten->min_direct    = $directCount;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
        $jack->delete();
    }

    public function switchToQueen($lid)
    {
        $jack                = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $directCount         = $jack->min_direct;
        $queen               = new Queen();
        $queen->link_id      = $lid;
        $queen->min_direct   = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
        $jack->delete();
    }

    public function switchToKing($lid)
    {
        $jack                = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $directCount         = $jack->min_direct;
        $king                = new King();
        $king->link_id       = $lid;
        $king->min_direct    = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $king->cardpoints()->save($cardline);
        $king->save();
        $jack->delete();
    }

    public function switchToAce($lid)
    {
        $jack                = Jack::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $directCount         = $jack->min_direct;
        $ace                 = new Ace();
        $ace->link_id        = $lid;
        $ace->min_direct     = $directCount;
        $cardline            = new Cardline();
        $cardline->link_id   = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
        $jack->delete();
    }
}
