<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'departments';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'name',
    'slug',
    'short_name',
    'email',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'short_name' => 'array',
  ];*/



  public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Employee_Model::class, 'department_id');
  }


  public function vehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Vehicle_Model::class, 'department_id');
  }



}
