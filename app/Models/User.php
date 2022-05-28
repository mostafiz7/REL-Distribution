<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;


  /**
   * The attributes that are mass assignable.
   * @var string[]
   */
  protected $fillable = [
    'uid',
    'name',
    'email',
    'username',
    'active',
    'password',
    'role_id',
    'employee_id',
    'email_verified_at',
    'permissions',
    'routes',
  ];


  /**
   * The attributes that should be hidden for serialization.
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];


  /**
   * The attributes that should be cast.
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'permissions'       => 'array',
    'routes'            => 'array',
  ];


  /**
   * This method hash the password before storing to DB
   * @param $password
   */
  public function setPasswordAttribute( $password )
  {
    $this->attributes['password'] = Hash::make( $password );
  }



  // relationship with Role model
  public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Role_Model::class)->withDefault();
  }


  // relationship with Employee model
  public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class)->withDefault();
  }



}
