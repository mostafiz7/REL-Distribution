<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Territory_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'territories';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
    'district',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



  public function entities(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    // return $this->hasMany(Entity_Model::class, 'territory_id');
    return $this->hasMany(Entity_Model::class);
  }

  

}
