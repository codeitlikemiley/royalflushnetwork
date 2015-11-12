<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit()
    {
        $user = Auth::user();

        return \View::make('pages.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), $this->getRules($user));
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user->update($request->all());

        return \View::make('profile.updated');
    }

    /**
     * return validation rules.
     *
     * @param $user
     *
     * @return array
     */
    public function getRules($user)
    {
        return $rules = [
            'full_name' => 'required',
            'email' => 'unique:users,email,'.$user->id,
        ];
    }
}
