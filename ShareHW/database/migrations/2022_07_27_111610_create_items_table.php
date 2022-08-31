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
        Schema::create('items', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('room_id', 12)->comment('部屋ID')->unique();
            $table->string('add_name')->comment('追加者');
            $table->string('name', 100)->comment('アイテム名');
            $table->string('photo', 2000)->comment('写真')->nullable();
            $table->string('message', 500)->comment('内容')->nullable();
            $table->integer('category')->comment('カテゴリー番号')->nullable()->default(1);
            $table->integer('required')->comment('追加購入(1:必要なし、2:希望)')->default(1);
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
        Schema::dropIfExists('items');
    }
};
