<?php

use Illuminate\Database\Seeder;
use App\Link;

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

            'link'           => 'masterpowers',
            'user_id'        => 1,
            'sp_link_id'     => null,
            'active'         => true,
            'date_activated' => \Carbon\Carbon::now(),
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now(),

        ]);

        $faker = Faker\Factory::create();

        // Link::truncate();

        foreach (range(1, 50) as $index) {
            Link::create([
                'link'           => str_replace('.', '_', $faker->unique()->userName),
                'user_id'        => $index + 1,
                'sp_link_id'     => $index,
                'sp_user_id'     => $index,
                'active'         => true,
                'date_activated' => \Carbon\Carbon::now(),
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now(),
            ]);
        }
    }
}
