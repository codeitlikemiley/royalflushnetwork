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
        $cardline         = new Cardline();
        $cardline->points = 1;
        $ten->cardpoints()->save($cardline);
        $ten->shuffle = true;
        $ten->save();
    }

    public function freeShuffle()
    {
        $ten              = Ten::where('shuffle', false)->first();
        $cardline         = new Cardline();
        $cardline->points = 1;
        $ten->cardpoints()->save($cardline);
        $ten->shuffle = true;
        $ten->save();
    }

    public function create($lid)
    {
        $ten               = new Ten();
        $ten->link_id      = $lid;
        $ten->min_direct   = 0;
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
    }

    public function forceCycle($lid)
    {
        $ten               = $this->forceShuffle($lid);
        $directCount       = Link::where('sp_link_id', $lid)->where('active', true)->count();
        $ten               = new Ten();
        $ten->link_id      = $lid;
        $ten->min_direct   = $directCount;
        $ten->canSwitch    = true;
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
    }

    public function freeCycle()
    {
        $ten               = $this->freeShuffle;
        $lid               = $ten->link_id;
        $directCount       = $ten->min_direct;
        $ten               = new Ten();
        $ten->link_id      = $lid;
        $ten->min_direct   = $directCount;
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $ten->cardpoints()->save($cardline);
        $ten->save();
    }

    public function switchToJack($lid)
    {
        $ten               = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 1)->where('canSwitch', true)->first();
        $directCount       = $ten->min_direct;
        $jack              = new Jack();
        $jack->link_id     = $lid;
        $jack->min_direct  = $directCount;
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $jack->cardpoints()->save($cardline);
        $jack->save();
        $ten->delete();
    }

    public function switchToQueen($lid)
    {
        $ten                = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 3)->where('canSwitch', true)->first();
        $directCount        = $ten->min_direct;
        $queen              = new Queen();
        $queen->link_id     = $lid;
        $queen->min_direct  = $directCount;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $queen->cardpoints()->save($cardline);
        $queen->save();
        $ten->delete();
    }

    public function switchToKing($lid)
    {
        $ten                = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 5)->where('canSwitch', true)->first();
        $directCount        = $ten->min_direct;
        $king               = new King();
        $king->link_id      = $lid;
        $king->min_direct   = $directCount;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $king->cardpoints()->save($cardline);
        $king->save();
        $ten->delete();
    }

    public function switchToAce($lid)
    {
        $ten                = Ten::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', 11)->where('canSwitch', true)->first();
        $directCount        = $ten->min_direct;
        $ace                = new Ace();
        $ace->link_id       = $lid;
        $ace->min_direct    = $directCount;
        $cardline           = new Cardline();
        $cardline->link_id  = $lid;
        $ace->cardpoints()->save($cardline);
        $ace->save();
        $ten->delete();
    }
}
