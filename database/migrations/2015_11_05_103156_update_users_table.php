<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('activation_code')->after('password');
            $table->boolean('active')
                ->default(false)->after('activation_code');
            $table->boolean('status')
                ->default(true)->after('active');
            $table->tinyInteger('resent')->unsigned()->after('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {       
            $table->dropColumn('resent');
            $table->dropColumn('status');
            $table->dropColumn('active');
            $table->dropColumn('activation_code'); 
            
        });
    }
}
