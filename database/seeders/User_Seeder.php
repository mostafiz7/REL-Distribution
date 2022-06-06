<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Employee_Model;
use Illuminate\Database\Seeder;
use App\Models\Permission_Model;

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
      'routes'            => [
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
      ],
      'settings'          => null,
      'email_settings'    => null,
      'sms_settings'      => null,
      'notif_settings'    => null,
    ]);

    $employee->update([ 'user_id' => 1 ]);
    
  }

}
