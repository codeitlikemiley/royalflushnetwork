<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use DB;
use App\User;
use App\Link;
use App\Traits\CaptchaTrait;
use Validator;
use App\Http\Requests\ActivateFirstLinkRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CodeController extends Controller
{
    use CaptchaTrait;
    public $code;
    public $link;
    public $user;

    public function __construct(Code $code, User $user, Link $link)
    {
        $this->code = $code;
        $this->link = $link;
        $this->user = $user;
    }
    /**
     * This Will Display All The Codes Paginate by 50 Per Page
     */
    public function index()
    {
        $codes = DB::table('codes')->paginate(50);

        return $codes;
    }
    /**
     * This Will Retrieve A Specified $qty of UNUSED Codes
     */
    public function getAvailableCodes($qty)
    {
        $codes = DB::table('codes')->where('used', false)->skip(0)->take($qty)->get();

        return $codes;
    }
    /**
     * This Will Find A Pin That is Unused Regardless of the CREATOR
     */
    public function findByPin($pin)
    {
        $code = Code::findByPin($pin);

        return $code;
    }
    /**
     * This Will Generate a Code
     */
    public function generateCodes($qty)
    {
        $codes = $this->code->generateCodes($qty);

        return $codes;
    }
    /**
     * This Will Transfer a CODE from User1 to User2
     */
    public function transferCodes($user1, $user2, $qty)
    {
        $codeTable = (new Code())->getTable();
        $codes     = DB::table($codeTable)->where('creator', $user1)->where('used', false)->take($qty)->update(array('creator' => $user2));

        return $codes;
    }
    /**
     * This Will Be Available in Public for Checking a User's Pin if It is Used or Not Yet!
     */
    public function checkUserPin($creator, $pin)
    {
        try {
            $code = Code::where('pin', $pin)->where('used', 0)->where('creator', $creator)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Sorry That Code is Not Available!';
        }

        return $code;
    }
    /**
     * This Will be Display Publicly All Codes That Are Available in a User!
     */
    public function totalUserPin($creator)
    {
        $code = Code::where('creator', $creator)->where('used', 0)->count();

        return $code;
    }
    /**
     * Explicit Method in Attaching Link With Eloquent Relationship
     */
    public function consumeCode($lid, $pin)
    {
        $code            = Code::findByPin($pin);
        $code->consumer  = $lid;
        $code->used      = true;
        $code->date_used = \Carbon\Carbon::now();
        $code->save();

        return $code; // return the object
    }
    /**
     * Danger Can cause to Switch the Consumer Not Good
     */
    public function attachLink($lid, $pin)
    {
        $codeTable = (new Code())->getTable();
        $codes     = DB::table($codeTable)->where('pin', $pin)->where('used', false)->take(1)->update(array('consumer' => $lid, 'used' => true, 'date_used' => \Carbon\Carbon::now()));

        return $codes; // return 0 or 1
    }
    /**
     * Will Only Work if Creator is Null
     * Use this If a User will Be Generating His Own CODE From Commission
     */
    public function attachCodeToUser($pin, $username)
    {
        Code::findByPin($pin);
        User::findByUsername($username)->codes()->save($code);
    }
    /**
     * Will Only Work if Consumer is Null
     * Use this During Link Activation of an Account
     */
    public function attachCodeToLink($pin, $link)
    {
        Code::findByPin($pin);
        Link::findByLink($link)->code()->save($code);
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
     * Show The User His Own Code id must be Auth::user->id
     */
    public function show($id)
    {
        $user = DB::table('codes')->where('creator', $id)->skip(0)->take(50)->get();

        return $user;
    }
    /**
     * Show All Codes of An Auth User in Pagination Style
     */
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

    public function showActivateFirstLink()
    {
        return view('auth.activateFirstLink');
    }

    public function activateFirstLink(Request $request)
    {
        $activateFirstLinkRequest = new ActivateFirstLinkRequest();
        $validator                = Validator::make($request->all(), $activateFirstLinkRequest->rules(), $activateFirstLinkRequest->messages());

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()], 400);
        }
        if ($this->captchaCheck() == false) {
            $errors = $validator->errors()->add('captchaerror', 'Captcha Expired Refresh Page!');

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }
        $pin        = $request->pin;
        $secret     = $request->secret;
        $link       = $request->link;
        $code       = Code::where('pin', $pin)->first();
        $link       = Link::findByLink($link);
        if ($link->active == true) {
            $errors = $validator->errors()->add('linkerror', 'Your Link is Already Active');

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }
        if ($code->used == true) {
            $errors = $validator->errors()->add('linkerror', 'Your Code is Already Used!');

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }

        if ($code->attempts > 4) {
            $code->blocked = true;
            $code->save();
        }
        if ($code->blocked === true) {
            $errors = $validator->errors()->add('CodeError', 'Maximum Tries Reach! Code is Blocked!');

            return response()->json(['success' => false, 'errors' => $errors], 423);
        }
        try {
            $validcode = Code::findByPin($pin)->secret($secret)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $code           = Code::findByPin($pin);
            $code->attempts = $code->attempts + 1;
            $code->save();
            $attempts       = $code->attempts;
            $errorMessage   = 5 - $attempts . ' More Attempt Until Code is Blocked!';
            $errors         = $validator->errors()->add('CodeError', $errorMessage);

            return response()->json(['success' => false, 'errors' => $errors], 400);
        }
        // $code here inherent call above
        // $link is modified already to object not string link
        // Both $code and $link are Object Already
        $code->used       = true;
        $link->code()->save($code);
        $link->active     = true;
        $link->sp_link_id = $link->activeSponsor($link->sp_link_id);
        $link->save();

        return response()->json(['success' => true, 'url' => 'FirstLink'], 201);
    }
}
