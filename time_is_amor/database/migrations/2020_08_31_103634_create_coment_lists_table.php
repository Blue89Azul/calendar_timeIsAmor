<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coment_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('comentDate');
            $table->string('comentTitle');
            $table->integer('like');
            $table->integer('users_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coment_lists');
    }
}
