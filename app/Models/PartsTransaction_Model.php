<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PartsTransaction_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'parts_transactions';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'tr_no',
    'tr_type',
    'condition',
    'parts_id',
    'vehicle_id',
    'purchase_id',
    'purchase_no',
    'date',
    'serial',
    'quantity',
    'note',
    'requisition_id',
    'requisition_no',
    'mechanic_id',
    'mechanic_name',
    'is_authorized',
    'authorizer_id',
    'user_id',
    'entry_by',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



}
