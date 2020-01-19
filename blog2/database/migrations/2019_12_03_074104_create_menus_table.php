<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('菜单名称')->default('');
            $table->string('url')->comment('菜单链接')->default('');
            $table->string('icon')->comment('菜单图标')->default('');
            $table->integer('parent_id')->comment('父级菜单');
            $table->string('slug')->comment('菜单权限');
            $table->string('heightlight_url')->comment('菜单高亮链接')->default('');
            $table->tinyInteger('sort')->unsigned()->comment('菜单顺序')->default(0);
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
        Schema::dropIfExists('menus');
    }
}
