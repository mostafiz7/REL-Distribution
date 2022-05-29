<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permission_Model extends Model
{
  // use HasFactory;


  // connect with db table
  public $table = 'permissions';

  protected $primaryKey = 'id';
  public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'id',
    'name',
    'slug',
  ];


  // make relationship with user model
  /* public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(User::class);
  } */


  
}
