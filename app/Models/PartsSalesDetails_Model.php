<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PartsSalesDetails_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'parts_sales_details';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'type',
    'sales_id',
    'sales_no',
    'parts_id',
    'vehicle_id',
    'transaction_id',
    'transaction_no',
    'purchase_id',
    'purchase_no',
    'serial',
    'quantity',
    'amount',
    'remarks',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



}
