<?php

namespace Database\Seeders;

use App\Models\VehicleCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class VehicleCategory_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=VehicleCategory_Seeder

    VehicleCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Pickup Van',
      'slug'  => 'pickup-van',
    ]);

    VehicleCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Cover Van',
      'slug'  => 'cover-van',
    ]);

    VehicleCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Truck',
      'slug'  => 'truck',
    ]);

    VehicleCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Private Car',
      'slug'  => 'private-car',
    ]);

    VehicleCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Micro Bus',
      'slug'  => 'micro-bus',
    ]);

  }



}
