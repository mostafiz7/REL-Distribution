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
      'email'             => 'admin@nurullah.biz',
      'username'          => 'nurullah',
      'active'            => 1,
      'password'          => '00',
      'role_id'           => 1,
      'employee_id'       => 1,
      'email_verified_at' => now(),
      'permissions'       => $permissions,
      'routes'            => [
        'database.migration.update',
        'database.migration.fresh',
        'database.migration.fresh.seed',
        'database.migration.rollback',
        'database.seed',
        'employee.all.show',
        'employee.add.new',
        'employee.single.edit',
      ],
      'settings'          => null,
      'email_settings'    => null,
      'sms_settings'      => null,
      'notif_settings'    => null,
    ]);
    
  }

}
