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
    'active',
    'email',
    'phone_primary',
    'phone_secondary',
    'location',
    'address',
    'city',
    'ps', // police-station
    'postcode',
    'district',
    'type',
    'category',
    'ownership',
    'owner_name',
    'owner_contact',
    'owner_email',
    'owner_address',
    'parent_id',
    'territory_id',
    'incharge_id',
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
    // return $this->belongsTo(Entity_Model::class, 'parent_id')->whereNull('parent_id')->with('parent');
    
    // return $this->belongsTo(Entity_Model::class, 'parent_id')->with('parent');
    return $this->belongsTo(Entity_Model::class, 'parent_id');
  }


  public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    // return $this->hasMany(Entity_Model::class, 'parent_id')->with('children');
    return $this->hasMany(Entity_Model::class, 'parent_id');
  }

  // $data = Entity_Model::whereNull('parent_id')->with('children');



}
