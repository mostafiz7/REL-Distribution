<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

  use AuthenticatesUsers;


  /**
   * Where to redirect users after login.
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
      {
        //return route('homepage');

        if( Auth::user()->active ){
          // $Role_id = Auth::user()->role_id;
          $Role_id = Auth::user()->role_id;
          
          if( $Role_id == 1 || $Role_id == 2 || $Role_id == 3 || $Role_id == 4 || $Role_id == 5 ){
            return route('admin.dashboard');

          } else{
            // for user $Role_id == 6
            Session::flush();
            Auth::logout();
            return dd('Frontend not build for this type users.');
          }
          
        } else{
          Session::flush();
          Auth::logout();
          session()->flash('error', 'The user not active!');
          return route('login');
        }
      }


  /**
   * Create a new controller instance.
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }


  // Show the Login-Form
  /*public function loginForm()
  {
    return view('auth.login');
  }*/


  // Where to redirect users after login.
  /*public function authenticate( LoginRequest $fields ): \Illuminate\Http\RedirectResponse
  {
    // $credentials = $fields->only( [ 'username', 'password' ] );
    $credentials = [
      'email'     => $fields->email,
      'password'  => $fields->password,
      // 'status'  => 'active',
    ];

    // Returned validated fields also contain the csrf token
    if( Auth::attempt( $credentials ) ){
      $Role_id = Auth::user()->role_id;
      if( $Role_id == 1 || $Role_id == 2 ){
        return redirect()->route('admin.dashboard');

      } elseif( $Role_id == 6 ){
        return redirect()->route('members.home');

      }
    } else{
      return redirect()->back()->with('error', 'The system can\'t reach you!');
    }
  }*/


  // Where to redirect users after logout.
  public function logout( Request $request ): \Illuminate\Http\RedirectResponse
  {
    $sessionKey = null; $message = null;
    if( session('error') ){ $sessionKey = 'error'; $message = session('error'); }
    if( session('success') ){ $sessionKey = 'success'; $message = session('success'); }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    // Session::flush();
    session()->forget('session_id');

    if( $sessionKey && $message ){
      return redirect()->route('login')->with( $sessionKey, $message );
    } else{
      return redirect()->route('homepage');
    }
  }
  

}
