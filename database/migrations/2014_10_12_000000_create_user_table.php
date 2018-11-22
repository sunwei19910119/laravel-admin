<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('phone',15)->comment('手机号');
            $table->string('password')->default('')->comment('密码');
            $table->tinyInteger('sex')->default(0)->comment('性别：0未设置 1男 2女');
            $table->string('nickname',20)->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->integer('login_time')->default(0)->comment('登录时间');
            $table->string('qq_uuid')->default('');
            $table->string('qq_nick')->default('');
            $table->string('qq_avatar',512)->default('');
            $table->string('wx_uuid')->default('');
            $table->string('wx_nick')->default('');
            $table->string('sign',100)->default('')->comment('个性签名');
            $table->tinyInteger('state')->default(1)->comment('状态；1正常 2封禁');
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
        Schema::dropIfExists('user');
    }
}
