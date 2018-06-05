<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
      //if user is logged in as user cant log in as admin.
      switch($guard) {
         case 'admin':
         if(Auth::guard($guard)->check()){
            return redirect()->route('admin.dashboard');
        }
         break;
        //for the normal user
        default:
         if(Auth::guard($guard)->check()){
           return redirect()->route('/home');
          }
        break;

        return $next($request);
    }
  }
}
