<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// class CreateEntitiesTable extends Migration // for Laravel up to 8
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
      $table->boolean('active')->default(1);
      $table->integer('priority')->unique()->nullable();
      $table->string('email')->unique()->nullable();
      $table->string('phone_primary')->unique()->nullable();
      $table->string('phone_secondary')->unique()->nullable();
      $table->date('open_date')->nullable();
      $table->date('close_date')->nullable();

      $table->unsignedBigInteger('territory_id')->nullable();
      $table->unsignedBigInteger('parent_id')->nullable();
      // $table->unsignedBigInteger('incharge_id')->nullable();

      $table->set('category', ['office', 'pos', 'zone', 'store', 'service', 'insource', 'customer']);
      $table->set('type', ['office', 'sub-office', 'showroom', 'sales-center', 'corporate', 'dealer', 'sub-dealer', 'service-center', 'store', 'sub-store', 'other'])->nullable();
      $table->set('ownership', ['own', 'franchise', 'exclusive', 'other'])->nullable();

      $table->boolean('has_sale_power')->default(0); // entity-has-sales-power
      $table->boolean('show_sls_report')->default(0); // entity-show-in-sales-report
      $table->boolean('show_stock_report')->default(1); // entity-show-in-stock-report

      $table->string('location')->nullable();
      //$table->decimal('lat', $precision = 12, $scale = 10); // Latitude
      //$table->decimal('long', $precision = 12, $scale = 10); // Longitude
      $table->decimal('lat')->nullable(); // Latitude
      $table->decimal('long')->nullable(); // Longitude

      $table->string('address')->nullable();
      $table->string('city')->nullable();
      $table->string('ps')->nullable(); // police-station
      $table->string('postcode')->nullable();
      $table->string('district')->nullable();

      $table->string('owner_name')->nullable();
      $table->string('owner_contact')->nullable();
      $table->string('owner_email')->nullable();
      $table->string('owner_address')->nullable();

      $table->timestamps();

      $table->foreign('territory_id')
        ->references('id')->on('territories')->onUpdate('cascade');
      $table->foreign('parent_id')
        ->references('id')->on('entities')->onUpdate('cascade');
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
