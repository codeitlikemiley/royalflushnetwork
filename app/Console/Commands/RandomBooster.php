<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Ten;
use App\Jack;
use App\Queen;
use App\King;
use App\Ace;
use Faker;

class RandomBooster extends Command
{
    protected $ten;
    protected $jack;
    protected $queen;
    protected $king;
    protected $ace;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rfn:randombooster';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute Random Booster to Active Accounts!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Ten $ten, Jack $jack, Queen $queen, King $king, Ace $ace)
    {
        parent::__construct();
        $this->ten      = $ten;
        $this->jack     = $jack;
        $this->queen    = $queen;
        $this->king     = $king;
        $this->ace      = $ace;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $qty  = $this->ask('How Many Cycle Each Card Line Do You Want For [RANDOM BOOSTER]?!');
        if ($this->confirm('Do you wish to continue? [y|N]')) {
            $this->output->progressStart($qty);

            $faker = Faker\Factory::create();

            $u = $qty;
            $i = 0;

            $t           = 0;
            $jk          = 0;
            $q           = 0;
            $k           = 0;
            $a           = 0;

            $ten   = Ten::where('active', true)->where('shuffle', false)->lists('link_id')->toArray();
            $jack  = Jack::where('active', true)->where('shuffle', false)->lists('link_id')->toArray();
            $queen = Queen::where('active', true)->where('shuffle', false)->lists('link_id')->toArray();
            $king  = King::where('active', true)->where('shuffle', false)->lists('link_id')->toArray();
            $ace   = Ace::where('active', true)->where('shuffle', false)->lists('link_id')->toArray();

            while ($i < $u) {
                try {
                    $this->ten->forceCycle($faker->randomElement($ten));
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $t++;
                }
                try {
                    $this->jack->forceCycle($faker->randomElement($jack));
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $jk++;
                }
                try {
                    $this->queen->forceCycle($faker->randomElement($queen));
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $q++;
                }
                try {
                    $this->king->forceCycle($faker->randomElement($king));
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $k++;
                }
                try {
                    $this->ace->forceCycle($faker->randomElement($ace));
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $a++;
                }

                $i++;

                $this->output->progressAdvance();
            }
            $headers  = ['Total Cycle Count', 'Cycle Distributed', 'Ten Error', 'Jack Error', 'Queen Error', 'King Error', 'Ace Error'];
            $rows     = [[
                          "total"    => $u * 5,
                          "consumed" => ($u * 5) - ($t + $jk + $q + $k + $a),
                          "ten"      => $t,
                          "jack"     => $jk,
                          "queen"    => $q,
                          "king"     => $k,
                          "ace"      => $a,
                        ]];
            $this->output->progressFinish();
            $this->table($headers, $rows);
        }
    }
}
