<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PartsCategory_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'parts_category';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
    'description',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



  // relationship with Parts model
  public function parts(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Parts_Model::class, 'category_id');
  }



}
