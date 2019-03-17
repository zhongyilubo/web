<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile',15);
            $table->string('password');
            $table->tinyInteger('type')->default(0)->nullable()->comment('1：超级管理员2：租客 4：员工8：平台用户');
            $table->tinyInteger('status')->default(0)->nullable()->comment('0停止 1正常 2冻结');
            $table->integer('balance')->default(0)->nullable()->comment('账户金额');
            $table->timestamp('last_login_time')->nullable();
            $table->string('job_number',30)->default('')->nullable()->comment('工号');
            $table->string('name',30);
            $table->string('avatar',30)->comment('头像');
            $table->tinyInteger('gender')->default(1)->nullable()->comment('1男 2女');
            $table->string('email',50);
            $table->timestamp('birthday')->nullable();
            $table->rememberToken();
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
}
