<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use DB;
use App\User;

class CodeController extends Controller
{
    public $code;
    public $creator;

    public function __construct(Code $code, User $creator)
    {
        $this->code = $code;
        $this->creator = $creator;
    }
    // ADMIN FUNCTION
    public function index()
    {
        $codes = DB::table('codes')->paginate(50);

        return $codes;
    }

    public function getAvailableCodes($qty)
    {
        $codes = DB::table('codes')->where('used', false)->skip(0)->take($qty)->get();

        return $codes;
    }

    public function findByPin($pin)
    {
        $code = Code::findByPin($pin);

        return $code;
    }

    public function generateCodes($qty)
    {
        $codes = $this->code->generateCodes($qty);

        return $codes;
    }

    public function assignCodes($user, $qty)
    {
        $codeTable = (new Code())->getTable();
        $codes = DB::table($codeTable)->where('creator', 1)->where('used', false)->take($qty)->update(array('creator' => $user));
        return $codes;
    }
    // END ADMIN FUNCTION
    public function getUserPin($creator, $pin)
    {
        try {
            $code = Code::where('pin', $pin)->where('used', 0)->where('creator', $creator)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Sorry That Code is Not Available!';
        }

        return $code;
    }

    public function consumeCode($lid, $pin)
    {
        $code = Code::findByPin($pin);
        $code->consumer = $lid;
        $code->used = true;
        $code->date_used = \Carbon\Carbon::now();
        $code->save();

        return $code;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('codes')->where('creator', $id)->skip(0)->take(50)->get();
        return $user;
    }

    public function userPaginatedCodes($id)
    {
        $codes = DB::table('codes')->where('creator', $id)->paginate(50);
        return $codes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
