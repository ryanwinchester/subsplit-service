<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Console\Kernel as Artisan;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subsplit extends Job implements SelfHandling, ShouldQueue
{
    /**
     * Execute the job.
     *
     * @param \Illuminate\Contracts\Console\Kernel $artisan
     */
    public function handle(Artisan $artisan)
    {
        $artisan->call('flashtag:subsplit');
    }
}
