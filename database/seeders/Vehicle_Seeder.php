<?php

namespace Database\Seeders;

use App\Models\Vehicle_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Vehicle_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Vehicle_Seeder

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro TA-0439',
      'slug'           => 'dhaka-metro-ta-0439',
      'category_id'    => 2,
      'brand_id'       => 1,
      'department_id'  => 1,
      'driver_id'      => 4,
      'helper_id'      => 11,
      'helper_name'    => null,
      'is_running'     => 1,
      'wheels'         => 6,
      'engine_cc'      => 1500,
      'purchase_date'  => '2010-07-25',
      'sold_date'      => null,
    ]);

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro TA-1516',
      'slug'           => 'dhaka-metro-ta-1516',
      'category_id'    => 2,
      'brand_id'       => 1,
      'department_id'  => 1,
      'driver_id'      => 5,
      'helper_id'      => 12,
      'helper_name'    => null,
      'is_running'     => 1,
      'wheels'         => 4,
      'engine_cc'      => 1200,
      'purchase_date'  => '2012-05-18',
      'sold_date'      => null,
    ]);

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro TA-6539',
      'slug'           => 'dhaka-metro-ta-6539',
      'category_id'    => 1,
      'brand_id'       => 5,
      'department_id'  => 2,
      'driver_id'      => 6,
      'helper_id'      => 13,
      'helper_name'    => null,
      'is_running'     => 1,
      'wheels'         => 4,
      'engine_cc'      => 800,
      'purchase_date'  => '2015-09-22',
      'sold_date'      => null,
    ]);

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro KA-6065',
      'slug'           => 'dhaka-metro-ka-6065',
      'category_id'    => 4,
      'brand_id'       => 5,
      'department_id'  => 3,
      'driver_id'      => 7,
      'helper_id'      => 14,
      'helper_name'    => null,
      'is_running'     => 1,
      'wheels'         => 4,
      'engine_cc'      => 1800,
      'purchase_date'  => '2018-11-05',
      'sold_date'      => null,
    ]);

  }



}
