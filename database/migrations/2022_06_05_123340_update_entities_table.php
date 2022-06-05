<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::table('entities', function (Blueprint $table) {
      $table->unsignedBigInteger('incharge_id')->unique()->nullable()->after('territory_id'); // Employee ID
      
      $table->foreign('incharge_id')
        ->references('id')->on('employees')->onUpdate('cascade');
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::table('entities', function (Blueprint $table) {
      $table->dropForeign([ 'incharge_id' ]);
      $table->dropColumn([ 'incharge_id' ]);
    });
  }

};
