<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdatePartsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    /* Schema::table('parts', function (Blueprint $table) {
      $table->boolean('enabled')->default(1)->after('slug');
      
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
    /* Schema::table('parts', function (Blueprint $table) {
      $table->dropColumn(['enabled']);
      //$table->dropForeign(['category_id']);
      //$table->dropColumn(['category_id']);
    }); */
  }

}
