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
      'designation_id'  => 8,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010078',
      'name'            => 'Md. Din Islam',
      'nickname'        => 'Din Islam',
      'active'          => true,
      'designation_id'  => 4,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 1,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010708',
      'name'            => 'Md. Tanvir',
      'nickname'        => 'Tanvir',
      'active'          => true,
      'designation_id'  => 3,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 1,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010058',
      'name'            => 'Md. Sohag',
      'nickname'        => 'Sohag 1',
      'active'          => true,
      'designation_id'  => 5,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010098',
      'name'            => 'Md. Rajib',
      'nickname'        => 'Rajib',
      'active'          => true,
      'designation_id'  => 5,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010145',
      'name'            => 'Md. Jahangir',
      'nickname'        => 'Jahangir',
      'active'          => true,
      'designation_id'  => 5,
      'department_id'   => 3,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010284',
      'name'            => 'Md. Selim Molla',
      'nickname'        => 'Molla',
      'active'          => true,
      'designation_id'  => 5,
      'department_id'   => 2,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010376',
      'name'            => 'Md. Tuhin',
      'nickname'        => 'Tuhin',
      'active'          => true,
      'designation_id'  => 5,
      'department_id'   => 3,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010428',
      'name'            => 'Md. Sharafat',
      'nickname'        => 'Sharafat',
      'active'          => true,
      'designation_id'  => 6,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010467',
      'name'            => 'Md. Rayhan',
      'nickname'        => 'Rayhan',
      'active'          => true,
      'designation_id'  => 6,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010572',
      'name'            => 'Md. Mannan',
      'nickname'        => 'Mannan',
      'active'          => true,
      'designation_id'  => 6,
      'department_id'   => 3,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010518',
      'name'            => 'Md. Sajal Ahmed',
      'nickname'        => 'Sajal',
      'active'          => true,
      'designation_id'  => 6,
      'department_id'   => 2,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010239',
      'name'            => 'Md. Hannan Mridha',
      'nickname'        => 'Hannan',
      'active'          => true,
      'designation_id'  => 6,
      'department_id'   => 3,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010464',
      'name'            => 'Md. Ruhul Amin',
      'nickname'        => 'Ruhul 1',
      'active'          => true,
      'designation_id'  => 7,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010483',
      'name'            => 'Md. Ruhul Amin',
      'nickname'        => 'Ruhul 2',
      'active'          => true,
      'designation_id'  => 7,
      'department_id'   => 1,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010359',
      'name'            => 'Md. Khalil Mondol',
      'nickname'        => 'Khalil',
      'active'          => true,
      'designation_id'  => 7,
      'department_id'   => 2,
      'authorize_power' => 0,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010029',
      'name'            => 'Md. Rakibus Sultan',
      'nickname'        => 'Manik',
      'active'          => true,
      'designation_id'  => 2,
      'department_id'   => 1,
      'authorize_power' => 1,
      'purchase_power'  => 0,
    ]);

    Employee_Model::create([
      'uid'             => Str::uuid(),
      'office_id'       => '010035',
      'name'            => 'Md. Shahidullah',
      'nickname'        => 'Shahid',
      'active'          => true,
      'designation_id'  => 8,
      'department_id'   => 1,
      'authorize_power' => 1,
      'purchase_power'  => 0,
    ]);

  }



}
