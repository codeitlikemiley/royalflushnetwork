<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Ten;
use App\Jack;
use App\Queen;
use App\King;
use App\Ace;

class Booster extends Command
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
    protected $signature = 'rfn:booster';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute Booster [TOP ACCOUNT FIRST]';

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
        $qty = $this->ask('How Many Cycle Each Card Line Do You Want for [BOOSTER] ?!');
        if ($this->confirm('Do you wish to continue? [y|N]')) {
            $this->output->progressStart($qty);

            $u = $qty;
            $i = 0;

            $t           = 0;
            $jk          = 0;
            $q           = 0;
            $k           = 0;
            $a           = 0;

            while ($i < $u) {
                try {
                    $this->ten->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $t++;
                }
                try {
                    $this->jack->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $jk++;
                }
                try {
                    $this->queen->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $q++;
                }
                try {
                    $this->king->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $k++;
                }
                try {
                    $this->ace->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $a++;
                }
                $i++;
                $this->output->progressAdvance();
            }
            $headers  = ['Booster Total Count', 'Booster Distributed', 'Ten Failed', 'Jack Failed', 'Queen Failed', 'King Failed', 'Ace Failed'];
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
