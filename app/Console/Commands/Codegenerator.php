<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Code;

class Codegenerator extends Command
{
    protected $code;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:codes {qty=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Activation Code';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
     public function __construct(Code $code)
     {
         parent::__construct();

         $this->code = $code;
     }
    public function handle()
    {
        $qty = $this->ask('How Many Codes Do You Want?');
        if ($this->confirm('Do you wish to continue? [y|N]')) {
            $this->output->progressStart($qty);

            $u = $qty;
            $i = 0;
            while ($i < $u) {
                try {
                    $code          = new Code();
                    $code->pin     = $this->code->generatePin();
                    $code->secret  = $this->code->generateSecret();
                    $code->save();
                    ++$i;
                    $this->output->progressAdvance();
                } catch (\Illuminate\Database\QueryException $e) {
                    $i;
                }
            }

            $this->output->progressFinish();
            $this->info('You Created Successfully ' . $i . '/' . $u . ' Codes');
        }
    }
}
