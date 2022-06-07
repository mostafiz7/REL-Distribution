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
      'priority'      => 1,
      'email'         => 'cidd@example.com',
      'district'      => 'Dhaka',
      'category'      => 'office',
      'type'          => 'store',
      'ownership'     => 'own',
      'parent_id'     => null,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Sonartori CTP',
      'slug'          => 'sonartori-ctp',
      'priority'      => 3,
      'email'         => 'sonartori@example.com',
      'district'      => 'Dhaka',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Airport Road CTP',
      'slug'          => 'airport-road-ctp',
      'priority'      => 2,
      'email'         => 'airport@example.com',
      'district'      => 'Dhaka',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Gulshan-1 CTP',
      'slug'          => 'gulshan-1-ctp',
      'priority'      => 6,
      'email'         => 'gulshan1@example.com',
      'district'      => 'Dhaka',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'franchise',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Mymensingh CTP',
      'slug'          => 'mymensingh-ctp',
      'priority'      => 5,
      'email'         => 'mymensingh@example.com',
      'district'      => 'Mymensingh',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Narayangonj CTP',
      'slug'          => 'narayangonj-ctp',
      'priority'      => 4,
      'email'         => 'narayangonj@example.com',
      'district'      => 'Narayangonj',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'franchise',
      'parent_id'     => 1,
      'territory_id'  => 1,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Barishal Zone',
      'slug'          => 'barishal-zone',
      'priority'      => 10,
      'email'         => 'barishal-zone@example.com',
      'district'      => 'Barishal',
      'category'      => 'zone',
      'type'          => 'sub-store',
      'ownership'     => 'own',
      'parent_id'     => 1,
      'territory_id'  => 2,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Barishal CTP',
      'slug'          => 'barishal-ctp',
      'priority'      => 11,
      'email'         => 'barishal-ctp@example.com',
      'district'      => 'Barishal',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'parent_id'     => 7,
      'territory_id'  => 2,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Vola CTP',
      'slug'          => 'vola-ctp',
      'priority'      => 12,
      'email'         => 'vola-ctp@example.com',
      'district'      => 'Vola',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'parent_id'     => 7,
      'territory_id'  => 2,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Cumilla Zone',
      'slug'          => 'cumilla-zone',
      'priority'      => 7,
      'email'         => 'cumilla-zone@example.com',
      'district'      => 'Cumilla',
      'category'      => 'zone',
      'type'          => 'sub-store',
      'ownership'     => 'own',
      'parent_id'     => 1,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Chandpur CTP',
      'slug'          => 'chandpur-ctp',
      'priority'      => 8,
      'email'         => 'chandpur@example.com',
      'district'      => 'Chandpur',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'franchise',
      'parent_id'     => 10,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Laksam CTP',
      'slug'          => 'laksam-ctp',
      'priority'      => 9,
      'email'         => 'laksam@example.com',
      'district'      => 'Cumilla',
      'category'      => 'pos',
      'type'          => 'showroom',
      'ownership'     => 'own',
      'parent_id'     => 10,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

  }

}
