<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// CreateScrapPartsSalesTable
class CreatePartsTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('parts_transactions', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('tr_no')->unique(); // Parts Transaction Number
      $table->set('tr_type', ['vehicle_out', 'vehicle_in']); // Parts Transaction-Type
      $table->set('condition', ['old', 'new']); // Parts Condition
      $table->unsignedBigInteger('parts_id')->nullable();
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->unsignedBigInteger('purchase_id')->nullable();
      $table->string('purchase_no')->nullable();
      $table->date('date'); // Parts Transaction Date
      $table->string('serial')->nullable();
      $table->integer('quantity');
      $table->text('note')->nullable();
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->string('requisition_no')->nullable();
      $table->unsignedBigInteger('mechanic_id')->nullable(); // Mechanic Employee ID
      $table->string('mechanic_name')->nullable(); // If Mechanic is other than Employee
      $table->boolean('is_authorized')->default(0);
      $table->unsignedBigInteger('authorizer_id')->nullable(); // Authorized Employee ID
      $table->unsignedBigInteger('user_id')->nullable(); // Transaction Entry-By APP User
      $table->string('entry_by')->nullable(); // If Transaction Entry-By other than APP User

      $table->foreign('parts_id')
        ->references('id')->on('parts')->onUpdate('cascade');
      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');
      $table->foreign('purchase_id')
        ->references('id')->on('purchases')->onUpdate('cascade');
      $table->foreign('requisition_id')
        ->references('id')->on('requisitions')->onUpdate('cascade');
      $table->foreign('mechanic_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('authorizer_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('user_id')
        ->references('id')->on('users')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parts_transactions');
  }

}
