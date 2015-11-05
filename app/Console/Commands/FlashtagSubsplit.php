<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FlashtagSubsplit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashtag:subsplit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync flashtag subtree splits';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $output = [];
        $return_var = -1;
        $command = "sh " . base_path("build/flashtag-subsplit.sh");

        $last_line = exec($command, $output, $return_var);

        return $return_var;
    }
}