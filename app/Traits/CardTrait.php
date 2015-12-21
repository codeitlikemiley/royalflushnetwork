<?php namespace App\Traits;

use App\Cardline;
use App\Ten;
use App\Jack;
use App\Queen;
use App\King;
use App\Ace;
use DB;

trait CardTrait
{
    protected $min_ten   = 0;
    protected $min_jack  = 1;
    protected $min_queen = 3;
    protected $min_king  = 5;
    protected $min_ace   = 11;

    /**
     * [maxShuffle Get the Max Shuffle of Each Card]
     * $this->ten->maxShuffle();
     * @return [int] [protected function in a Card]
     */
    public function maxShuffle()
    {
        return $this->maxshuffle;
    }
    /**
     * [shuffleCount Get Total Current Shuffle of Each Card]
     * $this->ten->shuffleCount();
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [int]      [Return All True Shuffle]
     */
    public function shuffleCount($lid)
    {
        $shufflecount = static::where('link_id', $lid)->where('shuffle', true)->count();

        return $shufflecount;
    }
    /**
     * [graduate Limit the Account Max Shuffle to be Receive]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [bool]      [Return True for Graduate Account]
     */
    public function graduate($lid)
    {
        if ($this->maxShuffle() >= $this->shuffleCount($lid)) {
            return false;
        }

        return true;
    }
    /**
     * [deactivate Avoid a Link to receive FreeShuffle But Can Still Receive ForceShuffle]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [void]      [Return Void]
     */
    public function deactivate($lid)
    {
        if ($this->graduate($lid)) {
            static::where('link_id', $lid)->where('active', true)->where('shuffle', false)->update(array('active' => false));
        }
    }
    /**
     * [freeShuffle Every Link Activated Produce FreeShuffle]
     * @return [object] [Returns Each Card Object Instances that Receive FreeShuffle]
     */
    public function freeShuffle()
    {
        $card              = static::where('shuffle', false)->where('active', true)->firstOrFail();
        $card->shuffle     = true;
        $cardID            = $card->id;
        $card->save();
        $cardline = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->update(array('points' => 1));

        return $card;
    }
    /**
     * [freeCycle Receives The Card Object Instance To Execute A Card Cyle]
     * @return [event] [BroadCast FreeCyle in Front END]
     */
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
        $link = \App\Link::find($lid);
        $link = $link->link;
        $data     = [
            'event' => 'FreeCycle',
            'data'  => [
                'link' => $link,
            ],
        ];
        \PHPRedis::publish('rfn-chanel', json_encode($data));
    }
    /**
     * [forceShuffle For Every Successful DR Requirement Or Matrix Cycle Generates ForceShuffle]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [object]      [Return The Card Object that is Entitle for ForceShuffle]
     */
    public function forceShuffle($lid)
    {
        $card              = static::where('link_id', $lid)->where('shuffle', false)->firstOrFail();
        $card->shuffle     = true;
        $cardID            = $card->id;
        $card->save();
        $cardline = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->update(array('points' => 1));

        return $card;
    }
    /**
     * [forceCycle Receive the Forceshuffle Card Object Instances]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [event]      [BroadCast ForceCycle to Front End]
     */
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
        // This will Broadcast To the Front End!
        $link = \App\Link::find($lid);
        $link = $link->link;
        $data     = [
            'event' => 'FreeCycle',
            'data'  => [
                'link' => $link,
            ],
        ];
        \PHPRedis::publish('rfn-chanel', json_encode($data));
    }
    /**
     * [randomShuffle Receive the Random List of Link ID]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [object]      [Returns Card Instance From Random List of Link ID]
     */
    public function randomShuffle($lid)
    {
        $card              = static::where('link_id', $lid)->where('shuffle', false)->where('active', true)->firstOrFail();
        $card->shuffle     = true;
        $cardID            = $card->id;
        $card->save();
        $cardline = Cardline::where('card_type', $this->cardtype)->where('card_id', $cardID)->update(array('points' => 1));

        return $card;
    }
    /**
     * [randomCycle Gives Random Cycle To Link ID's]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [event]      [BroadCast RandomCyle to Front End]
     */
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
        // This will Broadcast To the Front End!
        $link = \App\Link::find($lid);
        $link = $link->link;
        $data     = [
            'event' => 'FreeCycle',
            'data'  => [
                'link' => $link,
            ],
        ];
        \PHPRedis::publish('rfn-chanel', json_encode($data));
    }
    /**
     * [switchToTen Allows Card to Change Card Type to Ten]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [response]      [Returns A Response for Ajax Call of SwitchToTten]
     */
    public function switchToTen($lid)
    {
        DB::beginTransaction();
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
            try {
            if (!$card && !$cardline) {
                throw new \Exception('Switch Line Failed!');
            }
            } catch (\Exception $e) {
            DB::rollback();

            $errors = [
            'ExceptionError' => $e->getMessage(),
            ];

            return response()->json(['success' => false, 'errors' => $errors], 421);
            }
            
            return response()->json(['success' => true, 'message' => 'Successfully Switch to Ten Card Line'], 200);
            }
        $errors = [
            'SameCard' => 'Can\'t Switch Line',
            ];

        return response()->json(['success' => false, 'errors' => $errors], 409);
    }
    /**
     * [switchToJack Allows Card to Change Card Type To Jack]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [response]      [Returns A Response for Ajax Call of switchToJack]
     */
    public function switchToJack($lid)
    {
        DB::beginTransaction();
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
            try {
            if (!$card && !$cardline) {
                throw new \Exception('Switch Line Failed!');
            }
            } catch (\Exception $e) {
            DB::rollback();

            $errors = [
            'ExceptionError' => $e->getMessage(),
            ];

            return response()->json(['success' => false, 'errors' => $errors], 421);
            }

            return response()->json(['success' => true, 'message' => 'Successfully Switch to Jack Card Line'], 200);
        }

        $errors = [
            'SameCard' => 'Can\'t Switch Line',
            ];

        return response()->json(['success' => false, 'errors' => $errors], 409);
    }
    /**
     * [switchToQueen Allows Card to Change Card Type To Queen]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [response]      [Returns A Response for Ajax Call of switchToQueen]
     */
    public function switchToQueen($lid)
    {
        DB::beginTransaction();
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
            try {
            if (!$card && !$cardline) {
                throw new \Exception('Switch Line Failed!');
            }
            } catch (\Exception $e) {
            DB::rollback();

            $errors = [
            'ExceptionError' => $e->getMessage(),
            ];

            return response()->json(['success' => false, 'errors' => $errors], 421);
            }

            return response()->json(['success' => true, 'message' => 'Successfully Switch to Queen Card Line'], 200);
        }

        $errors = [
            'SameCard' => 'Can\'t Switch Line',
            ];

        return response()->json(['success' => false, 'errors' => $errors], 409);

    }
    /**
     * [switchToKing Allows Card to Change Card Type To King]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [response]      [Returns A Response for Ajax Call of switchToKing]
     */
    public function switchToKing($lid)
    {
        DB::beginTransaction();
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
            try {
            if (!$card && !$cardline) {
                throw new \Exception('Switch Line Failed!');
            }
            } catch (\Exception $e) {
            DB::rollback();

            $errors = [
            'ExceptionError' => $e->getMessage(),
            ];

            return response()->json(['success' => false, 'errors' => $errors], 421);
            }

            return response()->json(['success' => true, 'message' => 'Successfully Switch to King Card Line'], 200);
        }

        $errors = [
            'SameCard' => 'Can\'t Switch Line',
            ];

        return response()->json(['success' => false, 'errors' => $errors], 409);
    }
    /**
     * [switchToAce Allows Card to Change Card Type To Ace]
     * @param  [int] $lid [Foreign Key Link ID]
     * @return [response]      [Returns A Response for Ajax Call of switchToAce]
     */
    public function switchToAce($lid)
    {
        DB::beginTransaction();
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
            try {
            if (!$card && !$cardline) {
                throw new \Exception('Switch Line Failed!');
            }
            } catch (\Exception $e) {
            DB::rollback();

            $errors = [
            'ExceptionError' => $e->getMessage(),
            ];

            return response()->json(['success' => false, 'errors' => $errors], 421);
            }
            return response()->json(['success' => true, 'message' => 'Successfully Switch to Ace Card Line'], 200);
        }

        $errors = [
            'SameCard' => 'Can\'t Switch Line',
            ];
            
        return response()->json(['success' => false, 'errors' => $errors], 409);
    }
    
    /**
     * [scopeToday Get Total Cycle Count of a Card Today]
     * * Using Link and Card Relationship
     * $link = Link::find(1);
     * $link->tencards()->cardCountToday()
     * User::find(1)->links->find(1)->tencards()->today()
     * @param  [query] $query [Allows To Chain A Query Scope of a Card]
     * @return [scope]        [result is the Total Count of Cycle of that Link]
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->where('shuffle', true)->count();
    }
}
