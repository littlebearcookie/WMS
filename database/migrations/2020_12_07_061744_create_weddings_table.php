<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('weddings', function (Blueprint $table) {
      $table->id();
      $table->string("name", 20);
      $table->string("bridegroom", 20);
      $table->string("bride", 20);
      $table->dateTime("date");
      $table->string("address", 50);
      $table->bigInteger("owner");
      $table->string("key", 100);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('weddings');
  }
}
