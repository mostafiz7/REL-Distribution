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
    Schema::create('territories', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name')->unique();
      $table->string('slug')->unique();
      $table->string('district');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('territories');
  }

};
