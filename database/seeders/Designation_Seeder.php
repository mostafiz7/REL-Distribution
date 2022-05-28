<?php

namespace Database\Seeders;

use App\Models\Designation_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Designation_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Designation_Seeder

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Officer',
      'slug'       => 'officer',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Manager',
      'slug'       => 'manager',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Electrician',
      'slug'       => 'electrician',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Technician',
      'slug'       => 'technician',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Driver',
      'slug'       => 'driver',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Helper',
      'slug'       => 'helper',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Porter',
      'slug'       => 'porter',
      'short_name' => null,
    ]);

    Designation_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Asst. Manager',
      'slug'       => 'asst-manager',
      'short_name' => 'AM',
    ]);

  }



}
