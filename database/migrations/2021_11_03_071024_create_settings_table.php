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
      $table->id();

      $table->char('company_name', 100)->nullable();
      $table->char('company_slogan', 150)->nullable();

      $table->char('currency', 20)->nullable();
      $table->char('currency_symbol', 20)->nullable();
      
      $table->char('date_format', 20)->nullable();
      $table->char('time_format', 20)->nullable();
      $table->char('office_hour_start', 20)->nullable();
      $table->char('office_hour_end', 20)->nullable();
      $table->tinyInteger('office_hours')->nullable();
      $table->char('weekly_holiday', 20)->nullable();
      $table->json('general_holiday')->nullable();
      $table->json('yearly_holiday')->nullable();
      
      $table->json('user_settings')->nullable();
      $table->json('employee_settings')->nullable();
      $table->json('designation_settings')->nullable();
      $table->json('department_settings')->nullable();
      $table->json('company_settings')->nullable();
      $table->json('branch_settings')->nullable();
      $table->json('branch_office_settings')->nullable();

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
