<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission_Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class Permission_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Permission_Seeder
  
    Permission_Model::create([ 'id' => 1, 'name' => 'Index', 'slug' => 'index' ]);
    Permission_Model::create([ 'id' => 2, 'name' => 'Create', 'slug' => 'create' ]);
    Permission_Model::create([ 'id' => 3, 'name' => 'View', 'slug' => 'view' ]);
    Permission_Model::create([ 'id' => 4, 'name' => 'Edit', 'slug' => 'edit' ]);
    Permission_Model::create([ 'id' => 5, 'name' => 'Delete', 'slug' => 'delete' ]);
    Permission_Model::create([ 'id' => 6, 'name' => 'Search', 'slug' => 'search' ]);
    Permission_Model::create([ 'id' => 7, 'name' => 'Print', 'slug' => 'print' ]);
    Permission_Model::create([ 'id' => 8, 'name' => 'Confirm', 'slug' => 'confirm' ]);
    Permission_Model::create([ 'id' => 9, 'name' => 'Payment', 'slug' => 'payment' ]);
    Permission_Model::create([ 'id' => 10, 'name' => 'Edit Request', 'slug' => 'edit_request' ]);
    Permission_Model::create([ 'id' => 11, 'name' => 'Restore', 'slug' => 'restore' ]);
    Permission_Model::create([ 'id' => 12, 'name' => 'Force Delete', 'slug' => 'force_delete' ]);
    Permission_Model::create([ 'id' => 13, 'name' => 'Approve', 'slug' => 'approve' ]);
  }
}
