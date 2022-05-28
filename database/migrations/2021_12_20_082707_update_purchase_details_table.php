<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdatePurchaseDetailsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    /* Schema::table('purchase_details', function (Blueprint $table) {
      $table->string('origin')->after('vehicle_id');
      // $table->string('origin')->nullable()->after('vehicle_id');
      
      //$table->unsignedBigInteger('category_id')->nullable()->after('meta_description');
      //$table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
    }); */
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    /* Schema::table('purchase_details', function (Blueprint $table) {
      $table->dropColumn(['origin']);
      //$table->dropForeign(['category_id']);
      //$table->dropColumn(['category_id']);
    }); */
  }

}
