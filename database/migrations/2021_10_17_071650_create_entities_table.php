<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// class CreateTerritoriesTable extends Migration // for Laravel up to 8
return new class extends Migration // for Laravel 9
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('entities', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name')->unique();
      $table->string('slug')->unique();
      $table->string('email')->unique()->nullable();
      $table->string('phone_primary')->unique()->nullable();
      $table->string('phone_secondary')->unique()->nullable();
      $table->string('location')->nullable();
      $table->string('address')->nullable();
      $table->string('city')->nullable();
      $table->string('ps')->nullable(); // police-station
      $table->string('district')->nullable();
      $table->set('type', ['office', 'showroom', 'sales-center', 'dealer', 'zone', 'store', 'insource', 'customer']);
      $table->set('ownership', ['own', 'franchise', 'exclusive', 'other'])->nullable();
      $table->set('category', ['office', 'sub-office', 'outlet', 'store', 'sub-store', 'other'])->nullable();

      $table->string('owner_name')->nullable();
      $table->string('owner_contact')->nullable();
      $table->string('owner_email')->nullable();
      $table->string('owner_address')->nullable();

      $table->unsignedBigInteger('parent_id')->nullable();
      $table->unsignedBigInteger('territory_id')->nullable();
      // $table->unsignedBigInteger('incharge_id')->nullable();

      $table->timestamps();

      $table->foreign('parent_id')
        ->references('id')->on('entities')->onUpdate('cascade');
      $table->foreign('territory_id')
        ->references('id')->on('territories')->onUpdate('cascade');
      // $table->foreign('incharge_id')->references('id')->on('employees')->onUpdate('cascade');
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('entities');
  }

};