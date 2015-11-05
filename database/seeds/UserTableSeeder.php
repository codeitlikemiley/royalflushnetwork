<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'username' => 'supervip',
            'email' =>  'supervip@maxpayout.com',
            'password' => bcrypt('supervip'),
            'active' => 1,

        ]);
    }
}
