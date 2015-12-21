<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('link', 60)->unique();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('sp_user_id')->unsigned()->nullable();
            $table->foreign('sp_user_id')->references('sp_id')->on('users');
            $table->integer('sp_link_id')->unsigned()->nullable();
            $table->foreign('sp_link_id')->references('id')->on('links');
            $table->boolean('active')->default(0);
            $table->timestamp('date_activated');
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
        Schema::drop('links');
    }
}
