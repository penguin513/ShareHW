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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ユーザID');
            $table->string('name')->comment('ユーザ名');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('room_id', 12)->comment('部屋ID');
            $table->string('area', 6)->comment('地域コード');
            $table->integer('color')->default(1)->nullable()->comment('画面カラー');
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス認証日時');
            $table->string('password')->comment('パスワード');
            $table->rememberToken();
            $table->integer('role')->default(5)->comment('権限1:管理者、5:一般');
            $table->softDeletes()->comment('論理削除');
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
        Schema::dropIfExists('users');
    }
};
