<?php

namespace Database\Seeders;

use App\Models\Role_Model;
use Illuminate\Database\Seeder;

class Role_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Role_Seeder

    Role_Model::create([
      'name'  => 'Super Admin',
      'slug'  => 'super-admin',
    ]);

    Role_Model::create([
      'name'  => 'Admin',
      'slug'  => 'admin',
    ]);

    Role_Model::create([
      'name'  => 'User',
      'slug'  => 'user',
    ]);

    Role_Model::create([
      'name'  => 'Moderator',
      'slug'  => 'moderator',
    ]);

    Role_Model::create([
      'name'  => 'Customer',
      'slug'  => 'customer',
    ]);

  }

}
