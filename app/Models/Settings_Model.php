<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Settings_Model extends Model
{
  // use HasFactory;

  // connect with db table
  public $table = 'settings';


  protected $primaryKey = 'id';
  public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'site_title',
    'tagline',
    'site_url',
    'company_name',
    'company_slogan',
    'company_email',
    'company_contact',
    'company_address',
    'vat_no',
    'business_id',
    'currency_sign',
    'currency_code',
    'currency_fraction',
    'sms_service',
    'new_user_register',
    'new_user_role',
    'site_language',
    'timezone',
    'date_format',
    'time_format',
    'office_hour_start',
    'office_hour_end',
    'office_hours',
    'week_start',
    'weekly_holiday',
    'general_holiday',
    'yearly_holiday',
    'mail_config',
    'sms_config',
    'google_maps',
    'user_settings',
    'notification_settings',
    'employee_settings',
    'department_settings',
    'designation_settings',
    'requisition_settings',
    'bill_settings',
    'company_settings',
    'branch_settings',
    'branch_office_settings',
    'factory_settings',
    'distribution_settings',
    'sales_settings',
    'pos_settings',
    'outlet_settings',
    'purchase_settings',
    'vehicle_settings',
    'parts_settings',
    'category_settings',
    'brand_settings',
  ];


  // Declare any field as json array
  protected $casts = [
    'company_contact'         => 'array',
    'company_address'         => 'array',
    'vat_no'                  => 'array',
    'business_id'             => 'array',
    'general_holiday'         => 'array',
    'yearly_holiday'          => 'array',
    'mail_config'             => 'array',
    'sms_config'              => 'array',
    'google_maps'             => 'array',
    'user_settings'           => 'array',
    'notification_settings'   => 'array',
    'employee_settings'       => 'array',
    'department_settings'     => 'array',
    'designation_settings'    => 'array',
    'requisition_settings'    => 'array',
    'bill_settings'           => 'array',
    'company_settings'        => 'array',
    'branch_settings'         => 'array',
    'branch_office_settings'  => 'array',
    'factory_settings'        => 'array',
    'distribution_settings'   => 'array',
    'sales_settings'          => 'array',
    'pos_settings'            => 'array',
    'outlet_settings'         => 'array',
    'purchase_settings'       => 'array',
    'vehicle_settings'        => 'array',
    'parts_settings'          => 'array',
    'category_settings'       => 'array',
    'brand_settings'          => 'array',
  ];



}
