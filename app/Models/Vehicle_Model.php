<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vehicle_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'vehicles';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'vehicle_no',
    'slug',
    'enabled',
    'brand_id',
    'category_id',
    'department_id',
    'driver_id',
    'helper_id',
    'helper_name',
    'is_running',
    'wheels',
    'engine_cc',
    'origin',
    'purchase_date',
    'sold_date',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



  public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Brand_Model::class)->withDefault();
  }


  public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(VehicleCategory_Model::class)->withDefault();
  }


  public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Department_Model::class)->withDefault();
  }


  public function driver(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Employee_Model::class, 'id', 'driver_id')->withDefault();
  }


  public function helper(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Employee_Model::class, 'id', 'helper_id')->withDefault();
  }


  public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Purchase_Model::class, 'vehicle_id');
  }


  public function purchaseDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(PurchaseDetails_Model::class, 'vehicle_id');
  }



}
