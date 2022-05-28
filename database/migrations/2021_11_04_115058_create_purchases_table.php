<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePurchasesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('purchase_no')->unique();
      $table->set('purchase_type', ['vehicle', 'vehicle-parts', 'electrical', 'electronics', 'stationary', 'furniture']);
      $table->date('date');
      $table->string('memo_no')->index(); // Shops Memo or Bill Number
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->string('requisition_no')->nullable();
      $table->unsignedBigInteger('purchased_by')->nullable(); // Purchaser Employee ID
      $table->string('purchaser_name')->nullable(); // If Purchaser is other than Employee
      $table->unsignedBigInteger('authorized_by')->nullable(); // Authorized Employee ID
      $table->unsignedBigInteger('checked_by')->nullable();
      $table->unsignedBigInteger('supplier_id')->nullable(); // Parts Supplier ID
      $table->string('supplier_name')->nullable(); // Parts Supplier Name
      $table->string('shop_name');
      $table->string('shop_slug')->index();
      $table->string('shop_contact')->index();
      $table->string('shop_location');
      $table->integer('total_qty'); // Maximum 1 crore (1,00,00,000) allowed
      $table->decimal('total_amount', $precision = 12, $scale = 2)->nullable();
      // Maximum 900 crore (900,00,00,000) allowed
      $table->boolean('is_paid');
      $table->boolean('is_partial_paid');
      $table->decimal('paid_amount', $precision = 12, $scale = 2)->nullable();
      $table->decimal('due_amount', $precision = 12, $scale = 2)->nullable();
      $table->unsignedBigInteger('bill_id')->nullable(); // Is Bill done for this purchase?
      $table->string('bill_no')->nullable();
      $table->unsignedBigInteger('user_id')->nullable(); // Purchase Entry-By APP User
      $table->unsignedBigInteger('entry_by')->nullable(); // If Purchase Entry-By other than APP User
      $table->text('notes')->nullable();
      $table->macAddress('device')->nullable();
      $table->ipAddress('ip')->nullable();
      $table->string('ip_address')->nullable();
      $table->string('session_id')->nullable();

      $table->timestamps();

      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');
      $table->foreign('requisition_id')
        ->references('id')->on('requisitions')->onUpdate('cascade');
      $table->foreign('purchased_by')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('authorized_by')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('checked_by')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('supplier_id')
        ->references('id')->on('suppliers')->onUpdate('cascade');
      $table->foreign('bill_id')
        ->references('id')->on('bills')->onUpdate('cascade');
      $table->foreign('user_id')
        ->references('id')->on('users')->onUpdate('cascade');
      $table->foreign('entry_by')
        ->references('id')->on('employees')->onUpdate('cascade');
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('purchases');
  }
}
