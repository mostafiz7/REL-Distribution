<?php

namespace Database\Factories;

use App\Models\Purchase_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class Purchase_ModelFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   * @var string
   */
  protected $model = Purchase_Model::class;


  /**
   * Define the model's default state.
   * @return array
   */
  public function definition()
  {
    return [
      'uid'             => $this->faker->uuid,
      'purchase_no'     => $this->faker->randomElement([
        '2021/122', '2021/123', '2021/124', '2021/125', '2021/126', '2021/127', '2021/128'
      ]),
      'type'            => 'vehicle_parts',
      'requisition_id'  => null,
      'requisition_no'  => null,
      'user_id'         => null,
      'employee_id'     => $this->faker->randomElement([1, 2]),
      'purchaser_name'  => null,
      'supplier_id'     => null,
      'supplier_name'   => null,
      'vehicle_id'      => $this->faker->randomElement([1, 2, 3, 4]),
      'purchase_date'   => $this->faker->randomElement([
        '2021-10-25', '2021-10-28', '2021-11-03'
      ]),
      'shop_name'       => $this->faker->randomElement([
        'Shaown Enterprise', 'Dhaka Traders', 'Uttara Motors'
      ]),
      'shop_slug'       => $this->faker->randomElement([
        'shaown-enterprise', 'dhaka-traders', 'uttara-motors'
      ]),
      'shop_contact'    => $this->faker->phoneNumber,
      'shop_location'   => $this->faker->randomElement([
        'Bangshal', 'Mohakhali', 'Uttara'
      ]),
      'memo_no'         => $this->faker->randomElement([
        '0178', '1276', '084', '1067', '0724', '0814', '0923'
      ]),
      'total_qty'       => $this->faker->randomElement([ 1, 3, 1, 1, 2, 1, 1 ]),
      'total_amount'    => $this->faker->randomElement([
        1240, 8450, 2040, 22500, 14800, 1890, 870
      ]),
      'is_paid'         => true,
      'is_partial_paid' => false,
      'paid_amount'     => $this->faker->randomElement([
        1240, 8450, 2040, 22500, 14800, 1890, 870
      ]),
      'due_amount'      => null,
      'is_billed'       => false,
      'bill_id'         => null,
      'bill_no'         => null,
      'is_authorized'   => false,
      'authorizer_id'   => null,
    ];

  }



}
