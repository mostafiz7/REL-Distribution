<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
    
    $permissions = Permission_Model::pluck('slug')->all();

    User::create([
      'uid'               => Str::uuid(),
      'name'              => 'Nurullah Mohammad',
      'username'          => 'nurullah',
      'email'             => 'admin@nurullah.biz',
      'email_verified_at' => now(),
      'active'            => 1,
      'password'          => '00',
      'role_id'           => 1,
      'employee_id'       => 1,
      'phone_personal'    => null,
      'phone_official'    => null,
      'permissions'       => $permissions,
      'routes'            => [
        'database.migration.update',
        'database.migration.fresh',
        'database.migration.fresh.seed',
        'database.migration.rollback',
        'database.seed',
        'employee.all.index',
        'employee.add.new',
        'employee.single.edit',
        'user.all.index',
        'user.add.new',
        'user.single.show',
        'user.single.edit',
        'my.profile.edit',
      ],
      'settings'          => null,
      'email_settings'    => null,
      'sms_settings'      => null,
      'notif_settings'    => null,
    ]);
    
  }

}
