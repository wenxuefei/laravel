<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',50)->default('');
            $table->string('content',1000)->default('');
            $table->timestamps();
        });

        Schema::create('user_notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(0);
            $table->integer('notice_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
        Schema::dropIfExists('user_notices');
    }
}
