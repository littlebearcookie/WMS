<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string("name", 20);
            $table->string("phone", 20);
            $table->bigInteger("wedding");
            $table->integer("whose"); # 誰的人 0: 女方、1: 男方
            $table->integer("relation"); # 身份 0: 親戚、1: 朋友、2: 同事
            $table->text("remark"); # 備註
            $table->integer("attend"); # 是否出席 -1:不出席、0:不確定、1:確定出席
            $table->integer("attend_num"); # 出席人數(包含自己)
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
        Schema::dropIfExists('participants');
    }
}
