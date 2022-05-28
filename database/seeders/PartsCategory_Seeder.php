<?php

namespace Database\Seeders;

use App\Models\PartsCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class PartsCategory_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=PartsCategory_Seeder

    PartsCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Headlight',
      'slug'  => 'headlight',
    ]);

    PartsCategory_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Backlight',
      'slug'  => 'backlight',
    ]);

  }



}
