<?php

namespace Database\Seeders;

use App\Models\Employee_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Employee_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Employee_Seeder

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010032',
      'name'            => 'Nurullah Mohammad',
      'nickname'        => 'Mostafiz',
      'active'          => true,
      'email_official'  => 'admin@nurullah.biz',
      'designation_id'  => 1,
      'department_id'   => 1,
      'authorize_power' => false,
      'purchase_power'  => false,
      // 'user_id'         => 1,
    ]);

    
    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010578',
      'name'            => 'Md. Shahidullah',
      'nickname'        => 'Shahidullah',
      'active'          => true,
      'email_official'  => 'shahidullah@nurullah.biz',
      'designation_id'  => 2,
      'department_id'   => 1,
      'authorize_power' => true,
      'purchase_power'  => false,
    ]);
    
  }


}
