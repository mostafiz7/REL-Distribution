<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Employee_Model;
use Illuminate\Database\Seeder;
use App\Models\Permission_Model;
use Illuminate\Support\Facades\Route;

class User_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=User_Seeder
    
    $permissions  = Permission_Model::pluck('slug')->all();
    $employee     = Employee_Model::find(1);
    
    // Get all named-route to uses for user permissions
    $routes_arr = [];
    $routes_generated = [];
    foreach( Route::getRoutes()->getRoutes() as $route ){
      $action = $route->getAction();
      if( array_key_exists('as', $action) ){
        $routes_arr[] = $action['as'];

        if( str_contains($action['as'], 'generated') || str_contains($action['as'], 'ignition') ){
          $routes_generated[] = $action['as'];
        }
      }
    }

    $route_exclude = [ 'login', 'logout', 'register', 'homepage', 'contact-us', ];
    // merge all excluded routes
    $route_exclude_all = array_merge( $routes_generated, $route_exclude );
    // exclude unnecessary route from array value with key & re-index the key
    $routes_all = array_values( array_diff( $routes_arr, $route_exclude_all ) );
    // Remove duplicate array value & sorting by ascending order
    $routes = array_unique( $routes_all );
    sort( $routes );


    User::create([
      'uid'               => Str::uuid(),
      'name'              => $employee->name,
      'username'          => 'nurullah',
      'email'             => $employee->email_official,
      //'email'             => 'admin@nurullah.biz',
      'password'          => '00',
      'email_verified_at' => now(),
      'active'            => 1,
      'role_id'           => 1,
      'employee_id'       => $employee->id,
      'entity_id'         => $employee->entity_id,
      'entity_name'       => $employee->entity_name,
      'entity_position'   => $employee->entity_position,
      'phone_personal'    => $employee->phone_personal,
      'phone_official'    => $employee->phone_official,
      'permissions'       => $permissions,
      'routes'            => $routes,
      /* 'routes'            => [
        'admin.dashboard',
        'database.migration.update',
        'database.migration.fresh',
        'database.migration.fresh.seed',
        'database.migration.rollback',
        'database.seed',
        'employee.all.index',
        'employee.new.create',
        'employee.new.store',
        'employee.single.edit',
        'employee.single.update',
        'user.all.index',
        'user.new.create',
        'user.new.store',
        'user.single.show',
        'user.single.edit',
        'user.single.update',
        'my-profile.edit',
        'my-profile.update',
      ], */
      'settings'          => null,
      'email_settings'    => null,
      'sms_settings'      => null,
      'notif_settings'    => null,
    ]);

    $employee->update([ 'user_id' => 1 ]);
    
  }

}
