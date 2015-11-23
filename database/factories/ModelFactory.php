<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username'       => str_replace('.', '_', $faker->unique()->userName),
        'email'          => $faker->freeEmail,
        'password'       => 'password',
        'remember_token' => str_random(64),
        'active'         => 1,
        'status'         => 1,
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
$factory->define(App\Link::class, function (Faker\Generator $faker) {
    $users = User::all()->lists('id');
    $links = Link::all()->lists('id');

    return [
        'link'           => $faker->userName,
        'user_id'        => $faker->optional(),
        'sp_user_id'     => $faker->randomElement($users),
        'sp_link_id'     => $faker->randomElement($links),
        'password'       => bcrypt('password'),
        'remember_token' => str_random(64),
        'active'         => 1,
    ];
});
