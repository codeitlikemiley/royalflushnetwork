<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if (!\Auth::user()->active) {
//          \Session::flash('message', 'Please activate your account to proceed.');
//          return redirect()->guest('auth.guest_activate');
            return view('auth.guestactivate')
                ->with( 'email', \Auth::user()->email )
                ->with( 'date', \Auth::user()->created_at);
        }

        return $this->nocache( $next($request) );
    }

    protected function nocache($response)
    {
        $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Expires','Wed, 17 Aug 1988 00:00:00 GMT');
        $response->headers->set('Pragma','no-cache');

        return $response;
    }

}
