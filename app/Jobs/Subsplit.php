<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Console\Kernel as Artisan;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subsplit extends Job implements SelfHandling, ShouldQueue
{
    /**
     * Execute the job.
     *
     * @param \Illuminate\Contracts\Console\Kernel $artisan
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    public function handle(Artisan $artisan, Mailer $mailer)
    {
        if ($this->attempts() > 3) {
            return $this->sendFailureNotification($mailer);
        }

        $artisan->call('flashtag:subsplit');
    }

    /**
     * Send a failure notification email.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    private function sendFailureNotification($mailer)
    {
        $to = env('ADMIN_EMAIL', false);
        $from = env('FROM_EMAIL', "donotreply@flashtag.org");

        if ($to) {
            return $mailer->send('split-failed', [], function ($message) use ($to, $from) {
                $message->to($to)
                    ->from($from)
                    ->subject('Subsplit job failed more than three times');
            });
        }
    }
}
