<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePartsCategoryTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('parts_category', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name')->unique();
      $table->string('slug')->unique();
      $table->string('description')->nullable();

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parts_category');
  }

}
