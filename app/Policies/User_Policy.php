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
    // if( $route_has_access ){ return true; } else{ return false; }
    $current_route = request()->route()->getName();
    return is_array( $user->routes ) && in_array( $current_route, $user->routes );
  }


  public function index( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'index', $user->permissions );
  }


  public function create( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'create', $user->permissions );
  }


  public function view( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'view', $user->permissions );
  }


  public function edit( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'edit', $user->permissions );
  }

  
  public function delete( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'delete', $user->permissions );
  }


  public function search( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'search', $user->permissions );
  }


  public function print( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'print', $user->permissions );
  }


  public function confirm( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'confirm', $user->permissions );
  }


  public function payment( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'payment', $user->permissions );
  }


  public function edit_request( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'edit-request', $user->permissions );
  }


  public function restore( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'restore', $user->permissions );
  }


  public function force_delete( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'force-delete', $user->permissions );
  }


  public function approve( User $user ): bool
  {
    // $permissions    = explode( ',', $user->permissions );
    // if( $has_permission ){ return true; } else{ return false; }
    return in_array( 'approve', $user->permissions );
  }



}
