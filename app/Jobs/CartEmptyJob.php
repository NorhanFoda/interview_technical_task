<?php

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class CartEmptyJob implements ShouldDispatchAfterCommit
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //TODO:: handle sending notifications to user via email or sms or app notifications
    }
}
