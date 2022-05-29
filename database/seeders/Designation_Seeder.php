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
      'name'       => 'Manager',
      'slug'       => 'manager',
      'short_name' => 'Manager',
    ]);

    Designation_Model::create([
      'name'       => 'Deputy Manager',
      'slug'       => 'deputy-manager',
      'short_name' => 'DM',
    ]);

    Designation_Model::create([
      'name'       => 'Assistant Manager',
      'slug'       => 'assistant-manager',
      'short_name' => 'AM',
    ]);

    Designation_Model::create([
      'name'       => 'Senior Executive',
      'slug'       => 'senior-executive',
      'short_name' => 'Sr. Executive',
    ]);

    Designation_Model::create([
      'name'       => 'Executive',
      'slug'       => 'executive',
      'short_name' => 'Executive',
    ]);

    Designation_Model::create([
      'name'       => 'Driver',
      'slug'       => 'driver',
      'short_name' => 'Driver',
    ]);

    Designation_Model::create([
      'name'       => 'Helper',
      'slug'       => 'helper',
      'short_name' => 'Helper',
    ]);

  }


}
