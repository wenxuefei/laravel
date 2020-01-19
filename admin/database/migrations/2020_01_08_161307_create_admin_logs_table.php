<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admin_id')->default(0)->comment('登录ID');
            $table->string('admin_name',30)->default('')->comment('登录名');
            $table->string('ip',30)->default('')->comment('登录ip');
            $table->string('address',30)->default('')->comment('登录IP地址');
            $table->string('device',30)->default('')->comment('设备名称');
            $table->string('browser',30)->default('')->comment('浏览器');
            $table->string('platform',30)->default('')->comment('操作系统');
            $table->string('language',30)->default('')->comment('语言');
            $table->string('device_type',15)->default('')->comment('设备类型');
            $table->integer('login_time')->default(0)->comment('登录时间');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_logs');
    }
}
