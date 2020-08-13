<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_plans', function (Blueprint $table) {
          // unsignedの確認必要。。。マイグレイトの時エラーになっちゃった。。。
            $table->bigIncrements('id');
            $table->string('planTitle');
            $table->boolean('likeCheck');
            // 開始時刻
            $table->integer('startY');
            $table->integer('startM');
            $table->integer('startD');
            $table->integer('startH');
            $table->integer('startMinu');
            // 終了時刻
            $table->integer('endY');
            $table->integer('endM');
            $table->integer('endD');
            $table->integer('endH');
            $table->integer('endMinu');
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
        Schema::dropIfExists('input_plans');
    }
}
