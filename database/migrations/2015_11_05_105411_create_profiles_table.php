<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('profile_pic')->nullable();
            $table->string('about_me')->nullable();
            $table->string('display_name', 30)->nullable();
            $table->string('contact_no', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province_state')->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->string('country', 60)->nullable();
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
        Schema::drop('profiles');
    }
}
