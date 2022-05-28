<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePartsSalesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('parts_sales', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('sales_no')->unique(); // Parts Sales Number
      $table->set('type', ['old', 'scrap', 'new']); // Parts Condition
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->unsignedBigInteger('transaction_id')->nullable();
      $table->string('transaction_no')->nullable(); // Parts Transaction Number
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->string('requisition_no')->nullable();
      $table->unsignedBigInteger('seller_id')->nullable(); // Seller Employee ID
      $table->string('seller_name')->nullable(); // If Seller is other than Employee
      $table->boolean('is_authorized')->default(0);
      $table->unsignedBigInteger('authorizer_id')->nullable(); // Authorized Employee ID
      $table->date('date'); // Parts Sales Date
      $table->integer('total_qty');
      $table->decimal('total_amount', $precision = 12, $scale = 2)->nullable();
      $table->string('buyer_name')->nullable(); // Parts Buyer Name
      $table->string('buyer_slug')->nullable(); // Parts Buyer Slug
      $table->text('references')->nullable();
      $table->text('note')->nullable();
      $table->unsignedBigInteger('user_id')->nullable(); // Sales Entry-By APP User
      $table->string('entry_by')->nullable(); // If Sales Entry-By other than APP User

      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');
      $table->foreign('transaction_id')
        ->references('id')->on('parts_transactions')->onUpdate('cascade');
      $table->foreign('requisition_id')
        ->references('id')->on('requisitions')->onUpdate('cascade');
      $table->foreign('seller_id')
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
    Schema::dropIfExists('parts_sales');
  }

}
