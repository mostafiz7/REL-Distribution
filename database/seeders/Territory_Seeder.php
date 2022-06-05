<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Territory_Model;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class Territory_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Territory_Seeder

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Dhaka',
      'slug'      => 'dhaka',
      'district'  => 'Dhaka',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Barishal',
      'slug'      => 'barishal',
      'district'  => 'Barishal',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Faridpur',
      'slug'      => 'faridpur',
      'district'  => 'Faridpur',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Khulna',
      'slug'      => 'khulna',
      'district'  => 'Khulna',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Jessore',
      'slug'      => 'jessore',
      'district'  => 'Jessore',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Rangpur',
      'slug'      => 'rangpur',
      'district'  => 'Rangpur',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Rajshahi',
      'slug'      => 'rajshahi',
      'district'  => 'Rajshahi',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Bogura',
      'slug'      => 'bogura',
      'district'  => 'Bogura',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Cumilla',
      'slug'      => 'cumilla',
      'district'  => 'Cumilla',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Chowmuhani',
      'slug'      => 'chowmuhani',
      'district'  => 'Noakhali',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Chittagong',
      'slug'      => 'chittagong',
      'district'  => 'Chittagong',
    ]);

    Territory_Model::create([
      'uid'       => Str::uuid(),
      'name'      => 'Sylhet',
      'slug'      => 'sylhet',
      'district'  => 'Sylhet',
    ]);

  }

}
