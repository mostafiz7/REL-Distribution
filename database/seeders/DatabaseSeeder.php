<?php

namespace Database\Seeders;

use App\Models\Brand_Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;


class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed

    // \App\Models\User::factory(10)->create();
    // \App\Models\Brand_Model::factory(40)->create();

    // $this->call(Brand_Seeder::class);
    // $this->call(VehicleCategory_Seeder::class);
    // $this->call(Vehicle_Seeder::class);
    // $this->call(PartsCategory_Seeder::class);
    // $this->call(Parts_Seeder::class);

    $this->call(Settings_Seeder::class);
    
    $this->call(Territory_Seeder::class);
    $this->call(Entity_Seeder::class);

    $this->call(Department_Seeder::class);
    $this->call(Designation_Seeder::class);
    $this->call(Employee_Seeder::class);
    
    $this->call(Permission_Seeder::class);
    $this->call(Role_Seeder::class);
    $this->call(User_Seeder::class);


    // Execute Artisan Commands in Programmatically
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    // Artisan::call('config:clear');
    // Artisan::call('route:cache');
    // Artisan::call('view:cache');

  }



}
