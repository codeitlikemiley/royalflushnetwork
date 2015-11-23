<?php

use Illuminate\Database\Seeder;
use App\User;

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

                'username'   => 'supervip',
                'email'      => 'supervip@maxpayout.com',
                'password'   => bcrypt('supervip'),
                'active'     => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ]);
        $faker = Faker\Factory::create();

        // User::truncate();

        foreach (range(2, 51) as $index) {
            User::create([
                'sp_id'      => $index - 1,
                'username'   => str_replace('.', '_', $faker->unique()->userName),
                'email'      => $faker->email,
                'password'   => 'password',
                'active'     => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } //endforeach
    } // end function run
}
