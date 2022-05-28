<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateRequisitionsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('requisitions', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('requisition_no')->unique();
      $table->date('requisition_date');
      $table->unsignedBigInteger('user_id')->nullable(); // If Requisition Creator is APP User
      $table->unsignedBigInteger('employee_id'); // Requisition Creator Employee ID

      $table->foreign('user_id')
        ->references('id')->on('users')->onUpdate('cascade');
      $table->foreign('employee_id')
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
    Schema::dropIfExists('requisitions');
  }
}
