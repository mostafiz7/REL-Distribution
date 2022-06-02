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
    'username',
    'email',
    'email_verified_at',
    'active',
    'password',
    'role_id',
    'employee_id',
    'phone_personal',
    'phone_official',
    'permissions',
    'routes',
    'settings',
    'email_settings',
    'sms_settings',
    'notif_settings',
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
    'settings'          => 'array',
    'email_settings'    => 'array',
    'sms_settings'      => 'array',
    'notif_settings'    => 'array',
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
