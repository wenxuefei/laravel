<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('username', 30)->unique();
                $table->string('password', 100);
                $table->string('mobile', 20)->default('')->unique();
                $table->integer('last_login')->default(0)->comment('上次登录时间');
                $table->string('last_ip', 20)->default('')->comment('上次登录IP');
                $table->tinyInteger('status')->default(1)->comment('账号状态：1开通，0禁用');
                $table->timestamps();
            });
        } else {
            Schema::table('admins', function (Blueprint $table) {
                if (!Schema::hasColumn('admins', 'avatar')) {
                    $table->string('avatar', 100)->default('')->comment('用户头像');
                }
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
//        Schema::dropIfExists('admins');
    }
}
