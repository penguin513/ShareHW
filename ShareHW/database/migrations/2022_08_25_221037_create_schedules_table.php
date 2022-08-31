<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('room_id', 12)->comment('部屋ID');
            $table->integer('day_of_week')->comment('登録する曜日');
            $table->string('name', 100)->comment('家事名');
            $table->string('message', 500)->nullable()->comment('内容');
            $table->integer('point')->comment('家事ポイント');
            $table->string('add_name', 100)->comment('追加者');
            $table->string('pic_name', 100)->comment('担当者');
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
        Schema::dropIfExists('schedules');
    }
};
