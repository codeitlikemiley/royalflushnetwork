<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardlines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id')->unsigned();
            $table->foreign('link_id')->references('id')->on('links');
            $table->string('card_type')->unique();
            $table->integer('card_id')->unsigned();
            $table->integer('points')->unsigned();
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
        Schema::drop('cardlines');
    }
}
