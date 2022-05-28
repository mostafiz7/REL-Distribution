<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role_Model extends Model
{
  use HasFactory;


  // connect with db table
  public $table = 'roles';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'name',
    'slug',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



  // relationship with User model
  public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    // return $this->hasMany(User::class, 'role_id');
    return $this->hasMany(User::class);
  }



}
