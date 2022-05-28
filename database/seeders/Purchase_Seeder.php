<?php

namespace Database\Seeders;

use App\Models\Purchase_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Purchase_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Purchase_Seeder

    Purchase_Model::create([
      'uid'             => Str::uuid(),
      'purchase_no'     => null,
      'type'            => null,
      'requisition_id'  => null,
      'requisition_no'  => null,
      'user_id'         => null,
      'employee_id'     => null,
      'purchaser_name'  => null,
      'supplier_id'     => null,
      'supplier_name'   => null,
      'vehicle_id'      => null,
      'purchase_date'   => null,
      'shop_name'       => null,
      'shop_slug'       => null,
      'shop_contact'    => null,
      'shop_location'   => null,
      'memo_no'         => null,
      'total_qty'       => null,
      'total_amount'    => null,
      'is_paid'         => null,
      'is_partial_paid' => null,
      'paid_amount'     => null,
      'due_amount'      => null,
      'is_billed'       => null,
      'bill_id'         => null,
      'bill_no'         => null,
      'is_authorized'   => null,
      'authorizer_id'   => null,
    ]);

  }



}
