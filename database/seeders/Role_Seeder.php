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

    Role_Model::create(['id' => 1, 'name' => 'Super Admin', 'slug' => 'super-admin']);
    Role_Model::create(['id' => 2, 'name' => 'Admin',       'slug' => 'admin']);
    Role_Model::create(['id' => 3, 'name' => 'Manager',     'slug' => 'manager']);
    Role_Model::create(['id' => 4, 'name' => 'Moderator',   'slug' => 'moderator']);
    Role_Model::create(['id' => 5, 'name' => 'User',        'slug' => 'user']);
    Role_Model::create(['id' => 6, 'name' => 'Customer',    'slug' => 'customer']);

  }

}
