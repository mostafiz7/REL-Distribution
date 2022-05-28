<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Settings_Model extends Model
{
  // use HasFactory;

  // connect with db table
  public $table = 'settings';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    // 'name__slug',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



}
