<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePartsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('parts', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name')->unique();
      $table->string('slug')->unique();
      $table->boolean('enabled')->default(1);
      $table->unsignedBigInteger('category_id'); // Parts-Category: Headlight, Backlight etc.
      $table->string('description')->nullable();
      $table->string('sizes')->nullable();
      $table->string('metals')->nullable();
      $table->string('materials')->nullable();
      $table->string('unit');
      $table->string('origin')->nullable();

      $table->foreign('category_id')
        ->references('id')->on('parts_category')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parts');
  }
}
