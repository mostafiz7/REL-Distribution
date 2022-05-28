<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Admin_Middleware
{
  /**
   * Handle an incoming request.
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle( Request $request, Closure $next )
  {
    if( Auth::check() ){
      if( Auth::user()->active ){
        $Role_id = Auth::user()->role_id;
        if( $Role_id == 1 || $Role_id == 2 ){
          return $next( $request );
        } else{
          Session::flush();
          Auth::logout();
          return redirect()->route('login')->with('error', 'The user not matched with system.');
        }
      } else{
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with('error', 'The user not active.');
      }
    } else{
      return redirect()->route('login')->with('error', 'Please, login first!');
    }
  }

}
