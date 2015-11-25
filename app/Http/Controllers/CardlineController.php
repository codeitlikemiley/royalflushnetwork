<?php

namespace App\Http\Controllers;

use App\Link;
use App\Ten;
use App\Jack;
use App\Queen;
use App\King;
use App\Ace;
use App\Cardline;
use Illuminate\Http\Request;

class CardlineController extends Controller
{
    public $link;
    public $ten;
    public $jack;
    public $queen;
    public $king;
    public $ace;
    public $cardline;
    public function __construct(Link $link, Ten $ten, Jack $jack, Queen $queen, King $king, Ace $ace, Cardline $cardline)
    {
        $this->link     = $link;
        $this->ten      = $ten;
        $this->jack     = $jack;
        $this->queen    = $queen;
        $this->king     = $king;
        $this->ace      = $ace;
        $this->cardline = $cardline;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forceCycle($lid)
    {
        return $this->ace->forceCycle($lid);
    }

    public function switchToJack($lid)
    {
        return $this->ace->switchToTen($lid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($lid)
     {
         $directCount       = Link::where('sp_link_id', $lid)->count();
         $ten               = new Ten();
         $ten->link_id      = $lid;
         $ten->min_direct   = $directCount;
         $ten->save();
         $cardline          = new Cardline();
         $cardline->link_id = $lid;
         $ten->cardpoints()->save($cardline);
     }

    public function FlushLine()
    {
        $this->ten->freeCycle();
        $this->jack->freeCycle();
        $this->queen->freeCycle();
        $this->king->freeCycle();
        $this->ace->freeCycle();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int                       $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                       $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                       $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
