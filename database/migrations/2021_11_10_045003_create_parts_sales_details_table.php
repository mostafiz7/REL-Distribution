<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePartsSalesDetailsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('parts_sales_details', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->set('type', ['old', 'scrap', 'new']); // Parts Condition
      $table->unsignedBigInteger('sales_id');
      $table->string('sales_no');
      $table->unsignedBigInteger('parts_id');
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->unsignedBigInteger('transaction_id')->nullable();
      $table->string('transaction_no')->nullable(); // Parts Transaction Number
      $table->unsignedBigInteger('purchase_id')->nullable();
      $table->string('purchase_no')->nullable();
      $table->string('serial')->nullable();
      $table->integer('quantity');
      $table->decimal('amount', $precision = 12, $scale = 2)->nullable();
      $table->text('remarks')->nullable();

      $table->foreign('sales_id')
        ->references('id')->on('parts_sales')->onUpdate('cascade');
      $table->foreign('parts_id')
        ->references('id')->on('parts')->onUpdate('cascade');
      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');
      $table->foreign('transaction_id')
        ->references('id')->on('parts_transactions')->onUpdate('cascade');
      $table->foreign('purchase_id')
        ->references('id')->on('purchases')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parts_sales_details');
  }

}
