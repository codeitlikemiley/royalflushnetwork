<?php namespace App\Traits;

use App\Cardline;
use App\Ten;
use App\Jack;
use App\Queen;
use App\King;
use App\Ace;

trait CardTrait
{
    protected $min_ten   = 0;
    protected $min_jack  = 1;
    protected $min_queen = 3;
    protected $min_king  = 5;
    protected $min_ace   = 11;

    public function maxShuffle()
    {
        return $this->maxshuffle;
    }
    public function shuffleCount($lid)
    {
        $shufflecount = static::where('link_id', $lid)->where('shuffle', true)->count();

        return $shufflecount;
    }

    public function graduate($lid)
    {
        if ($this->maxShuffle() >= $this->shuffleCount($lid)) {
            return false;
        }

        return true;
    }

    public function deactivate($lid)
    {
        if ($this->graduate($lid)) {
            static::where('link_id', $lid)->where('active', true)->where('shuffle', false)->update(array('active' => false));
        }
    }

    public function freeShuffle()
    {
        $card              = static::where('shuffle', false)->where('active', true)->firstOrFail();
        $card->shuffle     = true;
        $cardID            = $card->id;
        $card->save();
        $cardline = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->update(array('points' => 1));

        return $card;
    }

    public function freeCycle()
    {
        $card                  = $this->freeShuffle();
        $lid                   = $card->link_id;
        $directCount           = $card->min_direct;
        $newCard               = new static();
        $newCard->link_id      = $lid;
        $newCard->min_direct   = $directCount;
        $newCard->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newCard->cardpoints()->save($cardline);
        $this->deactivate($lid);
        // This will Broadcast To the Front End!
        $username = \App\Link::find($lid)->user->username;
        $data     = [
            'event' => 'UserSignedUp',
            'data'  => [
                'username' => $username,
            ],
        ];
        \PHPRedis::publish('rfn-chanel', json_encode($data));
    }

    public function forceShuffle($lid)
    {
        $card              = static::where('link_id', $lid)->where('shuffle', false)->firstOrFail();
        $card->shuffle     = true;
        $cardID            = $card->id;
        $card->save();
        $cardline = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->update(array('points' => 1));

        return $card;
    }

    public function forceCycle($lid)
    {
        $card                  = $this->forceShuffle($lid);
        $directCount           = $card->min_direct;
        $newCard               = new static();
        $newCard->link_id      = $lid;
        $newCard->min_direct   = $directCount;
        $newCard->canSwitch    = true;
        $newCard->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newCard->cardpoints()->save($cardline);
    }

    public function randomShuffle($lid)
    {
        $card              = static::where('link_id', $lid)->where('shuffle', false)->where('active', true)->firstOrFail();
        $card->shuffle     = true;
        $cardID            = $card->id;
        $card->save();
        $cardline = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->update(array('points' => 1));

        return $card;
    }

    public function randomCycle($lid)
    {
        $card                  = $this->randomShuffle($lid);
        $directCount           = $card->min_direct;
        $newCard               = new static();
        $newCard->link_id      = $lid;
        $newCard->min_direct   = $directCount;
        $newCard->canSwitch    = true;
        $newCard->save();
        $cardline          = new Cardline();
        $cardline->link_id = $lid;
        $newCard->cardpoints()->save($cardline);
        $this->deactivate($lid);
    }

    public function switchToTen($lid)
    {
        if (new static != new Ten()) {
            $card               = static::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', $this->min_ten)->where('canSwitch', true)->first();
            $cardID             = $card->id;
            $directCount        = $card->min_direct;
            $card->delete();
            $cardline           = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->delete();
            $card               = new Ten();
            $card->link_id      = $lid;
            $card->min_direct   = $directCount;
            $card->save();
            $cardline          = new Cardline();
            $cardline->link_id = $lid;
            $card->cardpoints()->save($cardline);

            return "You  Switch to Card Line 10!";
        }

        return "You  Cant Switch Line!";
    }
    public function switchToJack($lid)
    {
        if (new static != new Jack()) {
            $card               = static::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', $this->min_jack)->where('canSwitch', true)->first();
            $cardID             = $card->id;
            $directCount        = $card->min_direct;
            $card->delete();
            $cardline           = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->delete();
            $card               = new Jack();
            $card->link_id      = $lid;
            $card->min_direct   = $directCount;
            $card->save();
            $cardline          = new Cardline();
            $cardline->link_id = $lid;
            $card->cardpoints()->save($cardline);

            return "You  Switch to Card Line Jack!";
        }

        return "You  Cant Switch Line!";
    }
    public function switchToQueen($lid)
    {
        if (new static != new Queen()) {
            $card               = static::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', $this->min_queen)->where('canSwitch', true)->first();
            $cardID             = $card->id;
            $directCount        = $card->min_direct;
            $card->delete();
            $cardline           = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->delete();
            $card               = new Queen();
            $card->link_id      = $lid;
            $card->min_direct   = $directCount;
            $card->save();
            $cardline          = new Cardline();
            $cardline->link_id = $lid;
            $card->cardpoints()->save($cardline);

            return "You  Switch to Card Line Queen!";
        }

        return "You  Cant Switch Line!";
    }
    public function switchToKing($lid)
    {
        if (new static != new King()) {
            $card               = static::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', $this->min_king)->where('canSwitch', true)->first();
            $cardID             = $card->id;
            $directCount        = $card->min_direct;
            $card->delete();
            $cardline           = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->delete();
            $card               = new King();
            $card->link_id      = $lid;
            $card->min_direct   = $directCount;
            $card->save();
            $cardline          = new Cardline();
            $cardline->link_id = $lid;
            $card->cardpoints()->save($cardline);

            return "You  Switch to Card Line King!";
        }

        return "You  Cant Switch Line!";
    }
    public function switchToAce($lid)
    {
        if (new static != new Ace()) {
            $card               = static::where('link_id', $lid)->where('shuffle', false)->where('min_direct', '>', $this->min_ace)->where('canSwitch', true)->first();
            $cardID             = $card->id;
            $directCount        = $card->min_direct;
            $card->delete();
            $cardline           = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->delete();
            $card               = new Ace();
            $card->link_id      = $lid;
            $card->min_direct   = $directCount;
            $card->save();
            $cardline          = new Cardline();
            $cardline->link_id = $lid;
            $card->cardpoints()->save($cardline);

            return "You  Switch to Card Line Ace!";
        }

        return "You  Cant Switch Line!";
    }
    /**
     * Using Link and Card Relationship
     * $link = Link::find(1);
     * $link->tencards()->cardCountToday()
     * User::find(1)->links->find(1)->tencards()->today()
     * result is the Total Count of Cycle of that Link
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->where('shuffle', true)->count();
    }
}
