<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateSettingsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('settings', function (Blueprint $table) {
      // $table->id();
      $table->tinyInteger('id')->primary()->default(1);
      $table->char('site_title', 50)->nullable();
      $table->char('tagline', 100)->nullable();
      $table->char('site_url', 50)->nullable();
      $table->char('company_name', 50)->nullable();
      $table->char('company_slogan', 150)->nullable();
      $table->string('company_email', 100)->nullable();
      $table->json('company_contact')->nullable();
      $table->json('company_address')->nullable();
      $table->json('vat_no')->nullable();
      $table->json('business_id')->nullable();
      $table->char('currency_sign', 5)->nullable();
      $table->char('currency_code', 5)->nullable();
      $table->char('currency_fraction', 10)->nullable();
      $table->boolean('sms_service')->default(0); // Enable/Disable SMS-Service
      $table->boolean('new_user_register')->default(0); // Anyone can register
      $table->tinyInteger('new_user_role')->default(5);
      $table->char('site_language', 20)->nullable();
      $table->char('timezone', 20)->nullable();
      $table->char('date_format', 10)->nullable();
      $table->char('time_format', 10)->nullable();
      $table->char('office_hour_start', 10)->nullable();
      $table->char('office_hour_end', 10)->nullable();
      $table->tinyInteger('office_hours')->nullable();
      $table->char('week_start', 10)->nullable();
      $table->char('weekly_holiday', 10)->nullable();
      $table->json('general_holiday')->nullable();
      $table->json('yearly_holiday')->nullable();

      $table->json('mail_config')->nullable(); // Email Configuration
      $table->json('sms_config')->nullable(); // SMS Configuration
      $table->json('google_maps')->nullable(); // Google Maps API-Key, Lat-Long
      
      $table->json('user_settings')->nullable();
      $table->json('notification_settings')->nullable();
      $table->json('employee_settings')->nullable();
      $table->json('department_settings')->nullable();
      $table->json('designation_settings')->nullable();
      $table->json('requisition_settings')->nullable();
      $table->json('bill_settings')->nullable();
      $table->json('company_settings')->nullable();
      $table->json('branch_settings')->nullable();
      $table->json('branch_office_settings')->nullable();
      $table->json('factory_settings')->nullable();
      $table->json('distribution_settings')->nullable();
      $table->json('sales_settings')->nullable();
      $table->json('pos_settings')->nullable();
      $table->json('outlet_settings')->nullable();

      $table->json('purchase_settings')->nullable();
      $table->json('vehicle_settings')->nullable();
      $table->json('parts_settings')->nullable();
      $table->json('category_settings')->nullable();
      $table->json('brand_settings')->nullable();

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('settings');
  }
}
