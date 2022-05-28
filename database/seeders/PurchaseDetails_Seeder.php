<?php

namespace Database\Seeders;

use App\Models\PurchaseDetails_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class PurchaseDetails_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=PurchaseDetails_Seeder

    PurchaseDetails_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Wheel-Japan',
      'slug'   => 'wheel-japan',
      'origin' => 'Japan',
      'metal'  => 'Rubber',
    ]);

  }



}
