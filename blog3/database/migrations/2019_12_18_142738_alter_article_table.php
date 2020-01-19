<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles',function (Blueprint $table){
           $table->tinyInteger('status')->default(0)->comment('文章的状态 0未审核 1审核 -1 审核不通过');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles',function (Blueprint $table){
            $table->dropColumn('status');
        });
    }
}
