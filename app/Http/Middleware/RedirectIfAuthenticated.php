<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  ...$guards
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {

    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
      /* if (Auth::guard($guard)->check()) {
        return redirect(RouteServiceProvider::HOME);
      } */

      /*if( Auth::guard( $guard )->check() && Auth::user()->role->id == 1 ){
        return redirect()->route('admin.dashboard');
      } elseif( Auth::guard( $guard )->check() && Auth::user()->role->id == 2 ){
        return redirect()->route('members.home');
      } else{
        return $next($request);
      }*/

      if( Auth::guard( $guard )->check() ){
        if( Auth::user()->active ){
          //$Role_id = Auth::user()->role->id;
          $Role_id = Auth::user()->role_id;

          if( $Role_id == 1 || $Role_id == 2 ){
            return redirect()->route('admin.dashboard');

          } else{
            return redirect()->route('homepage');
          }
          
        } else{
          Session::flush();
          Auth::logout();
          return redirect()->route('login')->with('error', 'The user not active.');
        }

      } else{
        return $next($request);
      }

    }

  }
  
}
