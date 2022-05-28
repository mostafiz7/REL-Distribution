<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'employees';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'office_id',
    'name',
    'nickname',
    'active',
    'birth_date',
    'father_name',
    'mother_name',
    'gender',
    'marital_status',
    'religion',
    'primary_contact',
    'secondary_contact',
    'email_personal',
    'email_official',
    'present_address',
    'permanent_address',
    'country',
    'joining_date',
    'confirmation_date',
    'employment_status',
    'designation_id',
    'department_id',
    'dept_position',
    'company',
    'signatory_role',
    'work_location',
    'is_resigned',
    'in_leave',
    'salary',
    'salary_details',
    'previous_salary',
    'authorize_power',
    'purchase_power',
    'user_id',
  ];
  

  // Declare any field as json array
  protected $casts = [
    'salary_details'  => 'array',
    'previous_salary' => 'array',
  ];



  public function designation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Designation_Model::class)->withDefault();
  }


  public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Department_Model::class)->withDefault();
  }


  public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(User::class);
  }


  public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Vehicle_Model::class, 'driver_id')->withDefault();
  }


  public function bills(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Bill_Model::class, 'employee_id');
  }


  public function billPaying(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Bill_Model::class, 'billPayer_id');
  }


  public function billChecked(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Bill_Model::class, 'checked_by');
  }



}
