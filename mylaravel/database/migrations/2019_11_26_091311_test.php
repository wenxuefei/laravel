<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Test extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('test')) {
            Schema::create('test', function (Blueprint $table) {
                $table->increments('id')->comment('主键字段');  // 主键字段
                $table->string('username')->nullable()->default('abc')->comment('用户名');
                $table->char('password', 100)->comment('密码');
                $table->string('nickname')->comment('昵称');
                $table->integer('group_id')->comment('组ID');
                $table->unique('username'); //唯一索引
                $table->index('nickname');
//                $table->engine('InnoDB');
            });
        } else {
            Schema::table('test', function ($table) {
                if(!Schema::hasColumn('test','email')){
                    $table->string('email')->comment('邮箱');
                }
                if(!Schema::hasColumn('test','sex')){
                    $table->tinyInteger('sex')->comment('性别')->default(0);
                }

//                $table->dropIndex('test_nickname_index');

                $table->text('nickname')->change();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
//        Schema::dropIfExists('test');
    }
}
