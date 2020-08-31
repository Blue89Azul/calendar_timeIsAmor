<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date("startDate");
            $table->time("startTime");
            $table->date("endDate");
            $table->time("endTime");
            $table->string("planTitle");
            $table->string("color");
            $table->integer("user_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_plans');
    }
}
