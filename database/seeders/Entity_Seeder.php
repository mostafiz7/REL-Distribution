<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Entity_Model;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class Entity_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Entity_Seeder

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'CI&DD',
      'slug'          => 'cidd',
      'email'         => 'cidd@example.com',
      'district'      => 'Dhaka',
      'type'          => 'office',
      'ownership'     => 'own',
      'category'      => 'store',
      'parent_id'     => null,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Sonartori CTP',
      'slug'          => 'sonartori-ctp',
      'email'         => 'sonartori@example.com',
      'district'      => 'Dhaka',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'category'      => 'outlet',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Airport Road CTP',
      'slug'          => 'airport-road-ctp',
      'email'         => 'airport@example.com',
      'district'      => 'Dhaka',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'category'      => 'outlet',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Gulshan-1 CTP',
      'slug'          => 'gulshan-1-ctp',
      'email'         => 'gulshan1@example.com',
      'district'      => 'Dhaka',
      'type'          => 'showroom',
      'ownership'     => 'franchise',
      'category'      => 'outlet',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Mymensingh CTP',
      'slug'          => 'mymensingh-ctp',
      'email'         => 'mymensingh@example.com',
      'district'      => 'Mymensingh',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'category'      => 'outlet',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Narayangonj CTP',
      'slug'          => 'narayangonj-ctp',
      'email'         => 'narayangonj@example.com',
      'district'      => 'Narayangonj',
      'type'          => 'showroom',
      'ownership'     => 'franchise',
      'category'      => 'outlet',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Barishal Zone',
      'slug'          => 'barishal-zone',
      'email'         => 'barishal-zone@example.com',
      'district'      => 'Barishal',
      'type'          => 'zone',
      'ownership'     => 'own',
      'category'      => 'sub-store',
      'parent_id'     => 1,
      'territory_id'  => 2,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Cumilla Zone',
      'slug'          => 'cumilla-zone',
      'email'         => 'cumilla-zone@example.com',
      'district'      => 'Cumilla',
      'type'          => 'zone',
      'ownership'     => 'own',
      'category'      => 'sub-store',
      'parent_id'     => 1,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Chandpur CTP',
      'slug'          => 'chandpur-ctp',
      'email'         => 'chandpur@example.com',
      'district'      => 'Chandpur',
      'type'          => 'showroom',
      'ownership'     => 'franchise',
      'category'      => 'outlet',
      'parent_id'     => 8,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Laksam CTP',
      'slug'          => 'laksam-ctp',
      'email'         => 'laksam@example.com',
      'district'      => 'Cumilla',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'category'      => 'outlet',
      'parent_id'     => 8,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

  }

}
