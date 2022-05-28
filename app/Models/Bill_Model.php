<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bill_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'bills';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'bill_no',
    'type',
    'requisition_id',
    'requisition_no',
    'user_id',
    'employee_id',
    'billPayer_id',
    'checked_by',
    'bill_date',
    'total_amount',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



  public function requisition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Requisition_Model::class);
  }


  public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(User::class);
  }


  public function maker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'employee_id');
  }


  public function payer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'billPayer_id');
  }


  public function checker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'checked_by');
  }



}
