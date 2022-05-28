<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Requisition_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'requisitions';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'requisition_no',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



  public function bill(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Bill_Model::class);
  }



}
