<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBillsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('bills', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('bill_no')->unique();
      $table->set('bill_type', ['conveyance', 'customer-delivery', 'entertainment', 'lunch', 'dinner', 'labor', 'vehicle-module-parts', 'electrical', 'electronics', 'stationary', 'furniture']);
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->string('requisition_no')->nullable();
      $table->unsignedBigInteger('user_id')->nullable(); // APPS User ID
      $table->unsignedBigInteger('employee_id'); // Bill maker Employee ID
      $table->unsignedBigInteger('billPayer_id')->nullable(); // Bill-Payer Employee ID
      $table->unsignedBigInteger('checked_by')->nullable(); // Bill Checked_by Employee ID
      $table->date('bill_date');
      $table->integer('bill_amount');

      $table->foreign('requisition_id')
        ->references('id')->on('requisitions')->onUpdate('cascade');
      $table->foreign('user_id')
        ->references('id')->on('users')->onUpdate('cascade');
      $table->foreign('employee_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('billPayer_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('checked_by')
        ->references('id')->on('employees')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('bills');
  }

}
