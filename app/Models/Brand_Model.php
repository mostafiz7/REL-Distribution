<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Brand_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'brands';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
    'origin',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'origin' => 'array',
  ];*/



  public function vehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Vehicle_Model::class);
  }



}
