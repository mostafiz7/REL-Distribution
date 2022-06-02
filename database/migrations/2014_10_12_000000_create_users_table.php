<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name');
      $table->string('username')->unique();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->boolean('active')->default(1);
      $table->string('password');
      // $table->tinyText('role');
      // $table->unsignedTinyInteger('role_id');
      // $table->unsignedBigInteger('employee_id')->unique(); // Employee ID
      $table->string('phone_personal')->unique()->nullable();
      $table->string('phone_official')->unique()->nullable();
      $table->json('permissions');
      $table->json('routes');
      $table->json('settings')->nullable(); // User Other Settings
      $table->json('email_settings')->nullable(); // User Email Settings
      $table->json('sms_settings')->nullable(); // User SMS Settings
      $table->json('notif_settings')->nullable(); // User Notification Settings

      $table->rememberToken();
      $table->timestamps();
      
      /* $table->foreign('role_id')
        ->references('id')->on('roles')->onUpdate('cascade');
      $table->foreign('employee_id')
        ->references('id')->on('employees')->onUpdate('cascade'); */
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
