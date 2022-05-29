<?php

namespace Database\Seeders;

use App\Models\Department_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Department_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Department_Seeder

    Department_Model::create([
      'name'        => 'Central Inventory & Distribution Department',
      'slug'        => 'ci&dd',
      'short_name'  => 'CI&DD',
      'email'       => 'cidd@example.com',
    ]);

    Department_Model::create([
      'name'        => 'Marketing',
      'slug'        => 'marketing',
      'short_name'  => 'MKT.',
      'email'       => 'marketing@example.com',
    ]);

    Department_Model::create([
      'name'        => 'Sales',
      'slug'        => 'sales',
      'short_name'  => 'Sales',
      'email'       => 'sales@example.com',
    ]);

  }


}
