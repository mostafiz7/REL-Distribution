<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PartsSales_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'parts_sales';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'sales_no',
    'type',
    'vehicle_id',
    'transaction_id',
    'transaction_no',
    'requisition_id',
    'requisition_no',
    'seller_id',
    'seller_name',
    'is_authorized',
    'authorizer_id',
    'date',
    'total_qty',
    'total_amount',
    'buyer_name',
    'buyer_slug',
    'references',
    'note',
    'user_id',
    'entry_by',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



}
