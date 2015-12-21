<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        if (!\Auth::user()->active) {
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
