<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Accessories_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'accessories';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
    'origin',
    'sizes',
    'metals',
    'materials',
    'unit',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



}
