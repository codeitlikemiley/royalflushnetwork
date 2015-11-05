<?php

use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([

            'link' => 'masterpowers',
            'user_id'   => 1,
            'sp_link_id' =>  null,
            'active' => true,
            'date_activated' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),


        ]);
    }
}
