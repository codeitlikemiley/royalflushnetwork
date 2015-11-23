<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('LinkTableSeeder');
        $this->call('ProfileTableSeeder');
        // $this->call('TenTableSeeder');
        // $this->call('JackTableSeeder');
        // $this->call('QueenTableSeeder');
        // $this->call('KingTableSeeder');
        // $this->call('AceTableSeeder');

    //     factory(App\User::class, 50)->create()->each(function ($u) {
    //     $u->posts()->save(factory(App\Post::class)->make());
    // });
    }
}
