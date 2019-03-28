<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysCategorys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60)->default('')->comment('分类名称');
            $table->string('image',160)->default('')->comment('分类图片');
            $table->integer('sorts')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('category_id');
            $table->string('category_type',160);
            $table->tinyInteger('status')->default(2)->comment('1正常 2冻结');
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
        Schema::dropIfExists('sys_categorys');
    }
}
