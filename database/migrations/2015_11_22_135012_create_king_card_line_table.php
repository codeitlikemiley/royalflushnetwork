<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKingCardLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id')->unsigned();
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('min_direct')->unsigned();
            $table->boolean('shuffle')->default(0);
            $table->boolean('canSwitch')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::drop('kings');
    }
}
