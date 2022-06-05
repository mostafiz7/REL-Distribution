<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Entity_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'entities';


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



  public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    // return $this->hasMany(Employee_Model::class, 'entity_id');
    return $this->hasMany(Employee_Model::class);
  }


  public function territory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Territory_Model::class, 'territory_id')->withDefault();
  }


  public function incharge(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'incharge_id')->withDefault();
  }


  public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Entity_Model::class, 'parent_id')->whereNull('parent_id')->with('parent');
  }


  public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Entity_Model::class, 'parent_id')->with('children');
  }

  // $data = Entity_Model::with('children')->whereNull('parent_id');



}
