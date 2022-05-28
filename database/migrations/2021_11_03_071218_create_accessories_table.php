<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAccessoriesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('accessories', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name')->unique();
      $table->string('slug')->unique();
      $table->string('origin');
      $table->string('sizes')->nullable();
      $table->string('metals')->nullable();
      $table->string('materials')->nullable();
      $table->string('unit');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('accessories');
  }
}
