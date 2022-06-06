<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateUsersTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->unsignedTinyInteger('role_id')->after('password');
      $table->unsignedBigInteger('employee_id')->unique()->after('role_id'); // Employee ID
      $table->unsignedBigInteger('entity_id')->nullable()->after('employee_id'); // Entity ID

      $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
      $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('entity_id')->references('id')->on('entities')->onUpdate('cascade');
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropForeign([ 'role_id', 'employee_id', 'entity_id' ]);
      $table->dropColumn([ 'role_id', 'employee_id', 'entity_id' ]);
    });
  }
}
