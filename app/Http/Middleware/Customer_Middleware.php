<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Customer_Middleware
{
  /**
   * Handle an incoming request.
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    if( Auth::check() ){
      if( Auth::user()->active ){
        if( Auth::user()->role_id == 6 ){
          return $next( $request );

        } else{
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
