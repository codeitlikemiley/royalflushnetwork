<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => 1,
            'first_name' => 'Uriah',
            'last_name'   => 'Galang',

            'about_me' => 'Im Your Admin',
            'display_name' => 'Super Mario Bros.',
            'contact_no' => '09277503043',
            'address' => 'New Cabalan',
            'city' => 'Olongapo',
            'province_state' => 'Zambales',
            'zip_code' => '2200',
            'country' => 'Philippines',
        ]);
    }
}
