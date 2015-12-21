<?php

use Illuminate\Database\Seeder;

class CardlineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Link::truncate();

        foreach (range(1, 255) as $index) {
            $links = App\Link::all()->lists('id')->toArray();
            $array = ['App\Ten','App\Jack','App\Queen', 'App\King', 'App\Ace'];

            Cardline::create([
                'link_id'           => $faker->randomElement($links),
                'card_id'           => $faker->numberBetween($min = 1, $max = 51),
                'card_type'         => $faker->randomElements($array),
            ]);
        }
    }
}
