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
    protected $signature = 'rfn:booster {qty=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RFN BOOSTER COMMAND';

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
        $qty = $this->ask('How Many Booster Do You Want?');
        if ($this->confirm('Do you wish to continue? [y|N]')) {
            $this->output->progressStart($qty);

            $u = $qty;
            $i = 0;
            while ($i < $u) {
                try {
                    $this->ace->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    try {
                        $this->king->freeCycle();
                    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                        try {
                            $this->queen->freeCycle();
                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                            try {
                                $this->jack->freeCycle();
                            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                                $this->ten->freeCycle();
                            }
                        }
                    }
                }

                try {
                    $this->king->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    try {
                        $this->queen->freeCycle();
                    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                        try {
                            $this->jack->freeCycle();
                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                            $this->ten->freeCycle();
                        }
                    }
                }

                try {
                    $this->queen->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    try {
                        $this->jack->freeCycle();
                    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                        $this->ten->freeCycle();
                    }
                }

                try {
                    $this->jack->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    $this->ten->freeCycle();
                }

                try {
                    $this->ten->freeCycle();
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    return "ERROR CREATE COMPANY ACCOUNT!!!";
                }
                // $this->ten->freeCycle();
                // $this->jack->freeCycle();
                // $this->queen->freeCycle();
                // $this->king->freeCycle();
                // $this->ace->freeCycle();
                // Uncomment this if the Flush Line is Full to Avoid Extra ms in Catching Error!
                $i++;
                $this->output->progressAdvance();
            }

            $this->output->progressFinish();
            $this->info('You Successfully Distributed ' . $i . '/' . $u . ' Booster');
        }
    }
}
