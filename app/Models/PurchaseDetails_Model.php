<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PurchaseDetails_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'purchase_details';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'type',
    'purchase_id',
    'purchase_no',
    'parts_id',
    'vehicle_id',
    'origin',
    'size',
    'serials',
    'quantity',
    'unit',
    'unit_price',
    'amount',
    'remarks',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



  public function purchase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Purchase_Model::class);
  }


  public function parts(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Parts_Model::class);
  }


  public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Vehicle_Model::class);
  }



}
