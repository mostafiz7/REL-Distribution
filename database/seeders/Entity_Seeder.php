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
      'type'          => 'pos',
      'ownership'     => 'own',
      'category'      => 'showroom',
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
      'type'          => 'pos',
      'ownership'     => 'own',
      'category'      => 'showroom',
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
      'type'          => 'pos',
      'ownership'     => 'franchise',
      'category'      => 'showroom',
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
      'type'          => 'pos',
      'ownership'     => 'own',
      'category'      => 'showroom',
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
      'type'          => 'pos',
      'ownership'     => 'franchise',
      'category'      => 'showroom',
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
      'name'          => 'Barishal CTP',
      'slug'          => 'barishal-ctp',
      'email'         => 'barishal-ctp@example.com',
      'district'      => 'Barishal',
      'type'          => 'pos',
      'ownership'     => 'own',
      'category'      => 'showroom',
      'parent_id'     => 7,
      'territory_id'  => 2,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Vola CTP',
      'slug'          => 'vola-ctp',
      'email'         => 'vola-ctp@example.com',
      'district'      => 'Vola',
      'type'          => 'pos',
      'ownership'     => 'own',
      'category'      => 'showroom',
      'parent_id'     => 7,
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
      'type'          => 'pos',
      'ownership'     => 'franchise',
      'category'      => 'showroom',
      'parent_id'     => 10,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

    Entity_Model::create([
      'uid'           => Str::uuid(),
      'name'          => 'Laksam CTP',
      'slug'          => 'laksam-ctp',
      'email'         => 'laksam@example.com',
      'district'      => 'Cumilla',
      'type'          => 'pos',
      'ownership'     => 'own',
      'category'      => 'showroom',
      'parent_id'     => 10,
      'territory_id'  => 9,
      'incharge_id'   => null,
    ]);

  }

}
