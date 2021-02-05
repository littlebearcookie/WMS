<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('questions', function (Blueprint $table) {
      $table->id();
      $table->bigInteger("form_id");
      $table->char('type', 1);
      $table->string('text', 50);
      $table->boolean('required')->default(false);
      $table->integer("sort");
      /** type
       *  1: text (text)
       *  2: single choice (option)
       *  3: multiple choice (checkbox)
       */
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('questions');
  }
}
