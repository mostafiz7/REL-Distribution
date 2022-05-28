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
      'uid'        => Str::uuid(),
      'name'       => 'CI&DD',
      'slug'       => 'ci&dd',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Marketing',
      'slug'       => 'marketing',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Sales',
      'slug'       => 'sales',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Audit',
      'slug'       => 'audit',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Accounts',
      'slug'       => 'accounts',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Finance',
      'slug'       => 'finance',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Admin',
      'slug'       => 'admin',
      'short_name' => null,
    ]);

    Department_Model::create([
      'uid'        => Str::uuid(),
      'name'       => 'Factory',
      'slug'       => 'factory',
      'short_name' => null,
    ]);

  }



}
