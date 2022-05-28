<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class User_Policy
{
  use HandlesAuthorization;


  // protected $current_route;


  /**
   * Create a new policy instance.
   * @return void
   */
  public function __construct()
  {
    // $this->current_route = Route::current()->getName();
    // $this->current_route = Route::currentRouteName();
    // $this->current_route = request()->route()->getName();
  }


  // Determine whether the user has access to current-route
  public function routeAccess( User $user ): bool
  {
    // $routes        = explode( ',', $user->routes );
    // $current_route = Route::current()->getName();
    // $current_route = Route::currentRouteName();
    $current_route = request()->route()->getName();
    return is_array( $user->routes ) && in_array( $current_route, $user->routes );
    // if( $route_has_access ){ return true; } else{ return false; }
  }


  public function index( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    return in_array( 'index', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
  }


  public function create( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    return in_array( 'create', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
  }


  public function view( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    return in_array( 'view', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
  }


  public function edit( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    return in_array( 'edit', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
  }

  
  public function delete( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    return in_array( 'delete', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
  }


  public function print( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    return in_array( 'print', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
  }



}
