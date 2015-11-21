<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('pin')->unique();
            $table->string('secret');
            $table->integer('creator')->unsigned()->nullable();
            $table->foreign('creator')->references('id')->on('users');
            $table->integer('consumer')->unsigned()->nullable()->unique();
            $table->foreign('consumer')->references('id')->on('links');
            $table->tinyInteger('attempts');
            $table->boolean('used')->default(0);
            $table->boolean('blocked')->default(0);
            $table->timestamp('date_used');
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
        Schema::drop('codes');
    }
}
