<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\User_Policy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   * @var array
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    // \App\User::class => \App\Policies\UserPolicy::class,
    User::class => User_Policy::class,
  ];


  /**
   * Register any authentication / authorization services.
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();


    /* GATES DEFINE FOR USER CURRENT-ROUTE ACCESS && PERMISSIONS */
    // Gate::define( 'routeHasAccess', 'App\Policies\User_Policy@routeAccess' );
    Gate::define('routeHasAccess', [User_Policy::class, 'routeAccess']);
    Gate::define('entryIndex', [User_Policy::class, 'index']);
    Gate::define('entryCreate', [User_Policy::class, 'create']);
    Gate::define('entryView', [User_Policy::class, 'view']);
    Gate::define('entryEdit', [User_Policy::class, 'edit']);
    Gate::define('entryDelete', [User_Policy::class, 'delete']);
    Gate::define('entryPrint', [User_Policy::class, 'print']);


    /* GATES DEFINE FOR USER ROLE */
    // Define gate for user role is admin & super-admin
    Gate::define('isAdmins', function( $user ){
      return ($user->role_id == 1 || $user->role_id == 2) && ($user->role->slug == 'super-admin' || $user->role->slug == 'admin');
      // if( $user->role->slug == 'super-admin' || 'admin' ){ return true; } else{ return false; }
    });

    // Define gate for user role is super-admin
    Gate::define('isSuperAdmin', function( $user ){
      return $user->role_id == 1 && $user->role->slug == 'super-admin';
      // if( $user->role->slug == 'super-admin' ){ return true; } else{ return false; }
    });

    // Define gate for user role is admin
    Gate::define('isAdmin', function( $user ){
      return $user->role_id == 2 && $user->role->slug == 'admin';
      // if( $user->role->slug == 'admin' ){ return true; } else{ return false; }
    });

    
  }

}
