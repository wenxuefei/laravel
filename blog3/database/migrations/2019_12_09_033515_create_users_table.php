<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('username',20)->unique()->default('');
            $table->string('password');
            $table->text('intro')->nullable();
            $table->string('email',30)->unique()->default('');
            $table->string('phone',18)->unique()->default('');
            $table->string('avatar_url')->default('');
//            $table->string('country_code',18)->default('+86');
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
