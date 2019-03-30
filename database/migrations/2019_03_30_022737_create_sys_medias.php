<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('title',60)->default('')->comment('分类名称');
            $table->string('path')->default('')->comment('分类路径');
            $table->integer('sorts')->default(0);
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('type')->default(0)->comment('文件类型详情见模型');
            $table->timestamps();
        });

        Schema::create('sys_mediables', function (Blueprint $table) {
            $table->integer('media_id');
            $table->integer('mediables_id');
            $table->string('mediables_type',160);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_medias');
    }
}
