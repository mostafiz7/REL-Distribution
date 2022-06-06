<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Entity_Model;
use App\Models\Employee_Model;
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
      'entity_id'       => 1,
      'entity_name'     => 'CI&DD',
      'entity_position' => 'incharge',
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
      'entity_id'       => 7,
      'entity_name'     => 'Barishal Zone',
      'entity_position' => 'incharge',
      'authorize_power' => true,
      'purchase_power'  => false,
    ]);
    
  }


}
