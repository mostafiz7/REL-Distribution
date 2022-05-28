<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Supplier_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'suppliers';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



}
