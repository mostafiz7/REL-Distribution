<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Parts_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'parts';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
    'enabled',
    'category_id',
    'description',
    'sizes',
    'metals',
    'materials',
    'unit',
    'origin',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



  public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(PartsCategory_Model::class, 'category_id')->withDefault();
  }


  public function purchaseDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(PurchaseDetails_Model::class, 'parts_id');
  }



}
