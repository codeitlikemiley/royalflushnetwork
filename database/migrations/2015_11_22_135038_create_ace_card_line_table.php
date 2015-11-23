<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAceCardLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id')->unsigned();
            $table->foreign('link_id')->references('id')->on('links');
            $table->integer('min_direct')->unsigned();
            $table->boolean('shuffle')->default(0);
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
        Schema::drop('aces');
    }
}
