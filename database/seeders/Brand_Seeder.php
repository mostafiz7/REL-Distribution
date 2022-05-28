<?php

namespace Database\Seeders;

use App\Models\Brand_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Brand_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Brand_Seeder

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Toyota',
      'slug'   => 'toyota',
      'origin' => 'Japan',
    ]);

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Audi',
      'slug'   => 'audi',
      'origin' => 'United States',
    ]);

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Porsche',
      'slug'   => 'porsche',
      'origin' => 'United States',
    ]);

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Hyundai',
      'slug'   => 'hyundai',
      'origin' => 'South Korea',
    ]);

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Xinkai',
      'slug'   => 'xinkai',
      'origin' => 'China',
    ]);

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Mercedes-Benz',
      'slug'   => 'mercedes-benz',
      'origin' => 'Germany',
    ]);

    Brand_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Rolls-Royce',
      'slug'   => 'rolls-royce',
      'origin' => 'United Kingdom',
    ]);

  }



}
